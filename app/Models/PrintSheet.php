<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PrintSheetItem;

class PrintSheet extends Model
{
    protected $table = 'print_sheet';

    protected $primaryKey = 'ps_id';

	protected $fillable = [
        'type', 'sheet_url', 'width', 'height', 'ps_status', 'order_id'
    ];

    //
    public function printSheetItems()
	{
		return $this->hasMany(PrintSheetItem::class,'ps_id','ps_id');
	}

}