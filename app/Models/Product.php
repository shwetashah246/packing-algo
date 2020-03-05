<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Product extends Model
{
	protected $primaryKey = 'product_id';
	
	protected $fillable = [
        'title', 'width', 'height', 'price', 'inventory_quantity', 'design_url', 'published_state',
    ];
	
	public function orderItems()
	{
		return $this->hasMany(OrderItem::class,'product_id','product_id');
	}

}