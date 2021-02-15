<x-app-layout>
<x-slot name="header">
    <a href="/">予約カレンダー</a>
</x-slot>
<div>
    <x-calendar :year="$year" :month="$month" :reservations="$reservations"></x-calendar>
</div>
</x-app-layout>