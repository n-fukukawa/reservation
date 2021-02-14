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
        $date = new Carbon($request->year.'-'.$request->month.'-'.$request->day);
        $reservations = Reservation::where('student_id', Auth::id())->where('date', $date)->get();

        $class = [];
        foreach($reservations as $reservation){
            $class[] = $reservation->class;
        }

        return response()->json(['class' => $class]);
    }

    public function store(Request $request)
    {
        $date = new Carbon($request->year.'-'.$request->month.'-'.$request->day);
        
        Reservation::where('student_id', Auth::id())->where('date', $date)->delete();

        foreach($request->schedule as $class){
            $reservation = new Reservation;

            $reservation->student_id = Auth::id();
            $reservation->date = $date;
            $reservation->class = $class;

            $reservation->save();
        }
    }
}
