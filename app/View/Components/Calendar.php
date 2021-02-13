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
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
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
        $dayOfFirst = $carbon->dayOfWeek;
        $lastOfMonth = $carbon->lastOfMonth()->day;

        $calendar = [];
        //月初の曜日までを空白で用意（例えば、月初が水曜日の場合は$dayOfFirst = 3となり、日、月、火の３日分を空白にする）
        $calendar = array_pad($calendar, $dayOfFirst, '');

        //１日から月末まで格納
        $array = range(1, $lastOfMonth);

        $calendar = array_merge($calendar, $array);

        //月末より後ろのマスを空白で用意
        $calendar = array_pad($calendar, WEEKDAYS * ROWS_OF_CALENDAR, '');

        return view('components.calendar', [
            'year' => $this->year,
            'month' => $this->month,
            'calendar'  => $calendar,
            ]);
    }
}
