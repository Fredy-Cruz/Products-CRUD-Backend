<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductsController extends Controller
{
    //Display a all the avaliable products.
    public function index()
    {
        //Getting only the products that are not disabled
        $products = Product::where('disabled', false)->get();

        return response()->json([
            'message' => 'Get all products',
            'data' => $products
        ], 200);
    }


    //Store a newly created product in storage.
    public function store(Request $request)
    {
        //Validating the request
        $validator = Validator::make($request->all(),[
            'name' => 'required | min:2 | max:90',
            'description' => 'required | min:10 | max:255',
            'unit_price' => 'required | decimal:0,2 | gte:0.01 | lte:2000.00',
            'stock' => 'required | integer | gte:0 | lte:1000'
        ]);

        if($validator->fails()){
            return response()->json([
                "message" => "Invalid request"
            ], 400);
        }

        //Creating a new product
        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Store a new product',
            'data' => $product
        ], 201);
    }


    //Display the specified product.
    public function show(string $id)
    {
        $product = Product::where('id', $id)->where('disabled', false)->first();
        //Validate if the product exists and is not disabled
        if(!$product){
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }else{
            return response()->json([
                'message' => 'Get a product',
                'data' => $product
            ], 200);
        }
    }

    //Update an specified product.
    public function update(Request $request, string $id)
    {
        $product = Product::where('id', $id)->where('disabled', false)->first();
        //Validate if the product exists and is not disabled
        if(!$product){
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        //Validating the request
        $validator = Validator::make($request->all(),[
            'name' => ' min:2 | max:90',
            'description' => 'min:10 | max:255',
            'unit_price' => 'decimal:0,2 | gte:0.01 | lte:2000.00'
        ]);
        
        if($validator->fails() || !($request->all())){
            return response()->json([
                "message" => "Invalid request"
            ], 400);
        }

        //Updating the product
        if($request->name)
        	$product->name = $request->name;
        if($request->description)
        	$product->description = $request->description;
        if($request->unit_price)
        	$product->unit_price = $request->unit_price;
        $product->save();
        
        return response()->json([
            'message' => 'Product updated',
            'data' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'message' => 'Delete a product',
            'data' => $product
        ], 200);
    }
}
