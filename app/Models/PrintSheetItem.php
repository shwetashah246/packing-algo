<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PrintSheet;
use App\Models\OrderItem;

class PrintSheetItem extends Model
{
    protected $primaryKey = 'psi_id';

	protected $fillable = [
        'order_item_id', 'image_url', 'x_pos', 'y_pos', 'width', 'height', 'psi_status', 
    ];

    //
    public function printSheet()
	{
		return $this->belongsTo(PrintSheet::class,'ps_id','ps_id');
	}

    public function orderItem()
	{
		return $this->belongsTo(OrderItem::class,'order_item_id','order_item_id');
	}
}
