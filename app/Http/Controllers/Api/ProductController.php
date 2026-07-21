<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;

class ProductController extends Controller
{
    public function purchase(Request $request)
    {
        // リクエストから必要なデータを取得
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        // product_idを基に購入された商品情報を取得
        $product = Product::find($product_id);

        // 購入個数が在庫を上回る場合、処理終了
        if ($product->stock < $quantity) {
            return response()->json(['message' => '在庫が不足しています。'], 400);
        }

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);

            $product->decrement('stock', $quantity);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => '購入処理に失敗しました。'], 500);
        }

        return response()->json(['message' => '購入が完了しました。','order' => $sale,], 201);
    }
}