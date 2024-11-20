@extends('site.layout.app')
@section('title', $zkr->name)
@section('content')
    <section class="section-content">
        <div class="container ">
            <div class="row">
                <div class="col-12  ">
                    {!! $zkr->description !!}
                </div>
            </div>
        </div>

    </section>
@endsection
