<?php

namespace App\View\Components;

use Illuminate\View\Component;

use Carbon\Carbon;

class Calendar extends Component
{

    /**
     * 
     * @var integer
     * 
     */
    private $year;

    /**
     * 
     * @var integer
     * 
     */
    private $month;

    /**
     * 
     * @var integer
     * 
     */
    private $reservations;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($year, $month, $reservations)
    {
        $this->year = $year;
        $this->month = $month;
        $this->reservations = $reservations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        define('WEEKDAYS', 7);
        define('ROWS_OF_CALENDAR', 6);

        $date = "{$this->year}-{$this->month}";
        $carbon = Carbon::parse($date);
        $dayOfFirst = $carbon->copy()->dayOfWeek;
        $lastOfMonth = $carbon->copy()->lastOfMonth()->day;

        $days = [];

        //月初の曜日までを空白で用意（例えば、月初が水曜日の場合は$dayOfFirst = 3となり、日、月、火の３日分を空白にする）
        $days = array_pad($days, $dayOfFirst, '');

        //１日から月末まで格納
        $array = range(1, $lastOfMonth);

        $days = array_merge($days, $array);

        //月末より後ろのマスを空白で用意
        $days = array_pad($days, WEEKDAYS * ROWS_OF_CALENDAR, '');

        return view('components.calendar', [
            'carbon'        => $carbon,
            'days'          => $days,
            'reservations'  => $this->reservations,
            ]);
    }
}
