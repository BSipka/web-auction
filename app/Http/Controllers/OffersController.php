<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::where('seller_id',Auth::user()->id)->orderBy('updated_at','DESC')->get();
         if($offers){
            return view('offers.index',['offers'=>$offers]);
         }
        return view('offers.index');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show($item_id)
    {
        $offers = Offer::where('item_id',$item_id)->orderBy('created_at','DESC')->get();
        return view('offers.show',['offers'=>$offers]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $findOffer = Offer::find($offer->id);

        if($findOffer->delete()){
            return redirect()->route('offers.bids')->with('success','Bid was canceled successfully.');
        }

        return back()->withInput()->with('error','Item can`t be deleted.');
    }

    public function get_bids(){
        $offers = Offer::where('user_id',Auth::user()->id)->get();
        return view('offers.bids',['offers'=>$offers]);
    }
    public function get_offers(){
        $offer_count = Offer::where('seller_id',Auth::user()->id)->count();
        $bid_count = Offer::where('user_id',Auth::user()->id)->count();

        return json_encode([
            'offer_count'=>$offer_count,
            'bid_count'=>$bid_count
        ]);    
    }
}
