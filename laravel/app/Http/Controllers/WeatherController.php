<?php

namespace App\Http\Controllers;

use DB;

class WeatherController extends Controller
{
   /* public function index(){
        $current_weather = DB::table('current')
            ->select('id','temp_actual')
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        return view('pages.index', compact('current_weather'));
    }*/

    public function show($id){
        $weather = DB::table('current')
            ->find($id);

        return view('pages.show', compact('weather'));
    }

    public function googleLineChart()
    {
        $current_weather = DB::table('current')
            ->select('id','temp_actual', 'data', 'hour', 'data_insert')
            ->orderBy('id', 'desc')
            ->limit(1000)
            ->get();

        return view('pages.index',compact('current_weather'));
    }



}
