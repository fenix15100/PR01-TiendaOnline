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
        'order_status',
        'full_name',
        'billing_address',
        'country',
        'phone'
    ];

    /**
     * @return HasMany
     */
    public function ordersLines(): HasMany
    {
        return $this->hasMany( 'App\Models\OrderLine', 'id_order', 'id' );
    }




}
