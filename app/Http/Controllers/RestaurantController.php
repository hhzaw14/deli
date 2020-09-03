<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Township;
use App\Cuisines;
use App\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('backend.restaurant.list', compact('restaurants'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $cuisines = Cuisines::all();
        $townships = Township::all();
        return view('backend.restaurant.new', compact('categories', 'cuisines', 'townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logo = $request->logo;
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $deliver_time = $request->deliver_time;
        $township_id = $request->township_id;
        $cuisine_id = $request->cuisine_id;
        $category_id = $request->category_id;

        // dd($category_id);

        $imgName = time().'.'.$logo->extension();

        $logo->move(public_path('images/restaurant'),$imgName);

        $filepath = 'images/restaurant/'.$imgName;

        $restaurant = new Restaurant;
        $restaurant->logo = $filepath;
        $restaurant->name = $name;
        $restaurant->phone = $phone;
        $restaurant->address = $address;
        $restaurant->deliver_time = $deliver_time;
        $restaurant->township_id = $township_id;
        $restaurant->cuisine_id = $cuisine_id;
       
        $restaurant->save();
        $restaurant->categories()->attach($category_id);

        return redirect()->route('restaurant.index');

        // dd($logo, $name, $phone, $address, $delivery_time, $township_id, $cuisine_id, $category_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $cuisines = Cuisines::all();
        $townships = Township::all();
        $restaurant = Restaurant::find($id);
        return view('backend.restaurant.edit', compact('restaurant', 'categories', 'cuisines', 'townships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $deliver_time = $request->deliver_time;
        $township_id = $request->township_id;
        $cuisine_id = $request->cuisine_id;

        $category_id = $request->category_id;

        $newlogo=$request->logo;
        $oldlogo=$request->oldLogo;

        // dd($newlogo);

        if($request->hasFile('logo')){

             $imageName=time().'.'.$newlogo->extension();

            $newlogo->move(public_path('images/restaurant'),$imageName);

            $filepath='images/restaurant/'.$imageName;

            if(\File::exists(public_path($oldlogo))){

                \File::delete(public_path($oldlogo));
            }


        }
        else{
            $filepath=$oldlogo;
        }

        $restaurant=Restaurant::find($id);
        $restaurant->logo = $filepath;
        $restaurant->name = $name;
        $restaurant->phone = $phone;
        $restaurant->address = $address;
        $restaurant->deliver_time = $deliver_time;
        $restaurant->township_id = $township_id;
        $restaurant->cuisine_id = $cuisine_id;
       
        $restaurant->save();

        $restaurant->categories()->attach($category_id);
        return redirect()->route('restaurant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->delete();
        return redirect()->route('restaurant.index');
    }
}
