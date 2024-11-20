@extends('site.layout.app')
@section('title', 'اامسبحة الإلكترونية')
@push('css')
    <style>
        .input-counter {
            font-size: 50px;
            text-align: center;
            /* Center-align text */
        }
    </style>
@endpush
@section('content')
    <section class="section-content">
        <section class="section-content section-counter text-center">
            <div class="container py-5">
                <h3 class="text-white">عداد التسبيح</h3>
                <div class="button-container">
                    <button class="ani-btn">
                        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px"
                            height="24px">
                            <path fill-rule="evenodd"
                                d="M 11 2 L 11 11 L 2 11 L 2 13 L 11 13 L 11 22 L 13 22 L 13 13 L 22 13 L 22 11 L 13 11 L 13 2 Z">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Replace input with p tag -->
                <p class="input-counter">0</p>
            </div>
        </section>
    </section>
    @push('js')
        <script src="{{ asset('js/site/jquery.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                var counter = 0;
                $('.ani-btn').click(function() {
                    counter++;
                    $('.input-counter').text(counter);
                });
            });
        </script>
    @endpush
@endsection
