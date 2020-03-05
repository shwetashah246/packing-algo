<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\PrintSheet;
use App\Models\User;

class Order extends Model
{
	protected $primaryKey = 'order_id';

	protected $fillable = [
        'order_number', 'customer_id', 'fulfillment_status', 'fulfilled_date', 'order_status', 
    ];

    //
    public function orderItems()
	{
		return $this->hasMany(OrderItem::class,'order_id','order_id');
	}

	public function customer()
	{
		return $this->belongsTo(User::class,'customer_id','id');
	}

	public function printSheet()
	{
		return $this->hasMany(PrintSheet::class,'order_id','order_id');
	}
}