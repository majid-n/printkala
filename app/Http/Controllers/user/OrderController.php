<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Sentinel;
use App\Basket;
use App\Order;
use App\Unit;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total  = 0;
        $user   = Sentinel::getUser();
        $unit   = Unit::all();
        $items  = Basket::select(DB::raw('products.name,products.pic,baskets.id,baskets.count,baskets.unit_id,baskets.price,baskets.product_id, baskets.price*baskets.count as total'))
                            ->join('products', 'products.id', '=', 'baskets.product_id')
                            ->where('baskets.user_id', '=',$user->id)
                            ->where('baskets.order_id', 0)
                            ->get();

        foreach ($items as $item) {
            $total += $item->total;
        }
        return view('cart.savecart', compact('items', 'total', 'user', 'unit'));
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
    public function store( Request $request )
    {
        $user   = Sentinel::getUser();
        $carts  = $user->baskets->where('order_id', 0);
        $sum    = 0;

        if( $carts->count() > 0 ) {
            foreach ($carts as $cart) {
                $sum += $cart->count * $cart->price;
            }
            
            $order          = new Order;
            $order->user_id = $user->id;
            $order->sum     = $sum + config('app.keraye');
            $order->address = $request->address;

            if( $order->save() ) {
                foreach ( $carts as $cartItem ) {
                    $cartItem->order_id = $order->id;
                    $cartItem->save();
                } 
                return back()->with('با موفقیت ثبت شد.');
            } else {
                return back()->withErrors('خطا در ارسال درخواست.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Order $order )
    {
        $user    = Sentinel::findById( $order->user_id );
        $unit    = Unit::all();
        $baskets = $user->baskets->where('order_id', $order->id);
        return view('cart.history', compact('order','baskets','unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Order $order )
    {
        $baskets = $order->user->baskets->where('order_id', $order->id);
        if( $order !== null ){
            if( $order->delete() ) {
                foreach ($baskets as $basket) {
                    $basket->delete();
                }
                return back()->with('با موفقیت ثبت شد.');
            }
        } else {
            return back()->withErrors('خطا در اتصال به پایگاه داده.');
        } 
    }
}
