<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderLine extends Model
{
    use HasFactory;

    protected  $table = "orders_lines";
    private int $id;
    private float $price;
    private string $sku;
    private int $quanity;

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

        if ($product->getStock() === 0) return;
        $product->setStock($product->getStock()-$this->getQuanity());
        $product->save();

    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return int
     */
    public function getQuanity(): int
    {
        return $this->quanity;
    }

    /**
     * @param int $quanity
     */
    public function setQuanity(int $quanity): void
    {
        $this->quanity = $quanity;
    }


}
