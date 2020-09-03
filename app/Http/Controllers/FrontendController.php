<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Menu;
use App\Township;
use Carbon\Carbon;
use App\Order;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
    	$restaurants = Restaurant::all();
    	return view('frontend.index', compact('restaurants'));
    }

    public function resdetail($id)
    {
    	$restaurant = Restaurant::find($id);
    	$menus = Menu::where('restaurant_id', $id )->get();
    	return view('frontend.restdetail', compact('menus', 'restaurant'));
    }

    public function detail($id)
    {
    	$menu = Menu::find($id);
    	return view('frontend.itemdetail', compact('menu'));
    }

    public function search(Request $request){
        $keyword = $request->id;
        $rid = $request->rid;
        //dd($keyword);

        $data = Menu::where('category_id', $keyword)
        ->where('restaurant_id', $rid)->get();

       // / dd($data);
        return $data;
    }

    public function cart(){
        return view('frontend.cart');
    }

    public function order(Request $request){
        $carts=json_decode($request->data);


        $address=$request->address;
        $townshipid=$request->townshipid;
        $orderdate=Carbon::now();
        $voucherno=uniqid();
        $status='order';

        $total=0;
        foreach($carts as $value){
            $total+=$value->price*$value->qty;
        }

        // dd($total);
        $auth=Auth::user();
        $userid=$auth->id;

        $townshipid=Township::find($townshipid);
        $deli_charges=$townshipid->charges;
        //dd($deli_charges);

        $order=new Order();
        $order->orderdate=$orderdate;
        $order->voucherno=$voucherno;
        $order->address=$address;
        $order->status=$status;
        $order->total=$total;
        $order->user_id=$userid;
        $order->deli_charges=$deli_charges;
        $order->save();

        foreach($carts as $value){
            $menuid=$value->id;
            $qty=$value->qty;
            $price=$value->price;
            $subtotal=$qty*$price;
            

        $order->menus()->attach($menuid,['qty'=>$qty, 'price'=>$price, 'subtotal'=>$subtotal]);
        }

         return response()->json([
            'status'=>'order successfully created!'
        ]);




    }
}
