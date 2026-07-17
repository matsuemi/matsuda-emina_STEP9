<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    $products = Product::where('user_id', '!=', auth()->id())->get();

    return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function show($id)
    {
    $product = Product::with(['company', 'likes'])->findOrFail($id);

    return view('products.show', compact('product'));
    }

    public function ownerShow($id)
    {
    $product = Product::findOrFail($id);

    return view('products.owner_show', compact('product'));
    }

    public function store(Request $request)
    {
    // バリデーション
    $request->validate([
        'product_name' => 'required|max:255',
        'price' => 'required|integer',
        'stock' => 'required|integer',
        'description' => 'required',
        'img_path' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $imagePath = $request->file('img_path')->store('products', 'public');

    Product::create([
        'user_id' => auth()->id(),
        'company_id' => 1,
        'product_name' => $request->product_name,
        'price' => $request->price,
        'stock' => $request->stock,
        'description' => $request->description,
        'img_path' => $imagePath,
    ]);

    return redirect()->route('products.index')
        ->with('success', '商品を登録しました。');
    }

    public function edit($id)
    {
    $product = Product::findOrFail($id);

    return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'product_name' => 'required|max:255',
        'price' => 'required|integer',
        'stock' => 'required|integer',
        'description' => 'required',
        'img_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('img_path')) {
        $imagePath = $request->file('img_path')->store('products', 'public');
        $product->img_path = $imagePath;
    }

    $product->product_name = $request->product_name;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->description = $request->description;

    $product->save();

    return redirect()->route('products.owner.show', $product->id)
    ->with('success', '商品を更新しました。');
    }
    public function destroy($id)
    {
    $product = Product::findOrFail($id);

    $product->delete();

    return redirect()->route('products.index')
        ->with('success', '商品を削除しました。');
    }

    public function mypage()
    {
    $products = Product::where('user_id', auth()->id())->get();

    return view('products.mypage', compact('products'));
    }

}