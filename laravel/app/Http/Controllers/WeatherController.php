<?php

namespace App\Http\Controllers;

class WeatherController extends Controller
{
    public function index(){
        $current_weather = \DB::table('current')
            ->select('id','temp_actual')
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        return view('weather.index', compact('current_weather'));
    }

    public function show($id){
        $weather = \DB::table('current')
            ->find($id);

        return view('weather.show', compact('weather'));
    }


}
