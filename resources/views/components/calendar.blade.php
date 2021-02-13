<div>
   <p>{{ $year }}年{{ $month }}月カレンダー</p>

   <div class="grid grid-cols-7 bg-white">

        <div class="cols-span-1 border">日</div>
        <div class="cols-span-1 border">月</div>
        <div class="cols-span-1 border">火</div>
        <div class="cols-span-1 border">水</div>
        <div class="cols-span-1 border">木</div>
        <div class="cols-span-1 border">金</div>
        <div class="cols-span-1 border">土</div>

       @for($i = 0; $i < count($calendar); $i++)
            <div class="cols-span-1 border">
                {{ $calendar[$i] }}
            </div>
        @endfor
        
   </div>
</div>