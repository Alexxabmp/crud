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
                'name'           => 'Apple iPhone 15 Pro',
                'sku'            => 'APL-IP15P-128',
                'category'       => 'Electronics',
                'description'    => 'Apple iPhone 15 Pro with A17 Pro chip, titanium design, and USB-C connectivity. Features a 6.1-inch Super Retina XDR display.',
                'price'          => 59999.00,
                'stock_quantity' => 45,
                'expiry_date'    => null,
                'image'          => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Nike Air Max 270',
                'sku'            => 'NKE-AM270-BLK-10',
                'category'       => 'Clothing',
                'description'    => 'Nike Air Max 270 running shoes in black. Features Max Air heel unit for unmatched, all-day comfort.',
                'price'          => 6499.00,
                'stock_quantity' => 120,
                'expiry_date'    => null,
                'image'          => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Nescafe Gold Blend 200g',
                'sku'            => 'NSC-GOLD-200G',
                'category'       => 'Food & Beverages',
                'description'    => 'Premium instant coffee with a rich and smooth taste. Made from carefully selected Arabica and Robusta beans.',
                'price'          => 349.75,
                'stock_quantity' => 300,
                'expiry_date'    => '2027-06-30',
                'image'          => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Vitamin C 500mg (60 tablets)',
                'sku'            => 'VIT-C500-60T',
                'category'       => 'Health & Beauty',
                'description'    => 'High-potency Vitamin C supplement to support immune health. Each tablet contains 500mg of ascorbic acid.',
                'price'          => 189.50,
                'stock_quantity' => 8,
                'expiry_date'    => '2026-12-31',
                'image'          => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Samsung 65" QLED 4K TV',
                'sku'            => 'SAM-65QLED-4K',
                'category'       => 'Electronics',
                'description'    => '65-inch QLED 4K Smart TV with Quantum Dot technology, HDR10+, and built-in Alexa.',
                'price'          => 89999.99,
                'stock_quantity' => 15,
                'expiry_date'    => null,
                'image'          => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'IKEA KALLAX Shelf Unit',
                'sku'            => 'IKA-KLLX-4X2-WHT',
                'category'       => 'Home & Living',
                'description'    => 'IKEA KALLAX shelf unit in white, 4x2 grid. Perfect for storage, organization, and display.',
                'price'          => 4299.00,
                'stock_quantity' => 0,
                'expiry_date'    => null,
                'image'          => null,
                'is_active'      => false,
            ],
            [
                'name'           => 'Moleskine Classic Notebook',
                'sku'            => 'MOL-CLX-A5-BLK',
                'category'       => 'Books & Media',
                'description'    => 'Moleskine classic hardcover notebook, A5 size, 240 pages. Acid-free paper, bookmark ribbon, and elastic closure.',
                'price'          => 899.00,
                'stock_quantity' => 55,
                'expiry_date'    => null,
                'image'          => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Lego Technic Formula E Car',
                'sku'            => 'LEG-TCH-42171',
                'category'       => 'Toys & Games',
                'description'    => '1365-piece LEGO Technic set. Build a highly detailed Formula E racing car with working steering and suspension.',
                'price'          => 7999.00,
                'stock_quantity' => 22,
                'expiry_date'    => null,
                'image'          => null,
                'is_active'      => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
