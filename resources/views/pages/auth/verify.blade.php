@extends('template.master')
@section('title', 'Verify')

@section('content')
    <div class="flex justify-center items-center h-screen">
        @if ($status == 'error')
            <p class="text-red-500">Status: {{ $status }}</p>
        @else
            <p class="text-green-500">Status: {{ $status }}</p>
        @endif
        <p class="text-white">Message: {{ $message }}</p>
    </div>
@endsection