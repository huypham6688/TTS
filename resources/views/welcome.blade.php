<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thẻ Quà Tặng</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            background: linear-gradient(to bottom, #fff7f9, #fffafb);
            overflow-x: hidden;
        }
        #app {
            width: 100%;
            max-width: 100vw;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
<div id="app">
    @include('header')
    @include('search-bar')
    @include('categories')
    @include('slider')

    {{-- Gọi product slider --}}
    @include('product-slider')
    @include('product-slider2')
    @include('product-slider4')
    @include('product-slider3')
    @include('footer')

</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    function adjustBackgroundHeight() {
        const container = document.querySelector('.categories-container');
        const section = document.querySelector('.categories-section');
        if (container && section) {
            const containerHeight = container.offsetHeight;
            section.style.setProperty('--bg-height', `${containerHeight}px`);
        }
    }

    window.addEventListener('load', adjustBackgroundHeight);
    window.addEventListener('resize', adjustBackgroundHeight);
</script>
</body>
</html>
