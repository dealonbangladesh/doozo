<?php

namespace App\Http\Controllers\Backend;

use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MercurySeries\Flashy\Flashy;

class DashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $currentYear= Date('Y');
        $currentMonth = Date('m');
        $currentDate = Date('Y-m-d');

        $totalsell = Order::where('status', 'Delivered')->sum('billing_subtotal');
        $totalItem = Order::join('order_products','orders.id','=','order_products.order_id')
            ->where('status', 'Delivered')->count();


        $dailySell = Order::whereDate('created_at', '=', $currentDate)
            ->where('status', 'Delivered')
            ->sum('billing_subtotal');

        $dailyItem = Order::whereDate('created_at', '=', $currentDate)
            ->where('status', 'Delivered')
            ->count();

        $monthlySell = Order::whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->where('status', 'Delivered')
            ->sum('billing_subtotal');

        $monthlyItem = Order::whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->where('status', 'Delivered')
            ->count();

        $lastOrder = Order::OrderBy('created_at', 'DESC')->take(20)->get();



        $pendingOrder = Order::where('status', '=', 'Received')->count();
        $approvedOrder = Order::where('status', '=', 'Shipped')->count();
        $successfulOrder = Order::where('status', '=', 'Delivered')->count();
        $product = Product::all()->count();


        return view('backend.pages.dashboard')->with([
            'totalSell' =>$totalsell,
            'totalItem' =>$totalItem,
            'dailySell' => $dailySell,
            'dailyItem' => $dailyItem,
            'monthlySell' => $monthlySell,
            'monthlyItem' => $monthlyItem,
            'lastOrder' =>$lastOrder,
            'pendingOrder' =>$pendingOrder,
            'approvedOrder' =>$approvedOrder,
            'successOrder' =>$successfulOrder,
            'product' =>$product,
        ]);
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
        //
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
    public function destroy($id)
    {
        //
    }
}
