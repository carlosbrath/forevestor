@extends('layouts.master-public')
@section('title', 'Landing')
@section('meta_description', 'Landing page')
@section('content')
    <!-- HERO SECTION -->
<section id="heroSection" class="hero-section d-flex">
    <div class="w-100 blank-dv"></div>

    <div class="d-flex flex-column align-items-center gap-3">
        <!-- Row 1 -->
        <div class="d-flex align-items-center star-card gap-2">
            <img src="{{ asset('/assets/images/svgs/promo-card-star-icon.svg')}}" alt="Stars Icon Wealth" class="star-icon" />
            <a href="" class="text-white">Launched: MagniFi Federal Fi Credit Card</a>
        </div>

        <!-- Row 2 -->
        <h1 class="text-white text-center">One app for all things money</h1>
    </div>
    <div class="d-flex flex-column align-items-center hero-image-section">
        <div class="hero-img-1">
            <img src="{{ asset('/assets/images/hero-image-desktop-v2.webp')}}" alt="">
        </div>
        <div class="hero-img-2">
            <img src="{{ asset('/assets/images/hero-image-lottie-fallback-v2.webp')}}" alt="">
        </div>
    </div>
</section>

@endsection
