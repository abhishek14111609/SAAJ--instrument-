<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $wellness = Category::create(['name' => 'Wellness', 'slug' => 'wellness']);
        $spices = Category::create(['name' => 'Spices', 'slug' => 'spices']);

        // Wellness: Honey Products
        $honeyProducts = [
            [
                'name' => 'Multiflora Honey',
                'description' => 'A diverse blend of nectar from various wildflowers.',
                'variants' => [
                    ['name' => '250 g', 'price' => 220],
                    ['name' => '400 g', 'price' => 315],
                    ['name' => '700 g', 'price' => 550],
                ]
            ],
            [
                'name' => 'Litchi Honey',
                'description' => 'Monofloral honey with a delicate, fruity flavor.',
                'variants' => [
                    ['name' => '250 g', 'price' => 400],
                    ['name' => '400 g', 'price' => 600],
                    ['name' => '700 g', 'price' => 1050],
                ]
            ],
            [
                'name' => 'Drumstick Honey',
                'description' => 'Rich in minerals, harvested from Moringa flowers.',
                'variants' => [
                    ['name' => '250 g', 'price' => 450],
                    ['name' => '400 g', 'price' => 660],
                    ['name' => '700 g', 'price' => 1135],
                ]
            ],
            [
                'name' => 'Pongamia Pinnata',
                'description' => 'Unique honey with medicinal properties.',
                'variants' => [
                    ['name' => '250 g', 'price' => 460],
                    ['name' => '400 g', 'price' => 700],
                    ['name' => '700 g', 'price' => 1225],
                ]
            ],
            [
                'name' => 'Madhurima Spice',
                'description' => 'A special spiced honey blend.',
                'variants' => [
                    ['name' => '250 g', 'price' => 470],
                ]
            ],
            [
                'name' => 'All Seasons Batch',
                'description' => 'Our signature year-round honey batch.',
                'variants' => [
                    ['name' => '250 g', 'price' => 350], // Placeholder
                    ['name' => '400 g', 'price' => 500], // Placeholder
                    ['name' => '700 g', 'price' => 850], // Placeholder
                ]
            ]
        ];

        foreach ($honeyProducts as $data) {
            $product = Product::create([
                'category_id' => $wellness->id,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'],
            ]);

            foreach ($data['variants'] as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'name' => $variant['name'],
                    'price' => $variant['price'],
                    'stock' => 100,
                ]);
            }
        }

        // Spices
        $spiceNames = [
            'Cinnamon Roll – Large',
            'Cinnamon Roll – Small',
            'Kashmiri Mirchi',
            'Nutmeg Mace (Javitri)',
            'Dried Ginger',
            'Dried Turmeric',
            'Turmeric Powder',
            'Tamarind (Valampuli)',
            'Tamarind (Kudum Puli) – Malabar Imli',
            'Black Pepper',
            'Home Grown Kerala Coffee',
            'Home Grown Kerala Turmeric',
            'Cloves',
            'Cardamom',
            'Kashmiri Garlic',
            'Jackfruit Seeds',
            'Betelnut',
            'Nutmeg',
        ];

        foreach ($spiceNames as $name) {
            $product = Product::create([
                'category_id' => $spices->id,
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Premium quality spice sourced from Kerala and Karnataka.',
            ]);

            // Since packaging decisions are pending, we'll add one default variant
            ProductVariant::create([
                'product_id' => $product->id,
                'name' => 'Standard Pack',
                'price' => 0.00, // Decision pending
                'stock' => 50,
            ]);
        }
    }
}
