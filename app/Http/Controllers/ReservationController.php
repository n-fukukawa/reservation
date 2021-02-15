<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(Request $request)
    {
        $date = new Carbon($request->year.'-'.$request->month.'-'.$request->day);
        
        Reservation::where('student_id', Auth::id())->where('date', $date)->delete();

        foreach($request->classes as $class){
            $reservation = new Reservation;

            $reservation->student_id = Auth::id();
            $reservation->date = $date;
            $reservation->class = $class;

            $reservation->save();
        }

        $classes = Reservation::where('student_id', Auth::id())
            ->where('date', $date)
            ->orderBy('class')
            ->get()
            ->map(function ($reservation) {
                return $reservation->class;
            });

        return response()->json(['classes' => $classes]);
    }
}
