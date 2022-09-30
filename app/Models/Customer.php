<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected  $table = "customers";

    protected $fillable = [
        'email',
        'full_name',
        'billing_address',
        'country',
        'phone'
    ];

    protected $hidden = [
        'password_hashed'
    ];

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany( 'App\Order', 'id_customer', 'id' );
    }
}
