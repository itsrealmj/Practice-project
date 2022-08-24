<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\addedtocart;


class addedToCartController extends Controller
{
    //
    public function deleteCart(Request $request)
    {   
        $product = addedtocart::find($request->id);
        $result = $product->delete();
        // if($result) {
        // return redirect('/');

        // }
        

    }

    public function addToCart(Request $request)
    {
        $product = product::find($request->id);

        if(addedtocart::find($request->id)) {
            dd('added already');
        }
        
        $addedCart = new addedtocart;

        $addedCart->cart_product_name = $product->name;
        $addedCart->cart_product_desc = $product->description;
        $addedCart->cart_product_path = $product->file_path;
        $addedCart->cart_product_price = $product->price;
        $addedCart->cart_product_qty = 1;

        $addedCart->save();

        // return redirect('/');
    }

    public function getCarts()
    {
        $addedCarts = addedtocart::all();
        return $addedCarts;
    }

    
}
