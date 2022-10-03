<?php

namespace App\Http\Controllers;

use App\Models\Order;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AnalysisController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $startDate = '2022-08-01';
        $endDate = '2022-08-31';

        // $period = Order::betweenDate($startDate, $endDate)
        //     ->groupBy('id')
        //     ->selectRaw('id, sum(subtotal) as total, customer_name, status, created_at')
        //     ->orderBy('created_at')
        //     ->paginate(50);

        // $subQuery = Order::betweenDate($startDate, $endDate)
        //     ->where('status', true)
        //     ->groupBy('id')
        //     ->selectRaw('id, sum(subtotal) as totalPerPurchase, DATE_FORMAT(created_at, "%Y%m%d") as date');
        // $data = DB::table($subQuery)
        //     ->groupBy('date')
        //     ->selectRaw('date, sum(totalPerPurchase) as total')
        //     ->get();

        $subQuery = Order::betweenDate($startDate, $endDate)
            ->groupBy('id')
            ->selectRaw('id, customer_id, customer_name, sum(subtotal) as totalPerPurchase');

        $subQuery = DB::table($subQuery)
            ->groupBy('customer_id')
            ->selectRaw('customer_id, customer_name, sum(totalPerPurchase) as total')
            ->orderBy('total', 'desc');

        DB::statement('set @row_num = 0;');
        $subQuery = DB::table($subQuery)
            ->selectRaw('@row_num := @row_num + 1 as row_num, customer_id, customer_name, total')
            ->get();
        dd($subQuery);

        return Inertia::render('Analysis');
    }
}
