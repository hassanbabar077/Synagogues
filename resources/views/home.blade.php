{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @can('view administrator button')
                    <button>Administrator</button>
                    @endcan

                    @can('view viewer button')
                    <button>Viewer</button>
                    @endcan

                    @can('view content manager button')
                    <button>Content Manager</button>
                    @endcan

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
<h1>HELLO</h1>
                <div class="card-body">
                    @if (auth()->user()->roles->isEmpty())
                        <button>Guest</button>
                    @else
                        @if (auth()->user()->hasRole('administrator'))
                        <button>Administrator</button>
                        @endif

                        @if (auth()->user()->hasRole('viewer'))
                        <button>Viewer</button>
                        @endif

                        @if (auth()->user()->hasRole('contentmanager'))
                        <button>Content Manager</button>
                        @endif
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

