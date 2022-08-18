<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\product;


class productController extends Controller
{
    function getProducts(Request $request)
    {
        return product::paginate(3);
    }
    
    // create a function to be pass to API
    // Request keyword is from above
    // product keyword is from above which is the singular of table

    function addProduct(Request $req)
    {
        // instanciate a new product
        $product = new product;
        // product->name (table and value) $req->name (frontend inputs)
        $product->name = $req->name;
        $product->price = $req->price;
        $product->description = $req->description;

        $result = $product->save();

        if($result) {
            return redirect('/');
        }else {
            return 'Unable to save data';
        }
    }
    
    function deleteProduct(Request $req)
    {
        $id = $req->id;
        $product = product::find($id);
        $result = $product->delete();

        if($result) {
            return redirect('/');
        }
    }
    
    function updateProduct(Request $req)
    {
        $id = $req->id;
        $data = product::find($id);

        $data->name = $req->name;
        $data->price = $req->price;
        $data->description = $req->description;

        $data->save();
        return redirect('/');
    }


    
    



    // function editProduct(Request $req)
    // {
    //     $id = $req->id;
    //     $data = product::find($id);
    //     return view('editProduct',['data' => $data]);
    // }
}
