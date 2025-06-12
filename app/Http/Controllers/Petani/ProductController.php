<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->latest()->paginate(10);
        return view('petani.products.index', compact('products'));
    }

    public function create()
    {
        return view('petani.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_path' => $imagePath,

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan!',
            'redirect' => route('petani.products.index')
        ]);
    }

    public function edit($id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        return view('petani.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image',
        ]);

        $product = Product::where('user_id', auth()->id())->findOrFail($id);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_path' => $imagePath,

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui!',
            'redirect' => route('petani.products.index')
        ]);
    }

    public function destroy($id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus!'
        ]);
    }
}