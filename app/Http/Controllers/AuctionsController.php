<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon;

class AuctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  

     
        $auctions = Auction::orderBy('created_at','DESC')->get();
        $categories = Category::all();
        
        foreach($auctions as $auction){
          $days =   Carbon\Carbon::parse($auction->created_at)->diffInDays($auction->valid_until);
            if($days>'10' || $days='0'){
                $find = Auction::find($auction->id);
                $find->delete();
            }
        }
        return view('auctions.index',[ 'auctions'=>$auctions,'categories'=>$categories]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $find = Auction::where('item_id',$request->input('item_id'))->get();
        Log::info($find);
        if($find->isEmpty()){
            $newAuction = Auction::create([
                'item_id'=>$request->input('item_id'),
                'largest_bid'=>$request->input('starting_price'),
                ]);
            return redirect()->back()->with('success','You started auction successfully!');
        }
        return redirect()->route('auctions.show')->with('errors','Error on starting the auction!');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        $auction = Auction::find($auction->id);
      
        return view('auctions.show')->with(['auction'=>$auction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        // $auction = Auction::find($auction->id);
        // return view('auctions.edit',['auction'=>$auction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $auction)
    {
        $bid = $request->input('largest_bid');
        
       
        Log::info($bid);

        if($bid > $auction->largest_bid && $bid < $auction->item->max_price){
        $auctionUpdate = Auction::where('id',$auction->id);
        $userBalance = User::find(Auth::user()->id);
        $total = $bid - $auction->largest_bid;
        $userBalance->balance -= $total;
        $userBalance->save();                
                                  $auctionUpdate->update([
                                      'largest_bid' => $bid,
                                  ]);
                            
        
            return redirect()->route('auctions.show',['auction'=>$auction])->with('success','Successfully updated bid!');
        }                                  
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        $findAuction = Auction::find($auction->id);
        Log::info($findAuction);
        if($findAuction->delete()){
            return redirect()->back()->with('error','Auction deactivated.');
        }

        return back()->withInput()->with('error','Item can`t be deleted.');
    }
}
