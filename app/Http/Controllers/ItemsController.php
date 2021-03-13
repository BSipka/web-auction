<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Auction;
use App\Models\Category;
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
        $items = Item::where('seller_id',Auth::user()->id)->get();
        
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
       return view('items.create',['category_id'=>$category_id,'categories'=>$categories]);
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
            'starting_price'=>$request->input('starting_price'),
            'max_price'=>$request->input('max_price'),
            'category_id'=>$request->input('category_id'),
            'seller_id'=>Auth::user()->id
       ]);

       if($newItem){
           return redirect()->route('items.show',['item'=>$newItem->id])->with('success','Item is added successfully!');
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
        //
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
        //
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
