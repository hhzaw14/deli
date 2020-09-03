<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Menu;
use Illuminate\Support\Facades\DB;


class OrderlistController extends Controller
{
    
    public function index(){

    	$orders=Order::all();
    	return view('backend.orderlist.orderlist',compact('orders'));
    }

    public function orderdetail($id){

    	$order=Order::find($id);

    	$orderdetails=DB::table('orderdetails')
            ->join('menus', 'menus.id', '=', 'orderdetails.menu_id')
 			->where('orderdetails.order_id','=',$id)
            ->select('orderdetails.*', 'menus.name as menu_name','menus.price as menu_price')
            ->get();
    	// dd($order);
    	return view('backend.orderlist.orderdetail',compact("orderdetails",'order'));
    }
}
