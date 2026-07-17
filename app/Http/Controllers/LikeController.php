<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;

class LikeController extends Controller
{
    public function toggle(Product $product)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($like) {
            // いいね済みなら削除
            $like->delete();
        } else {
            // まだなら登録
            Like::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]);
        }

        return back();
    }
}