<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index($year = -1, $month = -1)
    {
        if($year === -1 || $month === -1){
            $year = now()->year;
            $month = now()->month;
        }

        $date = new Carbon($year.'-'.$month);
        $firstDate = $date->copy()->firstOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        for($date = $firstDate; $date <= $endOfMonth; $date->addDay()){
            $reservations[$date->day] = Reservation::where('student_id', Auth::id())
                ->where('date', $date)
                ->orderBy('class')
                ->get()
                ->map(function($reservation) {
                    return $reservation->class;
                });
        }

        $reservations[''] = '';

        // return response()->json(['reservation' => $reservations]);

        return view('index', [
            'year' => $year, 
            'month' => $month,
            'reservations' => $reservations
            ]);

    }
}
