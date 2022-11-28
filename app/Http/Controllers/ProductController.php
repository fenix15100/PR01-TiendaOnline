<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return View
     */
    public function showDetail(int $id): View
    {
        return view('product.productdetail',["p"=>Product::query()->find($id)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return new JsonResponse(Product::all(),200);
    }

    public function get( int $id): JsonResponse
    {
        if ($product = Product::query()->find($id)){
            return new JsonResponse($product,200);
        }else{
            return new JsonResponse($product,404);
        }

    }

    public function getCategoryByProduct(int $id):JsonResponse
    {
        /** @var Product $product */
        if ($product = Product::query()->find($id)){
            return new JsonResponse($product->categories(),200);
        }else{
            return new JsonResponse($product->categories(),404);
        }
    }

    public function create(Request $request): JsonResponse
    {
        $product = new Product();
        $product->fill($request->all())->save();
        return new JsonResponse($product,201);
    }
    public function update(Request $request,int $id): JsonResponse
    {
        $product = Product::query()->find($id);
        $product->update($request->all());
        return new JsonResponse($product,200);
    }


    public function delete(int $id): JsonResponse
    {
        $result = Product::destroy($id);
        if ($result){
            return new JsonResponse(
                ["message"=>"Producto Eliminado",
                    "id"=>$id
                ],200);
        }else{
            return new JsonResponse(["message"=>"No se pudo eliminar el producto"],500);
        }

    }


}
