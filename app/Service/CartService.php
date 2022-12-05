<?php

namespace App\Service;

use App\Models\Product;

class CartService
{

    private array $cart = [];

    public function __construct()
    {
        if(!session()->has("SESSION_CART")) {
            session()->put("SESSION_CART",$this->cart);
            session()->save();
        }
        else{
            $this->cart = session("SESSION_CART");
        }

    }

    public function getCart(){

        return $this->cart;
    }

    public function IsProductInCart(int $productId)
    {
        $keyP = null;
        if (count($this->cart)===0) return null;

        foreach($this->cart as $key => $value){
            if ($value->productId == $productId){
                $keyP = $key;
            }

        }

        return $keyP;

    }

    public function addProductCart(int $productId, int $quantity): bool{
        /** @var Product $product */
        $product = Product::query()->find($productId);
        if ($product){
            // Si product esta en el carro recupero el stock del item del carro en la base de datos y
            // le resto la nueva cantidad, finalmente
            $key = $this->IsProductInCart($productId);
            if($key !== null){
                $finalStock = (($product->stock+$this->cart[$key]->quantity)-$quantity);
                $product->update([
                    'stock'=>($finalStock)

                ]);
                $product = $product->refresh();
                $this->cart[$key]->product = $product;
                $this->cart[$key]->quantity = $quantity;
            }else{
                $product->update([
                    'stock'=>$product->stock-$quantity

                ]);
                $product = $product->refresh();

                $itemCart = (object)[
                    'productId'=>$productId,
                    'product'=>$product,
                    'quantity' => $quantity
                ];

                $this->cart[] = $itemCart;
            }
            session()->put("SESSION_CART",$this->cart);
            session()->save();

            return true;
        }else{
            return false;
        }
    }
    public function removeProductCart(int $productId): bool{
        /** @var Product $product */
        $product = Product::query()->find($productId);
        if($product){
            $key = $this->IsProductInCart($productId);
            if($key !== null){
                $product->update([
                    'stock'=>$product->stock+$this->cart[$key]->quantity

                ]);
                $product->refresh();

                unset($this->cart[$key]);
                session()->put("SESSION_CART",$this->cart);
                session()->save();
                return true;
            }
        }


        return false;

    }

    public function clearCart(){
        $this->cart = [];
        session()->put("SESSION_CART",$this->cart);
        session()->save();
    }




}
