@extends('site.layout.app')
@section('title', 'عن الوقف')
@section('content')
    <section class="section-content">
        <div class="container">
            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="widget__items d-flex flex-wrap">
                            @foreach ($reciters as $reciter)
                                @if (isset($reciter['moshaf']) && count($reciter['moshaf']) > 1)
                                    @foreach ($reciter['moshaf'] as $moshaf)
                                        <a class="widget__item-3" href="{{ route('site.quran.reciter.suwar' , ['id' => $reciter['id'] , 'rewaya' => $moshaf['id']]) }}">
                                            <div class="widget__item-image"><img src="{{ asset('images/placehoder.png') }}"
                                                    alt=""></div>
                                            <div class="widget__item-content">
                                                <h6 class="widget__item-name">{{ @$reciter['name'] }}</h6>
                                                <h6 class="widget__item-desc">{{ @$moshaf['name'] }}</h6>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <a class="widget__item-3" href="{{ route('site.quran.reciter.suwar' , [ 'id' => $reciter['id'] , 'rewaya' => $reciter['moshaf'][0]['id'] ]) }}">
                                        <div class="widget__item-image"><img src="{{ asset('images/placehoder.png') }}"
                                                alt=""></div>
                                        <div class="widget__item-content">
                                            <h6 class="widget__item-name">{{ @$reciter['name'] }}</h6>
                                            <h6 class="widget__item-desc">{{ @$reciter['moshaf'][0]['name'] }}</h6>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
