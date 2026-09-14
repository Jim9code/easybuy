<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // 1. Fetch and display all products on the dashboard / home
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $query = Product::where('status', 'active');

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->get();

        return view('home', compact('products'));
    }

    // 2. Create and store a new product (Supplier / Admin CRUD)
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || (!$user->isSupplier() && !$user->isAdmin())) {
            abort(403, 'Unauthorized: Supplier or Admin account required to create products.');
        }

        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'msrp' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'min_order_qty' => 'nullable|integer|min:1',
            'lead_time' => 'nullable|string|max:255',
            'warranty' => 'nullable|string|max:255',
            'image_url' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        if (empty($incomingFields['sku'])) {
            $catPrefix = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $incomingFields['category']), 0, 3));
            $incomingFields['sku'] = 'EB-' . ($catPrefix ?: 'PRD') . '-' . rand(100, 999);
        }

        if (empty($incomingFields['msrp'])) {
            $incomingFields['msrp'] = round($incomingFields['price'] * 1.45, 2);
        }

        // Handle uploaded local image file
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'product_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $incomingFields['image_url'] = asset('uploads/products/' . $filename);
        } elseif (empty($incomingFields['image_url'])) {
            $incomingFields['image_url'] = asset('images/3d-refs/ergo_chair.jpg');
        }

        $incomingFields['supplier_id'] = $user->id;
        $incomingFields['status'] = 'active';

        $product = Product::create($incomingFields);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully!',
                'product' => $product
            ]);
        }

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    // 3. Update an existing product
    public function update(Request $request, Product $product)
    {
        $user = Auth::user();
        if (!$user || (!$user->isAdmin() && $product->supplier_id !== $user->id)) {
            abort(403, 'Unauthorized: You can only edit products belonging to your supplier account.');
        }

        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'msrp' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'min_order_qty' => 'nullable|integer|min:1',
            'lead_time' => 'nullable|string|max:255',
            'warranty' => 'nullable|string|max:255',
            'image_url' => 'nullable|string',
            'images' => 'nullable',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'new_image_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        if (empty($incomingFields['msrp'])) {
            $incomingFields['msrp'] = round($incomingFields['price'] * 1.45, 2);
        }

        // Parse retained gallery images list if provided
        $galleryImages = [];
        if ($request->has('images')) {
            $rawImages = $request->input('images');
            if (is_string($rawImages)) {
                $decoded = json_decode($rawImages, true);
                $galleryImages = is_array($decoded) ? $decoded : [];
            } elseif (is_array($rawImages)) {
                $galleryImages = $rawImages;
            }
        } else {
            $galleryImages = $product->gallery_images;
        }

        // Handle uploaded local single image file if present
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'product_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $newUrl = asset('uploads/products/' . $filename);
            array_unshift($galleryImages, $newUrl);
        }

        // Handle multiple new image files if present
        if ($request->hasFile('new_image_files')) {
            foreach ($request->file('new_image_files') as $file) {
                if ($file && $file->isValid()) {
                    $filename = 'product_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products'), $filename);
                    $galleryImages[] = asset('uploads/products/' . $filename);
                }
            }
        }

        // Deduplicate and clean up array
        $galleryImages = array_values(array_unique(array_filter($galleryImages)));
        
        $incomingFields['images'] = $galleryImages;
        $incomingFields['image_url'] = $galleryImages[0] ?? ($product->image_url ?: asset('images/3d-refs/ergo_chair.jpg'));

        $product->update($incomingFields);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully!',
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'category' => $product->category,
                    'description' => $product->description,
                    'stock' => $product->stock,
                    'price' => (float) $product->price,
                    'unit_cost' => (float) $product->price,
                    'tier_2' => (float) $product->price,
                    'tier_1' => (float) $product->msrp,
                    'msrp' => (float) $product->msrp,
                    'lead_time' => $product->lead_time,
                    'warranty' => $product->warranty,
                    'image' => $product->primary_image,
                    'images' => $product->gallery_images,
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    // 4. Delete a product
    public function destroy(Request $request, Product $product)
    {
        $user = Auth::user();
        if (!$user || (!$user->isAdmin() && $product->supplier_id !== $user->id)) {
            abort(403, 'Unauthorized: You can only delete products belonging to your supplier account.');
        }

        $product->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Wholesale SKU delisted and deleted successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Wholesale SKU deleted successfully!');
    }

    // 5. Display Dedicated Wholesale Catalog Page
    public function catalog(Request $request)
    {
        $query = Product::where('status', 'active');

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $dbProducts = $query->latest()->get();

        // Map into view objects with formatted properties
        $catalogProducts = $dbProducts->map(function($item) {
            return (object) [
                'id' => (string) $item->id,
                'name' => $item->name,
                'sku' => $item->sku ?: 'EB-SKU-' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                'category' => $item->category,
                'image' => $item->primary_image,
                'images' => $item->gallery_images,
                'price' => (float) $item->price,
                'msrp' => (float) ($item->msrp ?: ($item->price * 1.45)),
                'lead_time' => $item->lead_time ?: '2-3 Days Dispatch',
                'warranty' => $item->warranty ?: 'Commercial Quality Guarantee',
                'stock' => $item->stock > 0 ? "{$item->stock} Units Available" : 'In Stock',
                'confidence' => $item->confidence ?: 'Verified Wholesale Match',
                'description' => $item->description ?: 'Verified commercial specification item ready for single-invoice consolidated dispatch.'
            ];
        });

        return view('catalog', compact('catalogProducts'));
    }

    // 6. Display Dedicated Product Detail Page
    public function show($id)
    {
        // Try finding by ID or SKU
        $dbProduct = Product::where('id', $id)
            ->orWhere('sku', $id)
            ->first();

        if ($dbProduct) {
            $product = (object) [
                'id' => (string) $dbProduct->id,
                'name' => $dbProduct->name,
                'sku' => $dbProduct->sku ?: 'EB-SKU-' . str_pad($dbProduct->id, 3, '0', STR_PAD_LEFT),
                'category' => $dbProduct->category,
                'image' => $dbProduct->primary_image,
                'images' => $dbProduct->gallery_images,
                'price' => (float) $dbProduct->price,
                'msrp' => (float) ($dbProduct->msrp ?: ($dbProduct->price * 1.45)),
                'lead_time' => $dbProduct->lead_time ?: '2-3 Days Dispatch',
                'warranty' => $dbProduct->warranty ?: 'Commercial Quality Guarantee',
                'stock' => $dbProduct->stock > 0 ? "{$dbProduct->stock} Units Available" : 'In Stock',
                'confidence' => $dbProduct->confidence ?: 'Verified Wholesale Match',
                'specs' => $dbProduct->specs ?: [
                    'Category' => $dbProduct->category,
                    'Verification' => 'Direct Factory Inspected',
                    'Packaging' => 'Commercial Blind Packaging Slip',
                    'Payment Terms' => 'Net-30 / Net-60 / Paystack Eligible'
                ],
                'description' => $dbProduct->description ?: 'Verified commercial specification item ready for single-invoice consolidated dispatch.'
            ];
        } else {
            // Fallback product if ID was demo string
            $first = Product::first();
            if ($first) {
                return redirect()->route('product.show', ['id' => $first->id]);
            }
            abort(404, 'Product not found');
        }

        $allProducts = Product::where('status', 'active')->where('id', '!=', $dbProduct->id)->limit(6)->get();
        return view('product-detail', compact('product', 'allProducts'));
    }
}
