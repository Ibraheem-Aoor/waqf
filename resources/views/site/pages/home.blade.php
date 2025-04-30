@extends('site.layout.app')
@section('title', 'الصفحة الرئيسية')
@section('content')
    <section class="section-content">

        <div class="container">
            <div class="row mb-3">
                @isset($user)
                    <div class="col-12 text-center p-2 rounded-pill base_color">
                        وقف/{{ $user->name }}
                    </div>
                @endisset
            </div>
            <div class="row">
                <div class="col-12">
                    <a class="widget__item-1" href="{{ route('site.quran.index') }}">
                        <div class="widget__item-image"><img  loading="lazy" src="{{ asset('images/quran.webp') }}" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5">
                            <div class="widget__item-title text-white font-semi-bold">القرآن الكريم
                            </div>
                            <div class="widget__item-title text-white font-semi-bold"> &quot; مكتوب &quot;
                            </div>

                        </div>
                    </a>
                    <a class="widget__item-1" href="{{ route('site.quran.reciter.index') }}">
                        <div class="widget__item-image"><img  loading="lazy" src="https://img.freepik.com/premium-photo/priest-praying-time-from-holy-book_23-2148288833.jpg?ga=GA1.1.239997956.1746008639&semt=ais_hybrid&w=740" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5 " style="left:0">
                            <div class="widget__item-title text-white font-semi-bold">القرآن الكريم
                            </div>
                            <div class="widget__item-title text-white font-semi-bold">
                                &quot; صوتي &quot;</div>
                        </div>
                    </a>
                    <a class="widget__item-1" href="{{ route('site.azkar.index') }}">
                        <div class="widget__item-image"><img  loading="lazy" src="https://img.freepik.com/free-vector/hand-drawn-flat-design-tasbih-illustration_23-2149275536.jpg?ga=GA1.1.239997956.1746008639&semt=ais_hybrid&w=740" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5">
                            <div class="widget__item-title text-white font-semi-bold">الأذكار</div>
                        </div>
                    </a>
                    <a class="widget__item-1" href="{{ route('site.masbaha') }}">
                        <div class="widget__item-image"><img  loading="lazy" src="https://img.freepik.com/free-vector/hand-drawn-flat-design-tasbih-illustration_23-2149261979.jpg?ga=GA1.1.239997956.1746008639&semt=ais_hybrid&w=740" alt="" />
                        </div>
                        <div class="widget__item-content p-4 text-center pt-5" style="left:0">
                            <div class="widget__item-title text-white font-semi-bold">المسبحة الإلكترونية</div>
                        </div>
                    </a>
                    <a class="widget__item-1" href="{{ route('site.quran.sura', 18) }}">
                        <div class="widget__item-image"><img  loading="lazy" src="https://img.freepik.com/free-psd/quran-book-isolated_23-2151371150.jpg?ga=GA1.1.239997956.1746008639&semt=ais_hybrid&w=740" alt="" />
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
