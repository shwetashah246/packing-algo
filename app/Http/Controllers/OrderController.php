<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PrintSheet;
use App\Models\PrintSheetItem;
use App\Repositories\Repository;
use App\Services\BinTreePacking;

class OrderController extends Controller
{

	protected $model;
	protected $print_sheet =[];

	public function __construct(Order $order)
	{
		$this->model = new Repository($order);
	}

    public function index(){
		$orders = $this->model->with(['orderItems.product','customer'])->get();
		//dump($orders->toArray());
		return view('order.list', ['orders' =>$orders]);
	}

    public function details($id){
		$order = $this->model->show($id);
		$order->load(['orderItems.product','customer']);
		//dump($order->toArray());
		return view('order.details', ['order' =>$order]);
	}

	public function print($id){

		$order = $this->model->show($id);
		$order->load(['printSheet.printSheetItems']);

		$sheet_w = 1000;
		$sheet_h = 1500;

		if(count($order->printSheet)>0){
			$printSheet = $order->printSheet;
			//dump($order->printSheet);
			//dd($order->toArray());

			$sheets = [];
			foreach ($printSheet as $items) {
				$tmp = [];
        		foreach ($items->printSheetItems as $item) {
        			$tmp[] = [
	    				'w'    	   => $item->width, 
	    				'h'    	   => $item->height, 
	    				'x_pos'    => $item->x_pos, 
	    				'y_pos'    => $item->y_pos, 
	        		];
        		}
        		$sheets[] = $tmp;
        	}
    		//dd($sheets);
		}else{

			//$order->load(['orderItems.product']);
			//dd($order->toArray());

			$images = [];
			foreach ($order->orderItems as $item) {
				for ($i=0; $i < $item->quantity; $i++) {
			   		$images[] = ['w'=> $item->product->width,'h'=> $item->product->height, 'order_item_id' => $item->order_item_id];
				}
			}
	        $sheets = handlePrinting($images, $sheet_w, $sheet_h);
			//dd($sheets);

        	$printSheetModel = new Repository(new PrintSheet);
        	$printSheetItemModel = new Repository(new PrintSheetItem);

	        foreach ($sheets as $items) {
        		$printSheet = $printSheetModel->create([
    				'width'    => $sheet_w, 
    				'height'   => $sheet_h,  
    				'order_id' => $order->order_id
        		]);
        		$insert_items = [];
        		foreach ($items as $item) {
        			$insert_items[] = [
	    				'ps_id'    => $printSheet->ps_id, 
	    				'x_pos'    => $item['fit']->x, 
	    				'y_pos'    => $item['fit']->y, 
	    				'width'    => $item['w'], 
	    				'height'   => $item['h'],  
	    				'order_item_id' => $item['order_item_id']
	        		];
        		}
        		$printSheetitems = $printSheetItemModel->insert($insert_items);
        	}
	        
		}

        foreach ($sheets as $items) {
        	$canvas = imagecreatetruecolor($sheet_w, $sheet_h);
        	ob_start();
        	foreach ($items as $item) {
        		$src = imagecreatetruecolor( $item['w'], $item['h']);
				$color = imagecolorallocate($canvas, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
				imagefill($src, 0, 0, $color);
				imagecopy($canvas, $src, isset($item['x_pos']) ? $item['x_pos'] : $item['fit']->x, isset($item['y_pos']) ? $item['y_pos'] : $item['fit']->y, 0, 0, $item['w'], $item['h']);
        	}
        	imagepng($canvas);

			//Store the contents of the output buffer
			$image_data = ob_get_contents();
			// Clean the output buffer and turn off output buffering
			ob_end_clean();

			imagedestroy($canvas);

			$image_data_base64 = base64_encode ($image_data);
			echo '<img src="data:image/png;base64,'.$image_data_base64.'" />';echo '<br><br><br>';
        }
        
	} 

}



