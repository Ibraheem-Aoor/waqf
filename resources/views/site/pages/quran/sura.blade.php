@extends('site.layout.app')

@isset($sura)
    @section('title', $sura['name'])
@endisset

@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    <section class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <!-- Dynamically create Swiper slides -->
                            @isset($sura)
                                @for ($i = $sura['start_page']; $i <= $sura['end_page']; $i++)
                                    <div class="swiper-slide">
                                        <!-- Use str_pad to ensure page number has 3 digits -->
                                        <img src="https://mp3quran.net/api/quran_pages_arabic/{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}.png"
                                            alt="Page {{ $i }}">
                                    </div>
                                @endfor
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.mySwiper', {
                loop: true, // Optional: Makes the slider loop
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    renderBullet: function(index, className) {
                        return '<span class="' + className + '">' + (index + 1) + '</span>';
                    }
                },
            });
        });
    </script>
@endsection
