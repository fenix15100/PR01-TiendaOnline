<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderLine extends Model
{
    use HasFactory;

    protected  $table = "orders_lines";

    protected $fillable = [
        'price',
        'sku',
        'quantity'
    ];

    /**
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne( 'App\Product', 'id', 'id_product' );
    }

    /**
     * @return HasOne
     */
    public function order(): HasOne
    {
        return $this->hasOne( 'App\Order', 'id', 'id_order' );
    }

    /**
     * @param Product $product
     * @return void
     */
    public function substractStock(Product $product): void
    {

        if ($product->stock === 0) return;
        $product->stock = ($product->stock - $this->quantity);
        $product->save();

    }




}
