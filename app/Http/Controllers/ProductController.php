<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function fetchData(Request $request)
    {
        $url = $request->input('url');

        // Lakukan permintaan HTTP ke URL dummy dan ambil data
        $response = Http::get($url);
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

        // Redirect pengguna ke halaman baru untuk menampilkan data
        return redirect()->route('products');
    }

    public function search(Request $request)
    {
        $filter = $request->input('filter');

        $products = Product::where('title', 'LIKE', "%$filter%")
            ->orWhere('description', 'LIKE', "%$filter%")
            ->get();

        return view('product.list', compact('products', 'filter'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404); // Menampilkan halaman 404 jika produk tidak ditemukan
        }
        return view('product.detail', compact('product'));
    }

    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404); // Menampilkan halaman 404 jika produk tidak ditemukan
        }
        return view('product.form', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'stock' => 'required|integer',
            'rating' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required',
            // 'thumbnail' => 'nullable|image|max:2048',
            // 'images.*' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'message' => 'The given data is invalid',
                'errors' => $validator->errors(),
            ], 422));
            // return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($id);

        // Update other fields
        $product->title = $request->input('title');
        $product->category = $request->input('category');
        $product->brand = $request->input('brand');
        $product->stock = $request->input('stock');
        $product->rating = $request->input('rating');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->discount_percentage = $request->input('discount');

        // Update thumbnail
        if ($request->has('thumbnail')) {
            $thumbnail = $request->input('thumbnail');
            if (filter_var($thumbnail, FILTER_VALIDATE_URL)) {
                // The thumbnail is a link
                $product->thumbnail = $thumbnail;
            } else {
                // The thumbnail is a file
                $thumbnailFile = $request->file('thumbnail');
                $thumbnailPath = $thumbnailFile->store('assets/thumbnails', 'public');
                $thumbnailUrl = asset('storage/' . $thumbnailPath);
                $product->thumbnail = $thumbnailUrl;
            }
        }

        // Update images
        if ($request->has('images')) {
            $images = $request->input('images');
            $imageUrls = [];

            foreach ($images as $image) {
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    // The image is a link
                    $imageUrls[] = $image;
                } else {
                    // The image is a file
                    $imageFile = $image->file('image');
                    $imagePath = $imageFile->store('assets/images', 'public');
                    $imageUrl = asset('storage/' . $imagePath);
                    $imageUrls[] = $imageUrl;
                }
            }

            $product->images = json_encode($imageUrls);
        }

        $product->save();

        $this->flashMessage('check', 'Product updated successfully!', 'success');

        return redirect()->back();
    }
}
