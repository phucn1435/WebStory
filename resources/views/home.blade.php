@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">@yield('header_name')</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- @section('content1')
                        
                    @show --}}
                    @yield('content1')
                   
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
