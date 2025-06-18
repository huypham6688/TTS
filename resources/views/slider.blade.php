<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swiper Slider</title>

    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fefefe;

        }
        .swiper-button-prev,
        .swiper-button-next {
            display: none;
        }


        .slider {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .swiper {
            width: 100%;
            height: 220px;
        }

        .swiper-slide {
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .swiper-slide img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .slide-text {
            margin-top: 10px;
            color: #333;
            text-align: center;
        }

        @media (max-width: 480px) {
            .swiper {
                height: 180px;
            }

            .slide-text {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="slider">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/190.png') }}" alt="Ảnh slide">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/190.png') }}" alt="Ảnh slide">

            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/190.png') }}" alt="Ảnh slide">

            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/190.png') }}" alt="Ảnh slide">

            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/190.png') }}" alt="Ảnh slide">

            </div>
        </div>

        <!-- Pagination & Navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>

<!-- SwiperJS Script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    const swiper = new Swiper('.mySwiper', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },

    });
</script>
</body>
</html>
