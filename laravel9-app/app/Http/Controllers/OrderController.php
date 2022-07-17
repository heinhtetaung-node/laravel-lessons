<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class OrderController extends Controller
{
    //
    public function index() {
        $orders = Orders::with('customUser', 'orderItems')->get();

        $ordersLefjoin = Orders::select(
                            'orders.id',
                            'orders.created_at',
                            'orders.updated_at',
                            'user_id',
                            'custom_user.name',
                            'nickname',
                            'email',
                            'address',
                            'password',
                            // 'product_id',
                            // 'order_items.price',
                            // 'order_items.cost',
                            // 'order_id',
                            // 'desc',
                            // 'category_id',
                            // 'products.name AS pname'
                         )
                         ->selectRaw('SUM(order_items.price) AS totalprice')
                         ->selectRaw('SUM(order_items.cost) AS totalcost')
                          ->leftJoin('custom_user', 'custom_user.id', '=', 'orders.user_id')
                          ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
                          ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
                          ->groupBy('orders.id')
                        //->toSql();
                          ->get();
        /* 
        select 
        `orders`.`id`, `orders`.`created_at`, `orders`.`updated_at`, `user_id`, 
        `custom_user`.`name`, `nickname`, `email`, `address`, `password`, 
        SUM(order_items.price) AS totalprice, 
        SUM(order_items.cost) AS totalcost 
        from `orders` 
        left join `custom_user` on `custom_user`.`id` = `orders`.`user_id` 
        left join `order_items` on `order_items`.`order_id` = `orders`.`id` 
        left join `products` on `order_items`.`product_id` = `products`.`id` 
        group by `orders`.`id`
        */
        
        // echo '<pre>';
        // var_dump($ordersLefjoin);
        // exit;
        return view('order/index', ['orders' => $orders]);
    }

    public function detail($orderId) {
        $orderDetail = Orders::findOrFail($orderId)->with('customUser', 'orderItems.product')->first();
        return view('order/detail', ['order' => $orderDetail]);
    }
}
