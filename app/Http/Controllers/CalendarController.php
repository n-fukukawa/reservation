<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index($year = -1, $month = -1)
    {
        if($year === -1 || $month === -1){
            $year = now()->year;
            $month = now()->month;
        }

        return view('index', ['year' => $year, 'month' => $month]);

    }
}
