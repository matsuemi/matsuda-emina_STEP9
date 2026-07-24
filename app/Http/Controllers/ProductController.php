<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sale;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    $query = Product::where('user_id', '!=', auth()->id());

    if ($request->filled('keyword')) {
        $query->where('product_name', 'like', '%' . $request->keyword . '%');
    }

    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->get();

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

    return redirect()->route('mypage')
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

    $sales = Sale::with('product')->where('user_id', auth()->id())->get();

    return view('products.mypage', compact('products', 'sales'));
    }

    public function purchase($id)
    {
    $product = Product::with('company')->findOrFail($id);

    return view('products.purchase', compact('product'));
    }

    public function purchaseStore(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($id);

    if ($request->quantity > $product->stock) {
        return back()->with('error', '在庫が不足しています。');
    }

    Sale::create([
        'user_id' => auth()->id(),
        'product_id' => $product->id,
        'quantity' => $request->quantity,
    ]);

    $product->stock -= $request->quantity;
    $product->save();

    return redirect()->route('products.index')
    ->with('success', '商品を購入しました。');
}

}