<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Exception;

class ProductController extends Controller
{
    /**
     * Muestra todos los productos
     * @return Response
     */
    public function index(Request $request)
    {
        if  (is_null($request->searchName))
        {
            $data = Product::latest()->get();
        }
        else{
            $data = Product::where("name", "LIKE", $request->searchName)->get();
        }
        return response()->json(['200',ProductResource::collection($data)]);
    }


    /**
     * Almacena un recurso en DB
     * @param Request
     * @return Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name'        =>    'string',
            'description' =>    'string', 
            'image'       =>    'string', 
            'brand'       =>    'string', 
            'price'       =>    'numeric', 
            'price_sale'  =>    'numeric', 
            'category'    =>    'string', 
            'stock'       =>    'integer' 
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        try{
            $product = Product::create([
                'name'          => $request->name,                
                'description'   => $request->description,
                'image'         => $request->image,
                'brand'         => $request->brand,
                'price'         => $request->price,
                'price_sale'    => $request->price_sale,
                'category'      => $request->category,
                'stock'         => $request->stock,
            ]);
        }
        catch(Exception $e){
            return response()->json(['400']);
        }
        return response()->json(['201', new ProductResource($product)]);
    }

    /**
     * Muestra un Producto especificado
     * @Param int $id
     * @return Response
     */
    public function show(int $id)
    {
        $product = Product::find($id);
        if (is_null($product))
        {
            return response()->json('204');
        }
        return response()->json([new ProductResource($product)]);
    }

    /**
     * Actualiza el Producto especificado
     * @Param Request
     * @return Response 
     */
    public function update(Request $request, Product $product)
    {
        
        $validator = Validator::make($request->all(),[
            'name'        =>    'string',
            'description' =>    'string', 
            'image'       =>    'string', 
            'brand'       =>    'string', 
            'price'       =>    'numeric', 
            'price_sale'  =>    'numeric', 
            'category'    =>    'string', 
            'stock'       =>    'integer' 
        ]);

        if($validator->fails()){
            
            return response()->json([$validator->errors(),400]);
        }
        
        try{
        $product->name          = $request->name;                
        $product->description   = $request->description;
        $product->image         = $request->image;
        $product->brand         = $request->brand;
        $product->price         = $request->price;
        $product->price_sale    = $request->price_sale;
        $product->category      = $request->category;
        $product->stock         = $request->stock;

        $product->save();
        } catch(Exception $e) {
            return response()->json('400');
        }
        return response()->json(['200', new ProductResource($product)]);
    }

    /**
     * Borrar el Producto especificado
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json('200');
    }
}
