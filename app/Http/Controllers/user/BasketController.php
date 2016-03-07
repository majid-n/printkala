<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Basket;
use App\Unit;
use Sentinel;
use DB;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalprice = 0;
        $user       = Sentinel::getUser();
        $num        = $user->baskets->where('order_id', 0)->count();
        $items      = Basket::select(DB::raw('products.name,products.pic,baskets.id,baskets.count,baskets.unit_id,baskets.price,baskets.product_id, baskets.price*baskets.count as total'))
                            ->join('products', 'products.id', '=', 'baskets.product_id')
                            ->where('baskets.user_id', '=',$user->id)
                            ->where('baskets.order_id', 0)
                            ->get();

        foreach ($items as $item) {
            $totalprice += $item->total;
        }

        return response()->json([
            'result'     => true,
            'count'      => $num,
            'cartdata'   => view( 'cart', array( 'items' => $items, 'total' => $totalprice, 'unit' => Unit::all()) )->render()
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
    public function store( Request $request )
    {
        if( $request->has('pid') ) {

            $user   = Sentinel::getUser();
            $pid    = intval( $request->input('pid') );
            $unit   = intval( $request->input('unit') );
            $cnt    = intval( $request->input('cnt') );
            $prc    = intval( $request->input('prc') );
            $exist  = $user->baskets()->where('product_id', $pid)
                                      ->where('order_id', 0)
                                      ->first();

            if( $exist == null ){
                $basket             = new Basket;
                $basket->user_id    = $user->id;
                $basket->product_id = $pid;
                $basket->count      = $cnt;
                $basket->price      = $prc;
                $basket->unit_id    = $unit;
                if ( $basket->save() ) {
                    if( $request->ajax() ) return response()->json([ 'result' => 'add' ]);
                    else return redirect()->home()->with('success', 'محصول به سبد خرید اضافه شد.');
                }

            } else {
                
                $exist->count  += $cnt;
                $exist->unit_id = $unit;
                $exist->price   = $prc;

                if( $exist->save() ) {
                    if( $request->ajax() ) return response()->json([ 'result' => 'update' ]);
                    else return redirect()->home()->with('success', 'محصول به سبد خرید اضافه شد.');
                }
            }
        }

        if( $request->ajax() ) return response()->json([ 'result' => false ]);
        else return redirect()->home()->with('fail', 'خطا در اتصال به پایگاه داده.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Basket $basket , Request $request )
    {
        $user = Sentinel::getUser();

        if( $basket->delete() ) {

            if( $request->ajax() ) return response()->json([ 'delid' => $basket->id ]);
            else return redirect()->home()->with('success', 'محصول از سبد خرید حذف شد.');
        }

        if( $request->ajax() ) return response()->json([ 'result' => false ]);
        else return redirect()->home()->with('fail', 'خطا در اتصال به پایگاه داده.');
    }
}