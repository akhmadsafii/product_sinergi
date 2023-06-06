<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://dummyjson.com/products');
        $productsData = $response->json();

        foreach ($productsData['products'] as $productData) {
            $product = new Product();
            $product->title = $productData['title'];
            $product->slug = Str::slug($productData['title']) . '-' . Str::random(5);
            $product->description = $productData['description'];
            $product->price = $productData['price'];
            $product->discount_percentage = $productData['discountPercentage'];
            $product->rating = $productData['rating'];
            $product->stock = $productData['stock'];
            $product->brand = $productData['brand'];
            $product->category = $productData['category'];
            $product->thumbnail = $productData['thumbnail'];
            $product->images = $productData['images'];
            $product->save();
        }
    }
}
