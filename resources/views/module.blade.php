@extends('app')

@section('module')
<div class="row">
    <div class="col-md-2">
        <div id="accordion" style="margin-bottom: 10px;">
            <div class="card">
                <div class="card-header bg-white" id="heading1" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            <strong>My Apps</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion">
                    <div class="card-body">
                        <nav class="nav flex-column">
                            @foreach (App\AccLink::where('active', true)->where('general', false)->orderBy('order_no')->get() as $link)
                                @if (count(App\Http\Controllers\LoginController::getRoles($link)) > 0)
                                <a class="nav-link" href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
                                @endif
                            @endforeach
                        </nav>
                    </div>
                </div> 
            </div>
            <div class="card">
                <div class="card-header bg-white" id="heading2" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                            <strong>General Apps</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion">
                    <div class="card-body">
                        <nav class="nav flex-column">
                            @foreach (App\AccLink::where('active', true)->where('general', true)->orderBy('order_no')->get() as $link)
                            <a class="nav-link" href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
                            @endforeach
                        </nav>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-10">
        @yield('content')
    </div>
</div>
@endsection