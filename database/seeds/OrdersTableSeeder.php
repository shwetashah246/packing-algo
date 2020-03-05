<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$products  = Product::all();
    	$users     = User::all();

		$lastOrder = Order::orderBy('order_id', 'desc')->first();
		$last_order_id = isset($lastOrder->order_id) ? $lastOrder->order_id : null;

		for($i = 0; $i < rand(1, 20); $i++) {
			$order = [	
				'order_number' => $this->getOrderNumber($last_order_id),
				'customer_id'  => $users->random()->id,
			];

			$last_order_id = Order::create($order)->order_id;
			$used = [];
			for ($j = 0; $j < rand(1, 6); $j++)
			{
				$product = $products->random();
				if (!in_array($product->product_id, $used))
				{
					OrderItem::create([
						"order_id"   => $last_order_id,
						"product_id" => $product->product_id,
						"price"      => $product->price,
						"quantity"   => rand(1, 3),
					]);
					$used[] = $product->product_id;
				}
			}
		}
      	
    }

    private function getOrderNumber($order_id = 0)
    {
		$number = ( $order_id == 0 ) ? 1 : $order_id+1;
	
		return 'ORD' . sprintf('%06d', $number);
    }
}