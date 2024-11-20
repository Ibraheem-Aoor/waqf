@extends('site.layout.app')
@section('title', 'عن الوقف')
@section('content')
    <section class="section-content">

        <div class="container">
            <div wire:effects="[]" wire:id="ZowJtRr0bRuLB6sPEWAq">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <div class="inout-icon">
                                <input name="search" class="form-control" type="text"
                                    id="name" placeholder="ابحث بإسم السورة" onkeyup="filterList()">
                                <div class="icon"><img src="https://waqfsawir.net/img//svg/search.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="list">
                        @foreach ($suwar as $sura)
                            <a class="widget__item-2" href="{{ route('site.quran.sura' , $sura['id']) }}" wire:key="1" data-name="{{ $sura['name'] }}">
                                <div class="widget__item-icon">
                                    <img src="https://waqfsawir.net/img//svg/icon-1.svg" alt="">
                                </div>
                                <div class="widget__item-content">
                                    <h6 class="widget__item-title font-bold">{{ $sura['name'] }}</h6>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        function filterList() {
            const input = document.getElementById('name').value.toLowerCase();
            const items = document.querySelectorAll('#list .widget__item-2');

            items.forEach(item => {
                const name = item.getAttribute('data-name').toLowerCase();
                item.style.display = name.includes(input) ? '' : 'none';
            });
        }
    </script>
@endsection
