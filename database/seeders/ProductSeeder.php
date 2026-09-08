<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'sku' => 'EB-ERG-904',
                'name' => 'Ergonomic Lumbar Mesh Task Chair',
                'category' => 'Ergonomics',
                'description' => 'Commercial-grade ergonomic mesh task chair featuring adaptive lumbar spine curvature, self-weight synchro-tilt mechanism, and breathable reinforced mesh.',
                'price' => 140.00,
                'msrp' => 220.00,
                'image_url' => asset('images/3d-refs/ergo_chair.jpg'),
                'images' => [
                    asset('images/3d-refs/ergo_chair.jpg'),
                    'https://images.unsplash.com/photo-1580481077195-c9a444158933?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1505797149-43b0069ec26b?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 120,
                'min_order_qty' => 5,
                'lead_time' => '2-3 Days Dispatch',
                'warranty' => '3-Year Direct Replacement',
                'confidence' => '99% Exact Match',
                'specs' => [
                    'Material' => 'High-density breathable Korean mesh',
                    'Base' => 'Reinforced aluminum alloy 5-star base',
                    'Weight Capacity' => '330 lbs (150 kg)',
                    'Certifications' => 'ANSI / BIFMA X5.1 Compliant',
                    'Adjustability' => '3D Padded Arms, Synchron-Tilt 135°'
                ],
                'status' => 'active'
            ],
            [
                'sku' => 'EB-DISP-4K',
                'name' => '27-inch 4K UHD IPS USB-C Business Display',
                'category' => 'IT & Infrastructure',
                'description' => 'Factory-calibrated 4K productivity monitor with integrated 90W USB-C docking hub, Ethernet passthrough, and full ergonomic height/swivel pivot.',
                'price' => 220.00,
                'msrp' => 320.00,
                'image_url' => asset('images/3d-refs/4k_display.jpg'),
                'images' => [
                    asset('images/3d-refs/4k_display.jpg'),
                    'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 65,
                'min_order_qty' => 10,
                'lead_time' => '24h Express Dispatch',
                'warranty' => '3-Year Zero-Dead-Pixel',
                'confidence' => '98% Exact Match',
                'specs' => [
                    'Resolution' => '3840 x 2160 UHD IPS Anti-Glare',
                    'Power Delivery' => '90W USB-C Single-Cable Hub',
                    'Color Accuracy' => '99% sRGB Factory Calibrated',
                    'Ports' => 'USB-C PD, HDMI 2.1, DP 1.4, RJ45 Gigabit',
                    'Mounting' => 'VESA 100x100mm Quick-Release'
                ],
                'status' => 'active'
            ],
            [
                'sku' => 'EB-DSK-STD',
                'name' => 'Dual-Motor Electric Standing Desk (60x30")',
                'category' => 'Ergonomics',
                'description' => 'Heavy-duty electric height-adjustable desk designed for commercial open-plan offices with solid anti-scratch desktop and digital memory keypad.',
                'price' => 290.00,
                'msrp' => 450.00,
                'image_url' => asset('images/3d-refs/standing_desk.jpg'),
                'images' => [
                    asset('images/3d-refs/standing_desk.jpg'),
                    'https://images.unsplash.com/photo-1595515106969-1ce29566ff1c?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1505797149-43b0069ec26b?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 40,
                'min_order_qty' => 3,
                'lead_time' => '3 Days Dispatch',
                'warranty' => '5-Year Motor Warranty',
                'confidence' => '96% High Match',
                'specs' => [
                    'Motors' => 'Dual synchronized ultra-quiet motors (<45dB)',
                    'Height Range' => '25.2" – 50.8" (64cm – 129cm)',
                    'Desktop Material' => 'FSC-certified solid oak laminate',
                    'Control' => '4 Memory Presets + Anti-Collision Sensor',
                    'Max Load' => '275 lbs (125 kg)'
                ],
                'status' => 'active'
            ],
            [
                'sku' => 'EB-LMP-ARC',
                'name' => 'Curved Terracotta Arch LED Task Lamp',
                'category' => 'Facilities',
                'description' => 'Architectural curved LED desk lamp designed for creative design studios, providing glare-free even diffusion and high-CRI color precision.',
                'price' => 95.00,
                'msrp' => 155.00,
                'image_url' => asset('images/3d-refs/modern_lamp.jpg'),
                'images' => [
                    asset('images/3d-refs/modern_lamp.jpg'),
                    'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 55,
                'min_order_qty' => 8,
                'lead_time' => '2 Days Dispatch',
                'warranty' => '3-Year LED Module Warranty',
                'confidence' => '99% Exact Match',
                'specs' => [
                    'Color Temperature' => '2700K – 5000K Stepless Touch Dimming',
                    'Color Rendering' => '95+ CRI True-Color Accuracy',
                    'Material' => 'Anodized aluminum with matte terracotta finish',
                    'Power' => '15W USB-C Powered, Zero Strobe'
                ],
                'status' => 'active'
            ],
            [
                'sku' => 'EB-HUB-SMT',
                'name' => 'Smart Wireless Multi-Device Charging Desktop Hub',
                'category' => 'IT & Infrastructure',
                'description' => 'Compact desktop power workstation bundling dual fast wireless charging pads with high-wattage USB-C power delivery.',
                'price' => 75.00,
                'msrp' => 120.00,
                'image_url' => asset('images/3d-refs/smart_hub.jpg'),
                'images' => [
                    asset('images/3d-refs/smart_hub.jpg'),
                    'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 75,
                'min_order_qty' => 10,
                'lead_time' => '24h Dispatch',
                'warranty' => '2-Year Direct Replacement',
                'confidence' => '98% Exact Match',
                'specs' => [
                    'Wireless Charging' => 'Dual 15W Qi Fast Magnetic Pads',
                    'Wired Ports' => '2x 65W USB-C PD, 2x USB-A 3.1',
                    'Protection' => 'Overvoltage & foreign object detection',
                    'Casing' => 'Weighted CNC aluminum base'
                ],
                'status' => 'active'
            ],
            [
                'sku' => 'EB-JAN-PPR',
                'name' => '2-Ply Recycled Commercial Toilet Paper (Case of 24)',
                'category' => 'Janitorial & Pantry',
                'description' => 'Commercial soft embossed 2-ply bath tissue rolls engineered for high-traffic corporate offices and hospitality facilities.',
                'price' => 32.00,
                'msrp' => 52.00,
                'image_url' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=500&auto=format&fit=crop&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1584744982491-665216d95f8b?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 350,
                'min_order_qty' => 5,
                'lead_time' => 'Same Day Dispatch',
                'warranty' => '100% Quality Guaranteed',
                'confidence' => '100% Exact Match',
                'specs' => [
                    'Material' => '100% Post-Consumer Recycled Fiber',
                    'Sheet Count' => '450 Sheets per roll (2-Ply Embossed)',
                    'Certifications' => 'FSC Certified / Elemental Chlorine-Free',
                    'Dispersibility' => 'Rapid-flush septic safe'
                ],
                'status' => 'active'
            ],
            [
                'sku' => 'EB-JAN-SAN',
                'name' => 'Hospital-Grade Multi-Surface Disinfectant (Case of 12)',
                'category' => 'Janitorial & Pantry',
                'description' => 'Ready-to-use commercial surface disinfectant spray for high-touch office areas, conference tables, and breakrooms.',
                'price' => 48.00,
                'msrp' => 75.00,
                'image_url' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=500&auto=format&fit=crop&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1584744982491-665216d95f8b?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 180,
                'min_order_qty' => 4,
                'lead_time' => '24h Dispatch',
                'warranty' => 'EPA Certified',
                'confidence' => '100% Exact Match',
                'specs' => [
                    'Bottle Volume' => '32 oz (946ml) Trigger Sprays x 12',
                    'Efficacy' => 'Kills 99.99% bacteria & viruses in 60 seconds',
                    'Fragrance' => 'Natural citrus (Bleach-free, Non-toxic)',
                    'Surfaces' => 'Glass, stainless steel, laminate, tiles'
                ],
                'status' => 'active'
            ],
            [
                'sku' => 'EB-PAN-COF',
                'name' => 'Organic Whole Bean Dark Roast Espresso (4kg Bag)',
                'category' => 'Janitorial & Pantry',
                'description' => 'Direct-trade certified whole espresso beans freshly roasted for commercial bean-to-cup office espresso machines.',
                'price' => 58.00,
                'msrp' => 95.00,
                'image_url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=500&auto=format&fit=crop&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 90,
                'min_order_qty' => 2,
                'lead_time' => 'Fresh Batch Roasted Weekly',
                'warranty' => 'Direct Farm Traceability',
                'confidence' => '99% Exact Match',
                'specs' => [
                    'Bean Origin' => '100% Organic Arabica (Guatemala & Colombia)',
                    'Roast Profile' => 'Dark Italian Roast',
                    'Tasting Notes' => 'Dark chocolate, toasted hazelnut, caramel'
                ],
                'status' => 'active'
            ],
            [
                'sku' => 'EB-FAC-DIV',
                'name' => 'Acoustic Recycled Felt Desktop Privacy Divider (6-Pack)',
                'category' => 'Facilities',
                'description' => 'Sound-dampening acoustic desk screens providing acoustic privacy and visual division in open-plan creative studio workspaces.',
                'price' => 280.00,
                'msrp' => 420.00,
                'image_url' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=500&auto=format&fit=crop&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=900&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=900&auto=format&fit=crop&q=80'
                ],
                'stock' => 30,
                'min_order_qty' => 2,
                'lead_time' => '3 Days Dispatch',
                'warranty' => 'Commercial Grade',
                'confidence' => '97% High Match',
                'specs' => [
                    'Acoustic Rating' => '0.85 NRC Sound Absorption Rating',
                    'Material' => '100% Recycled PET Felt (Non-Toxic, Odorless)',
                    'Dimensions' => '48" x 18" with heavy-duty clamp brackets'
                ],
                'status' => 'active'
            ]
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['sku' => $p['sku']],
                $p
            );
        }
    }
}
