@extends('layouts.app')

@section('content')
    @include('layouts.navbar')

    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-2xl mx-auto px-4">
            @yield('admin-content')
        </div>
    </div>

    @include('layouts.footer')
@endsection
