<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipper;
use App\Models\Auction;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orders = Order::where('from',Auth::user()->id)->orderBy('created_at','DESC')->get();
       Log::info($orders);
       return view('orders.index',['orders'=>$orders]);
    }

    public function purchases(){
        $orders = Order::where('to',Auth::user()->id)->orderBy('created_at','DESC')->get();
       Log::info($orders);
       return view('orders.index',['orders'=>$orders]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($auction_id)
    {
            
              $auction = Auction::with('item')->find($auction_id);
            $shippers = Shipper::all();
            $payments = Payment::all();
      
       return view('orders.create',['shippers'=>$shippers,'payments'=>$payments,'auction_id'=>$auction_id,'auction'=>$auction]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $auction_id = $request->input('auction_id');
       
        $auction = Auction::with('item')->find($auction_id);
        
        $exists =   Order::where('from',$auction->item->seller_id)->where('to',Auth::user()->id);
        Auction::find($auction_id)->update([
             'sold_to'=>Auth::user()->id,
             'sold_at'=>Carbon\Carbon::now()
        ]);
        
        if(!$exists){
        $newOrder = Order::create([
            'from'=>$auction->item->seller_id,
            'to'=>Auth::user()->id,
            'max_price'=>$auction->item->max_price,
            'shipper_id'=>$request->input('shipper_id'),
            'payment_id'=>$request->input('payment_id'),
            'item_id'=>$auction->item->id
       ]);
        }

       if(isset($newOrder)){

           return redirect()->route('orders.index')->with('success','Ordered successfully!');
       }

       return redirect()->back()->with('errors','Error on create new item!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order = Order::find($order->id);
        return view('orders.show',['order'=>$order]);
    }

    public function destroy(Order $order)
    {
        $findOrder = Order::find($order->id);

        if($findOrder->delete()){
            return redirect()->route('orders.index')->with('success','Item was deleted successfully.');
        }

        return back()->withInput()->with('error','Item can`t be deleted.');
    }

}
