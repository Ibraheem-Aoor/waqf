@extends('site.layout.app')
@section('title', 'الأذكار')
@section('content')
    <section class="section-content">
        <div class="container px-0">
            <div class="row">
                <div class="col-12 g-0">
                    <div class="col-12">
                        <div class="widget__items d-flex flex-wrap">
                            @foreach ($azkar as $zkr)
                                <a class="widget__item-3" href="{{ route('site.azkar.show' , encrypt($zkr->id)) }}">
                                    <div class="widget__item-image">
                                        <img src="{{ Storage::url($zkr->image) }}"
                                            alt="">
                                    </div>
                                    <div class="widget__item-content">
                                        <h6 class="widget__item-name">{{ $zkr->name }}</h6>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
