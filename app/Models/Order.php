<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table="orders";
    public function getproduct()
    {
    	return $this->hasmany(Product::class);
    }
    public function user()
    {
    	return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function orderItem()
    {
    	return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    
}
