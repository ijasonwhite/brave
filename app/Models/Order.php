<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'address1',
        'address2',
        'postcode',
        'city',
        'country',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


}
