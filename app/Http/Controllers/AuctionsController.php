<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
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
    public function index(Request $request)
    {  
        
        $category_id = $request->category_id;
        $auctions = Auction::orderBy('updated_at','DESC')->get();
        $categories = Category::all();
        foreach($auctions as $auction){
          $days = Carbon\Carbon::now()->diffInDays($auction->created_at);
            if( $days > 10 || $auction->sold_at != null){
                $findAuction = Auction::find($auction->id);
                Log::info($findAuction->offers);
                if($findAuction->offers){
                   $latest =  $findAuction->offers->first();
                   Log::info($latest);
                   $item =  $findAuction->item;
                   Log::info($item);
                     Order::create([
                             'from'=>$item->seller_id,
                             'to'=> $latest->user_id,
                             'shipper_id'=> $item->shipper_id,
                             'payment_id'=> $item->payment_id,
                             'item_id'=>$item->id
                           ]);      
                }
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
        if($category_id != null){
              $auctions = Auction::whereHas('item', function($query) use($category_id) {
                      $query->where('category_id', $category_id);
                      })->orderBy('updated_at','DESC')->get();

              $categories = Category::all();
              $cat = $categories->find($category_id);
        
              return view('auctions.index')->with(['auctions'=>$auctions,'categories'=>$categories,'category_name'=>$cat->category_name]);
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
        

        if($bid > $auction->largest_bid && $bid < $auction->item->max_price){
             $auctionUpdate = Auction::find($auction->id);
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

    
}
