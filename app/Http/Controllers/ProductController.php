<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Fetch and display all products on the dashboard
    public function index()
    {
        // Get all products from database sorted by creation date
        $products = Product::latest()->get();

        // Load the home view and pass the products variable
        return view('home', compact('products'));
    }

    // 2. Create and store a new product
    public function store(Request $request)
    {
        // Validate inputs
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Insert new product record into database
        Product::create($incomingFields);

        // Redirect back with success message
        return redirect()->route('home')->with('success', 'Product created successfully!');
    }

    // 3. Update an existing product
    public function update(Request $request, Product $product)
    {
        // Validate inputs
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Update the product values
        $product->update($incomingFields);

        // Redirect back with success message
        return redirect()->route('home')->with('success', 'Product updated successfully!');
    }

    // 4. Delete a product
    public function destroy(Product $product)
    {
        // Delete the product record
        $product->delete();

        // Redirect back with success message
        return redirect()->route('home')->with('success', 'Product deleted successfully!');
    }
}
