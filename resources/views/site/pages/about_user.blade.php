@extends('site.layout.app')
@section('title', $user->name)
@section('content')
    <section class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center logo mb-5">
                        <img src={{ Storage::disk('public')->url($settings->logo) }} width="200" alt="">
                    </div>
                    <div class="content-text text-justify">
                        <p dir="rtl">{!! $user->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="mb-2"><a class="btn-block btn btn-primary base_color" target="_blank"
                            href="{{ $settings->donation_link }}">تصدق الآن </a></div>
                    <div class="mb-2"><a class="btn-block btn btn-primary-light base_color"
                            href="https://wa.me/{{ $settings->whatsapp }}">اطلب مصحف بإسمك</a></div>
                </div>
            </div>
        </div>
    </section>
@endsection
