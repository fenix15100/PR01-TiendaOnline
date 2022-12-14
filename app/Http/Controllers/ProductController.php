<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Service\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @param CartService $cartService
     * @return View
     */

    public function showDetail(int $id, CartService $cartService): View
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

    public function addProductToCart(Request $request,int $id,CartService $cartService)
    {
        $quantity = $request->query('quantity',null);
        if ($quantity === null) return new JsonResponse(["message"=>"QueryParam quantity not suplied"],400);
        $quantity = (int)$quantity;

        /** @var Product $product */
        $product = Product::query()->find($id);

        if (!$product) return Redirect::back()->with('error','Product not found in DB');
        if ($product->stock<$quantity) return Redirect::back()->with('warning','Insufficient Stock');

        if($cartService->addProductCart($id,$quantity)){
            if ($request->isXmlHttpRequest()){
                return new JsonResponse(["message"=>"Product added to Cart"],200);
            }
            return Redirect::back()->with('success','Product added to Cart');

        }else{
            if ($request->isXmlHttpRequest()){
                return new JsonResponse(["message"=>"Product error adding to Cart"],500);
            }
            return Redirect::back()->with('error','Product error adding to Cart');
        }
    }

    public function removeProductCart(int $id,CartService $cartService): JsonResponse
    {
        /** @var Product $product */
        $product = Product::query()->find($id);
        if (!$product) return new JsonResponse(["message"=>"Product not found"],404);

        if($cartService->removeProductCart($id)){
            return new JsonResponse(["message"=>"Product removed from Cart","cart"=>$cartService->getCart()],200);
        }else{
            return new JsonResponse(["message"=>"Product error removing from Cart"],500);
        }
    }


}
