<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
        $items = Item::where('seller_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('items.index',['items'=>$items]);
        }
        return view('auth.login');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category_id = null)
    {
        $categories = null;
        if(!$category_id){
            $categories = Category::all();
        }
        $payments = Payment::all();
        $shippers = Shipper::all();

       return view('items.create',['category_id'=>$category_id,'categories'=>$categories,'payments'=>$payments,'shippers'=>$shippers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = Item::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'image'=>$request->input('image'),
            'starting_price'=>$request->input('starting_price'),
            'max_price'=>$request->input('max_price'),
            'category_id'=>$request->input('category_id'),
            'payment_id'=>$request->input('payment_id'),
            'shipper_id'=>$request->input('shipper_id'),
            'seller_id'=>Auth::user()->id
       ]);

       if($newItem){
           return redirect()->route('items.index')->with('success','Item is added successfully!');
       }

       return redirect()->back()->with('errors','Error on create new item!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $item = Item::find($item->id);
       
        return view('items.show',['item'=>$item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $payments = Payment::all();
        $shippers = Shipper::all();
        $categories = Category::all();

        $item = Item::find($item->id);
        return view('items.edit',['item'=>$item,'payments'=>$payments,'shippers'=>$shippers,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        
        $itemUpdate = Item::where('id',$item->id)
        ->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'image'=>$request->input('image'),
            'starting_price'=>$request->input('starting_price'),
            'max_price'=>$request->input('max_price'),
            'category_id'=>$request->input('category_id'),
            'payment_id'=>$request->input('payment_id'),
            'shipper_id'=>$request->input('shipper_id'),
        ]);
  
        if($itemUpdate)
        {
            return redirect()->route('items.show',['item'=>$item->id])->with('success','Successfully updated product!');
        }                                  
            return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $findItem = Item::where('id',$item->id);

        if($findItem->delete()){
            return redirect()->route('items.index')->with('success','Item was deleted successfully.');
        }

        return back()->withInput()->with('error','Item can`t be deleted.');
    }
}
