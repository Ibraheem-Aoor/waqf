@extends('site.layout.app')

@push('css')
    <style type="text/css">
        /* Add any required custom CSS for the player */
        .audio-player-wrapper {
            text-align: center;
        }
    </style>
@endpush

@isset($reciter)
    @section('title', $reciter['name'])
@endisset

@section('content')
    <section class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="profile-image text-center mb-3">
                        <img src="{{ asset('images/placehoder.png') }}" alt="">
                    </div>
                    <div class="text-center">
                        <h3 class="font-semi-bold mb-2">
                            {{ $reciter['name'] }}
                        </h3>
                        <p>
                            {{ $moshaf['name'] }}
                        </p>
                    </div>
                </div>

                <div class="col-11 mx-auto mt-t pt-5">
                    <h3 class="font-bold text-center mt-5 mb-2">{{ $sura['name'] }}</h3>
                    <!-- Audio Player Section -->
                    <div class="audio-player-wrapper">
                        <audio id="audioPlayer" preload="auto" controls>
                            <source
                                src="https://server6.mp3quran.net/akdr/{{ str_pad($sura['id'], 3, '0', STR_PAD_LEFT) }}.mp3"
                                type="audio/mpeg">
                            جهازك لا يدعم الملفات الصوتية
                        </audio>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('js/site/jquery.min.js') }}"></script>

    <!-- Assuming you have a valid audioplayer.js file, remove defer and check script loading -->
    <script src="https://waqfsawir.net/js/audioplayer.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize the audio player with any necessary customization
            $('#audioPlayer').audioPlayer();
        });
    </script>
@endpush
