<div>
    <div class="flex text-center">
        <a href="/{{ $carbon->copy()->addMonthsNoOverflow(-1)->year }}/{{ $carbon->copy()->addMonthsNoOverflow(-1)->month }}">前月へ</a>
        <p class="flex-grow">{{ $carbon->year }}年{{ $carbon->month }}月</p>
        <a href="/{{ $carbon->copy()->addMonthsNoOverflow()->year }}/{{ $carbon->copy()->addMonthsNoOverflow()->month }}">次月へ</a>
    </div>

   <div class="grid grid-cols-7 bg-white">

        <div class="cols-span-1 border">日</div>
        <div class="cols-span-1 border">月</div>
        <div class="cols-span-1 border">火</div>
        <div class="cols-span-1 border">水</div>
        <div class="cols-span-1 border">木</div>
        <div class="cols-span-1 border">金</div>
        <div class="cols-span-1 border">土</div>

       @for($i = 0; $i < count($calendar); $i++)
            <calendar-cell :year="{{ $carbon->year }}" :month="{{ $carbon->month }}" :day='@json($calendar[$i])' :key="{{ $i }}">
            </calendar-cell>
        @endfor
        
    </div>

</div>