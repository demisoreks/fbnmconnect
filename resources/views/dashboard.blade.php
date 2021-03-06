@extends('module', ['page_title' => 'Dashboard'])

@section('content')
<div class="row">
    <div class="col-lg-3">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>BIRTHDAYS</strong>
            </div>
            <div class="card-body text-center" style="height: 250px;">
                <div id="birthdays" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $max = 20;
                        $i = 0;
                        ?>
                        @foreach (App\HrmEmployee::where('status', 'Active')->whereRaw('DATE_FORMAT(date_of_birth, "%m%d") >= DATE_FORMAT(now(), "%m%d")')->orderByRaw('DATE_FORMAT(date_of_birth, "%m%d")')->get() as $celebrant)
                        <div class="carousel-item @if ($i == 0) active @endif">    
                            @if (File::exists('storage/pictures/'.$celebrant->id.'.jpg'))
                            {{ Html::image('storage/pictures/'.$celebrant->id.'.jpg', 'Staff picture', ['width' => '100', 'class' => 'rounded-circle']) }}
                            @else
                            {{ Html::image('images/dummy-profile.png', 'Staff picture', ['width' => '100', 'class' => 'rounded-circle']) }}
                            @endif
                            <p>
                                <h5>{{ $celebrant->first_name }}<br />{{ $celebrant->surname }}</h5>
                                <span class="text-info">{{ date('F j', strtotime($celebrant->date_of_birth)) }}</span>
                            </p>
                        </div>
                        <?php
                        $i ++;
                        if ($i >= $max) {
                            break;
                        }
                        ?>
                        @endforeach
                        @if ($i < $max)
                        @foreach (App\HrmEmployee::where('status', 'Active')->whereRaw('DATE_FORMAT(date_of_birth, "%m%d") < DATE_FORMAT(now(), "%m%d")')->orderByRaw('DATE_FORMAT(date_of_birth, "%m%d")')->get() as $celebrant)
                        <div class="carousel-item @if ($i == 0) active @endif">    
                            @if (File::exists('storage/pictures/'.$celebrant->id.'.jpg'))
                            {{ Html::image('storage/pictures/'.$celebrant->id.'.jpg', 'Staff picture', ['width' => '100', 'class' => 'rounded-circle']) }}
                            @else
                            {{ Html::image('images/dummy-profile.png', 'Staff picture', ['width' => '100', 'class' => 'rounded-circle']) }}
                            @endif
                            <p>
                                <h5>{{ $celebrant->first_name }}<br />{{ $celebrant->surname }}</h5>
                                <span class="text-info">{{ date('F j', strtotime($celebrant->date_of_birth)) }}</span>
                            </p>
                        </div>
                        <?php
                        $i ++;
                        if ($i >= $max) {
                            break;
                        }
                        ?>
                        @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#birthdays" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon text-info">&lt;</span>
                    </a>
                    <a class="carousel-control-next" href="#birthdays" role="button" data-slide="next">
                        <span class="carousel-control-next-icon text-info">&gt;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>MY CABAL</strong>
            </div>
            <div class="card-body" style="height: 250px;">
                {!! $cabal->container() !!}
                {!! $cabal->script() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>MD'S CORNER</strong>
            </div>
            <div class="card-body" style="height: 250px; overflow-y: scroll;">
                {{ Html::image('images/dummy-profile.png', 'MD picture', ['height' => '100px', 'class' => 'rounded float-left']) }}
                <p>MD's words will come here. MD's words will come here. MD's words will come here. MD's words will come here. </p>
                <p>MD's words will come here. MD's words will come here. MD's words will come here. MD's words will come here. </p>
                <p>MD's words will come here. MD's words will come here. MD's words will come here. MD's words will come here. </p>
                <p>MD's words will come here. MD's words will come here. MD's words will come here. MD's words will come here. </p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>MEDIA</strong>
            </div>
            <div class="card-body" style="height: 250px;">
                <div id="media" class="carousel slide text-center" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            {{ Html::image('images/slide/slide1.jpg', 'Slide 1', ['height' => '205']) }}
                        </div>
                        <div class="carousel-item">
                            {{ Html::image('images/slide/slide2.jpg', 'Slide 2', ['height' => '205']) }}
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#birthdays" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon text-info">&lt;</span>
                    </a>
                    <a class="carousel-control-next" href="#birthdays" role="button" data-slide="next">
                        <span class="carousel-control-next-icon text-info">&gt;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>RATES</strong>
            </div>
            <div class="card-body" style="height: 250px;">
                <div class="row" style="border-bottom: 1px solid #999; padding-bottom: 10px; margin-bottom: 20px;">
                    <div class="col-6 text-center text-primary">
                        <h1><i class="fas fa-dollar-sign"></i></h1>
                        <h3>364.50</h3>
                    </div>
                    <div class="col-6 text-center text-danger">
                        <h1><i class="fas fa-pound-sign"></i></h1>
                        <h3>450.02</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center text-warning">
                        <h1><i class="fas fa-yen-sign"></i></h1>
                        <h3>50.50</h3>
                    </div>
                    <div class="col-6 text-center text-success">
                        <h1><i class="fas fa-euro-sign"></i></h1>
                        <h3>410.55</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>BE INFORMED</strong>
            </div>
            <div class="card-body" style="height: 250px; overflow-y: scroll;">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="mb-1">&nbsp;</small>
                            <small>Today</small>
                        </div>
                        <p class="mb-1">FBN Mortgages MD visits Aso Rock</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="mb-1">&nbsp;</small>
                            <small class="text-muted">2 days ago</small>
                        </div>
                        <p class="mb-1">Godwin Emefiele appointed as CBN Governor</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="mb-1">&nbsp;</small>
                            <small class="text-muted">3 days ago</small>
                        </div>
                        <p class="mb-1">Naira gains tremendous value in the parallel market</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
	$('.carousel').carousel({
		interval: 3000,
		pause: "hover"
	});
    });
</script>
@endsection