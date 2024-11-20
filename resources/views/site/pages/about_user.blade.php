@extends('site.layout.app')
@section('title', $user->name)
@section('content')
    <section class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center logo mb-5">
                        <img src="https://waqfsawir.net/img/logo.png" width="200" alt="">
                    </div>
                    <div class="content-text text-justify">
                        <p dir="rtl">{!! $user->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
