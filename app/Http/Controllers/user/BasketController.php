<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Basket;
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
        $items = Basket::select(DB::raw('baskets.id,products.price,products.name,products.pic,baskets.count,baskets.product_id,baskets.count*products.price as total'))
                ->join('products', 'products.id', '=', 'baskets.product_id')
                ->where('baskets.user_id', '=',Sentinel::getUser()->id)
                ->where('baskets.order_id', 0)
                ->get();
        $num = Basket::where('user_id', Sentinel::getUser()->id)
                     ->where('order_id', 0)
                     ->count();


        foreach ($items as $item) {
            $totalprice += $item->total;
        }

        return  response()->json(
            [
                'result'    => true,
                'count'     => $num,
                'cartdata'  => view( 'cart', array( 'items' => $items, 'total' => $totalprice) )->render()
            ]
        );
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

            $pid = intval( $request->input('pid') );
            $user = Sentinel::getUser();
            // $exist = Basket::where('product_id', $pid)
            //                ->where('user_id', $user )
            //                ->where('order_id', 0 )
            //                ->first();

            $exist = $user->baskets()->where('product_id', $pid)
                                     ->where('order_id', 0)->first();
            // dd($exist->count());
            if( $exist == null ){

                $basket = new Basket;
                $basket->user_id = $user->id;
                $basket->product_id = $pid;
                $basket->count = 1;
                if ( $basket->save() ) {
                    if( $request->ajax() ) return response()->json([ 'result' => 'add' ]);
                    else return redirect()->home()->with('success', 'محصول به سبد خرید اضافه شد.');
                }

            } else {
                
                $exist->count += 1;

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