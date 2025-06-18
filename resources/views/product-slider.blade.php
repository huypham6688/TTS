<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Slider</title>
    <style>
        .product-slider-section {
            width: 95% !important;
            max-width: 95vw !important;
            padding: 10px 8px !important;
            margin: 6px auto !important;
            box-sizing: border-box;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 80px;
            padding: 0;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .section-title .emoji {
            font-size: 20px;
        }

        .section-title h2 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .view-all-btn {
            background: none;
            border: none;
            color: #ff6b6b;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            padding: 2px 6px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .view-all-btn:hover {
            background-color: #fff0f0;
        }

        .product-container {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 0;
            scrollbar-width: thin;
            scrollbar-color: #ccc #f5f5f5;
            gap: 2px;
        }

        .product-container::-webkit-scrollbar {
            height: 6px;
        }

        .product-container::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .product-container::-webkit-scrollbar-track {
            background: #f5f5f5;
        }

        .product-card-wrapper {
            min-width: 165px;
            margin: 0;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
            box-shadow: none;
            width: 160px;
            min-width: 160px;
            overflow: hidden;
            position: relative;
            padding: 0;
        }

        .card-image {
            position: relative;
            width: 100%;
            height: 100px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge {
            position: absolute;
            top: 6px;
            left: 6px;
            background: #ffcc00;
            color: #fff;
            padding: 2px 4px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .plus-btn {
            position: absolute;
            bottom: 6px;
            right: 6px;
            background: #ff3333;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .plus-btn:hover {
            background: #cc0000;
        }

        .card-content {
            padding: 6px;
        }

        .platform-info {
            display: flex;
            align-items: center;
            margin-bottom: 2px;
        }

        .platform {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .platform img {
            width: 16px;
            height: 16px;
        }

        .platform span {
            font-size: 10px;
            color: #333;
            font-weight: bold;
        }

        .card-title {
            font-size: 12px;
            font-weight: 600;
            color: #000;
            margin: 0 0 2px 0;
            line-height: 1.2;
            height: 24px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .price-info {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .original-price {
            font-size: 10px;
            color: #666;
            text-decoration: line-through;
        }

        .sale-price {
            font-size: 12px;
            font-weight: 700;
            color: #ff3333;
        }

        .bg-green-500 { background-color: #10b981; }
        .bg-red-500 { background-color: #ef4444; }
        .bg-orange-500 { background-color: #f97316; }
        .bg-yellow-500 { background-color: #eab308; }
        .bg-blue-500 { background-color: #3b82f6; }
        .bg-red-600 { background-color: #dc2626; }
        .bg-purple-500 { background-color: #8b5cf6; }
        .bg-green-600 { background-color: #16a34b; }
        .bg-yellow-600 { background-color: #ca8a04; }
    </style>
</head>
<body>
@php
    use App\Data\ProductData;
    $products = ProductData::getFeaturedProducts();
@endphp

<div class="product-slider-section">
    <div class="section-header">
        <div class="section-title">
            <span class="emoji">🍽️</span>
            <h2>Ẩm thực</h2>
        </div>
        <button class="view-all-btn">Xem tất cả</button>
    </div>

    <div class="product-container">
        @foreach($products as $product)
            <div class="product-card-wrapper">
                @include('product-card', [
                    'image' => $product['image'],
                    'title' => $product['title'],
                    'originalPrice' => $product['original_price'],
                    'salePrice' => $product['sale_price'],
                    'platform' => $product['platform'],
                    'badge' => $product['badge'],
                    'badgeColor' => $product['badge_color'],
                    'brand' => $product['brand']
                ])
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
