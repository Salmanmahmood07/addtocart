<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	public $table="cart";
    public function getproduct()
    {
    	return $this->hasmany(Product::class);
    }
    public function getuser()
    {
    	return $this->hasmany(User::class);
    }
}
