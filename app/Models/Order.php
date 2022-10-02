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
    private int $id;
    private float $ammount;
    private string $shipping_address;
    private string $order_email;
    private \DateTime $order_date;
    private string $order_status;

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

    /**
     * @return float
     */
    public function getAmmount(): float
    {
        return $this->ammount;
    }

    /**
     * @param float $ammount
     */
    public function setAmmount(float $ammount): void
    {
        $this->ammount = $ammount;
    }

    /**
     * @return string
     */
    public function getShippingAddress(): string
    {
        return $this->shipping_address;
    }

    /**
     * @param string $shipping_address
     */
    public function setShippingAddress(string $shipping_address): void
    {
        $this->shipping_address = $shipping_address;
    }

    /**
     * @return string
     */
    public function getOrderEmail(): string
    {
        return $this->order_email;
    }

    /**
     * @param string $order_email
     */
    public function setOrderEmail(string $order_email): void
    {
        $this->order_email = $order_email;
    }

    /**
     * @return \DateTime
     */
    public function getOrderDate(): \DateTime
    {
        return $this->order_date;
    }

    /**
     * @param \DateTime $order_date
     */
    public function setOrderDate(\DateTime $order_date): void
    {
        $this->order_date = $order_date;
    }

    /**
     * @return string
     */
    public function getOrderStatus(): string
    {
        return $this->order_status;
    }

    /**
     * @param string $order_status
     */
    public function setOrderStatus(string $order_status): void
    {
        $this->order_status = $order_status;
    }


}
