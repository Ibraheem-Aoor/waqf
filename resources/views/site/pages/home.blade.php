@extends('site.layout.app')
@section('title', 'الصفحة الرئيسية')
@section('content')
    <section class="section-content">

        <div class="container">
            <div class="row mb-3">
                <div class="col-12 text-center p-2 rounded-pill" style="color:white; background-color : #30C084;">
                    وقف/ نوها ابراهيم


                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a class="widget__item-1" href="{{ route('site.quran.index') }}">
                        <div class="widget__item-image"><img src="https://waqfsawir.net/img/img-1.jpeg" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5">
                            <div class="widget__item-title text-white font-semi-bold">القرآن الكريم
                            </div>
                            <div class="widget__item-title text-white font-semi-bold"> &quot; مكتوب &quot;
                            </div>

                        </div>
                    </a>
                    <a class="widget__item-1" href="{{ route('site.quran.reciter.index') }}">
                        <div class="widget__item-image"><img src="https://waqfsawir.net/img/img-2.jpeg" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5 " style="left:0">
                            <div class="widget__item-title text-white font-semi-bold">القرآن الكريم
                            </div>
                            <div class="widget__item-title text-white font-semi-bold">
                                &quot; صوتي &quot;</div>
                        </div>
                    </a>
                    <a class="widget__item-1" href="{{ route('site.azkar.index') }}">
                        <div class="widget__item-image"><img src="https://waqfsawir.net/img/img-5.jpeg" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5">
                            <div class="widget__item-title text-white font-semi-bold">الأذكار</div>
                        </div>
                    </a>
                    <a class="widget__item-1" href="https://waqfsawir.net/noh-brhym/masbaha">
                        <div class="widget__item-image"><img src="https://waqfsawir.net/img/img-4.jpeg" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5" style="left:0">
                            <div class="widget__item-title text-white font-semi-bold">المسبحة الإلكترونية</div>
                        </div>
                    </a>
                    <a class="widget__item-1" href="{{ route('site.quran.sura', 18) }}">
                        <div class="widget__item-image"><img src="https://waqfsawir.net/img/img-8.png" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5">
                            <div class="widget__item-title text-white font-semi-bold">سورة الكهف</div>
                        </div>
                    </a>

                </div>
            </div>
        </div>

    </section>
@endsection
