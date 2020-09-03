<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Menu;
use Illuminate\Support\Facades\DB;
class FrontendController extends Controller
{
    public function index(){
    	$restaurants = Restaurant::all();
    	return view('frontend.index', compact('restaurants'));
    }

    public function resdetail($id)
    {
    	$restaurant = Restaurant::where('id',$id)->first();
       // dd($restaurant);
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

    public function searchTownship($id){
        $restaurants = Restaurant::where('township_id', $id)->get();
        return view('frontend.township', compact('restaurants'));
    }


    public function searchItem(Request $request){
        $keyword = $request->sItem;
        //dd($keyword);
        $searchitem = DB::table('restaurants')
            ->join('menus', 'restaurants.id', '=', 'menus.restaurant_id')
            ->select('restaurants.*','menus.name as menuname')
            ->where('menus.name', $keyword)
            ->get();
        // dd($searchitem);
        return $searchitem;
    }
}
