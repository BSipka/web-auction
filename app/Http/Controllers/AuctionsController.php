<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use App\Models\Offer;
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
       
        $auctions = Auction::orderBy('updated_at','DESC')->get();
        $categories = Category::all();
        foreach($auctions as $auction){
          $days =  Carbon\Carbon::parse($auction->created_at)->diffInDays($auction->valid_until);
            if($days>10 || $days=0){
                $findAuction = Auction::find($auction->id);
                $offers = $findAuction->offers;
                if($offers){
                    foreach($offers as $offer)
                         {
                           $offer->delete();
                         }
                  }
                $findAuction->delete();
            }
    
        }
       
        return view('auctions.index',[ 'auctions'=>$auctions,'categories'=>$categories]);
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
             $auctionUpdate = Auction::find($auction->id);
             Log::info($auctionUpdate);
             $userBalance = User::find(Auth::user()->id);
             $total = $bid - $auction->largest_bid;
             $userBalance->balance -= $total;
             $userBalance->save();                
                                  
             $auctionUpdate->update([
                    'largest_bid' => $bid,
                                  ]);
                            
            $makeOffer = Offer::create([
                
            'user_id'=> Auth::user()->id,    
            'seller_id'=>$auction->item->seller_id,
            'item_id'=>$auction->item->id,
            'auction_id'=>$auction->id,
            'bid'=>$bid
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
        $offers = $findAuction->offers;
        if($offers){
            foreach($offers as $offer){
                $offer->delete();
            }
        }
        if($findAuction->delete()){
            return redirect()->back()->with('error','Auction deactivated.');
        }   
        return back()->withInput()->with('error','Item can`t be deleted.');
    }

    public function search(Request $request){

            $category_id= $request->input('category_id');
            if($category_id != null){
                 $auctions = Auction::whereHas('item', function($query) use($category_id) {
                           $query->where('category_id', $category_id);
                           })->get();

            $categories = Category::all();
            $cat = $categories->find($category_id);
             
            return view('auctions.search',['auctions'=>$auctions,'categories'=>$categories,'category_name'=>$cat->category_name]);
            }
            return redirect()->route('auctions.index');
    }
}
