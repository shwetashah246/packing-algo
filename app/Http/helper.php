<?php

use App\Services\BinTreePacking;


if (! function_exists('handlePrinting')) {
	
	function handlePrinting($images, $sheet_w, $sheet_h, $print_sheet=[]){
		$packer = new BinTreePacking($sheet_w, $sheet_h);
		$images = $packer->fit($images);

		$sheet = $new_sheet = [];
		foreach($images as $i=>$img) {
			if(!empty($img['fit']) && $img['fit']->used==true){
				$sheet[] = $img;
			}else{
				$new_sheet[] = $img;
			}
		}
		if(count($sheet)>0){ $print_sheet[] = $sheet;}
		if(count($new_sheet)>0) return handlePrinting($new_sheet, $sheet_w, $sheet_h, $print_sheet);
		else return $print_sheet;
	}
}

 