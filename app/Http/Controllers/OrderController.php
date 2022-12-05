<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Service\CartService;
use App\Models\OrderLine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return new JsonResponse(Order::all(),200);
    }

    public function get( int $id): JsonResponse
    {
        if ($order = Order::query()->find($id)){
            return new JsonResponse($order,200);
        }else{
            return new JsonResponse($order,404);
        }

    }

    public function create(Request $request,CartService $cartService): JsonResponse
    {
        $cart = $cartService->getCart();
        $order = new Order();
        $order->fill($request->all())->save();
        $order = $order->refresh();


        foreach ($cart as $itemCart){
            $orderLine = new OrderLine([
                "sku" => $itemCart->product->sku,
                "quantity" => $itemCart->quantity,
                "price" => $itemCart->product->price,
            ]);
            $orderLine->product()->associate($itemCart->product);
            $orderLine->order()->associate($order);
            $orderLine->save();

        }

        $cartService->clearCart();

        return new JsonResponse($order,201);
    }

    public function delete(int $id): JsonResponse
    {
        $result = Order::destroy($id);
        if ($result){
            return new JsonResponse(
                ["message"=>"Pedido Eliminado",
                    "id"=>$id
                ],200);
        }else{
            return new JsonResponse(["message"=>"No se pudo eliminar El pedido"],500);
        }

    }
}

