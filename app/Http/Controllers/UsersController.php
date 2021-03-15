<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Models\Item;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);

        return json_encode([
             'name' => $user->name,
             'email' => $user->email,
             'first_name'=>$user->first_name,
             'middle_name'=>$user->middle_name,
             'last_name'=>$user->last_name,
             'city'=>$user->city,
             'balance'=>$user->balance
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::find($user->id);
        return view('users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $userUpdate = User::where('id',$user->id)
                                  ->update([
                                    'name' => $request->input('name'),
                                    'email' => $request->input('email'),
                                    'first_name'=>$request->input('first_name'),
                                    'middle_name'=>$request->input('middle_name'),
                                    'last_name'=>$request->input('last_name'),
                                    'city'=>$request->input('first_name')
                                    
                                  ]);
                            
        if($userUpdate){
            return redirect()->route('home')->with('success','Successfully updated Profile!');
        }                                  
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $id = $user->id;
        $findUser = User::find($id);
        

        if($findUser != null){
                $auctions = Auction::with('item')->whereHas('item', function($query) use($id) {
                $query->where('seller_id', $id);
                })->get();
                $findProducts = Item::where('seller_id',$id)->get();
               if($auctions)
               {
                foreach($auctions as $auction)
                {
                    if( $auction->offers ){
                      foreach($auction->offers as $offer){
                            $offer->delete();
                      }
                    }
                   $auction->delete();
                }
                
               }
               if($findProducts){
                   foreach($findProducts as $product){
                       $product->delete();
                   }
               }
             
             $findUser->delete();
            return redirect()->route('auctions.index')->with('success','Profile was deleted successfully.');
        }

        return back()->withInput()->with('error','Profile can`t be deleted.');
    }
}
