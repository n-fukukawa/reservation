<x-app-layout>
<x-slot name="header">
    ホーム
</x-slot>
<div>
<x-calendar :year="$year" :month="$month"></x-calendar>
<form action="{{ route('index')}}"></form>
</div>
</x-app-layout>