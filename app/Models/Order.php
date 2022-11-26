<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected  $table = "orders";


    protected $fillable = [
        'ammount',
        'shipping_address',
        'order_email',
        'order_date',
        'order_status'
    ];

    /**
     * @return HasOne
     */
    public function customer(): HasOne
    {
        return $this->hasOne( 'App\Customer', 'id', 'id_customer' );
    }

    /**
     * @return HasMany
     */
    public function ordersLines(): HasMany
    {
        return $this->hasMany( 'App\OrderLine', 'id_order', 'id' );
    }




}
