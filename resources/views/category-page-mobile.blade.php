@php
    use App\Data\ProductData;
    $categoryId = request()->id ?? 'featured';
    $categories = ProductData::getAllCategories();
    $selectedCategory = null;
    foreach ($categories as $cat) {
        if ($cat['id'] === $categoryId) {
            $selectedCategory = $cat;
            break;
        }
    }
    $products = $selectedCategory ? $selectedCategory['products'] : [];

    // Lọc sản phẩm dựa trên query string
    $categoryFilter = request()->input('category', 'tat_ca');
    $locationFilter = request()->input('location', '');
    $priceMin = request()->input('price_min', 0);
    $priceMax = request()->input('price_max', 200000);
    $sortFilter = request()->input('sort', '');
    $priceSortFilter = request()->input('price_sort', '');
    $topFilter = request()->input('top', '');

    $filteredProducts = $products;

    // Lọc theo danh mục
    if ($categoryFilter !== 'tat_ca') {
        $filteredProducts = array_filter($filteredProducts, function ($product) use ($categoryFilter) {
            return in_array($categoryFilter, [$product['badge'], $product['brand']]);
        });
    }

    // Lọc theo vị trí (dựa trên platform_name tạm thời)
    if ($locationFilter) {
        $filteredProducts = array_filter($filteredProducts, function ($product) use ($locationFilter) {
            return strpos($product['platform_name'], $locationFilter) !== false;
        });
    }

    // Lọc theo giá
    $filteredProducts = array_filter($filteredProducts, function ($product) use ($priceMin, $priceMax) {
        $salePrice = (int)str_replace(['đ', ','], '', $product['sale_price']);
        return $salePrice >= $priceMin && $salePrice <= $priceMax;
    });

    // Sắp xếp
    if ($sortFilter === 'dau_xuat') {
        usort($filteredProducts, function ($a, $b) {
            return strcmp($a['original_price'], $b['original_price']);
        });
    } elseif ($sortFilter === 'moi_nhat') {
        usort($filteredProducts, function ($a, $b) {
            return $b['id'] - $a['id'];
        });
    }

    if ($priceSortFilter === 'gia_tien_re_nhat') {
        usort($filteredProducts, function ($a, $b) {
            $priceA = (int)str_replace(['đ', ','], '', $a['sale_price']);
            $priceB = (int)str_replace(['đ', ','], '', $b['sale_price']);
            return $priceA - $priceB;
        });
    }

    if ($topFilter === 'ban_chay_nhat') {
        usort($filteredProducts, function ($a, $b) {
            return rand(-1, 1); // Giả lập bán chạy, cần dữ liệu thực tế
        });
    }

    $categoryName = $selectedCategory ? $selectedCategory['name'] : 'Nổi Bật';
    if (!$selectedCategory) {
        echo "Danh mục '$categoryId' không tồn tại.";
        exit;
    }
@endphp

    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Trang Danh Mục</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        a {
            text-decoration: none !important;
            color: inherit;
        }

        .category-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffccd5;
            padding: 10px 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: flex-start;
            align-items: center;
            z-index: 1000;
        }

        .category-header .back-btn {
            font-size: 18px;
            color: #ff4444;
            margin-right: 10px;
        }

        .category-header .title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .category-tabs {
            position: fixed;
            top: 50px;
            left: 0;
            width: 100%;
            background-color: #fff;
            padding: 5px 10px;
            display: flex;
            gap: 15px;
            overflow-x: auto;
            z-index: 900;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }

        .category-tab {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 12px;
            padding: 8px 12px;
            background-color: #f0f0f0;
            border-radius: 15px;
            min-width: 60px;
            text-align: center;
            white-space: nowrap;
        }

        .category-tab.active, .category-tab:hover {
            color: #ff4444;
            background-color: #ffe6e6;
        }

        .search-container {
            margin: 110px 15px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            width: 92%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 40px;
            position: relative;
        }

        .search-bar {
            padding: 8px 8px 8px 30px;
            flex-grow: 1;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .search-icon {
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            pointer-events: none;
        }

        .advanced-search-btn {
            padding: 8px;
            background-image: url('{{ asset('images/filter.svg') }}');
            background-color: #fff;
            background-size: 20px auto;
            background-position: center;
            background-repeat: no-repeat;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 0;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            width: 40px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .advanced-search-btn:hover {
            background-color: #f0f0f0;
            border-color: #bbb;
        }

        .product-grid {
            padding: 10px 15px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 10px;
            margin-bottom: 60px;
        }

        .product-card-wrapper {
            text-decoration: none !important;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: none;
            text-align: left;
            position: relative;
            width: 160px;
            min-width: 160px;
        }

        .product-image {
            position: relative;
            width: 100%;
            height: 100px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image .badge {
            position: absolute;
            top: 6px;
            left: 6px;
            background: #ffcc00;
            color: #fff;
            padding: 2px 4px;
            border-radius: 4px;
            font-size: 12px;
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

        .product-info {
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
            color: Gray;
        }

        .product-title {
            font-size: 16px;
            font-weight: 600;
            color: #000;
            margin: 0 0 2px 0;
            line-height: 1.2;
            height: 32px;
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

        .product-price {
            font-size: 16px;
            font-weight: 700;
            color: #ff3333;
        }

        .product-original-price {
            font-size: 14px;
            color: #666;
            text-decoration: line-through;
        }

        .bg-green-500 { background-color: #10b981; }
        .bg-red-500 { background-color: #ef4444; }
        .bg-orange-500 { background-color: #f97316; }
        .bg-yellow-500 { background-color: #eab308; }
        .bg-blue-500 { background-color: #3b82f6; }
        .bg-red-600 { background-color: #dc2626; }
        .bg-purple-500 { background-color: #8b5cf6; }
        .bg-green-600 { background-color: #16a34a; }
        .bg-yellow-600 { background-color: #ca8a04; }

        .advanced-search-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1002;
            overflow-y: auto;
            justify-content: center;
            align-items: flex-start;
            padding-top: 20px;
        }

        .advanced-search-popup.show {
            display: flex;
        }

        .advanced-search-popup .container {
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
            margin: 20px;
        }

        .advanced-search-popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            color: #000;
            padding: 5px 10px;
        }

        .advanced-search-popup .close-btn:hover {
            color: #ff4444;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .filter-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .filter-btn {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 15px;
            background-color: #fff;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s, color 0.3s;
        }

        .filter-btn.active {
            background-color: #ff4444;
            color: #fff;
            border-color: #ff4444;
        }

        .filter-btn:hover {
            background-color: #f0f0f0;
        }

        .more-btn {
            padding: 8px 12px;
            background-color: #ff4444;
            color: #fff;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s;
        }

        .more-btn:hover {
            background-color: #cc0000;
        }

        .price-slider {
            margin-top: 10px;
        }

        .price-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }

        .price-range {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
        }

        .price-track {
            width: 100%;
            height: 4px;
            background-color: #ddd;
            position: relative;
            margin-bottom: 10px;
        }

        .price-track .track-fill {
            height: 100%;
            background-color: #ff4444;
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
        }

        .price-handle {
            width: 12px;
            height: 12px;
            background-color: #ff4444;
            border-radius: 50%;
            position: absolute;
            top: -4px;
            cursor: pointer;
        }

        .price-handle.left {
            left: 0;
        }

        .price-handle.right {
            right: 0;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .action-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .reset-btn {
            background-color: #e0e0e0;
            color: #333;
        }

        .reset-btn:hover {
            background-color: #d0d0d0;
        }

        .confirm-btn {
            background-color: #ff4444;
            color: #fff;
        }

        .confirm-btn:hover {
            background-color: #cc0000;
        }

        .country-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            z-index: 1003;
            overflow-y: auto;
            transform: translateY(100%);
            transition: transform 0.3s ease-in-out;
        }

        .country-popup.show {
            display: block;
            transform: translateY(0);
        }

        .country-content {
            padding: 20px;
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 0 auto;
        }

        .country-list {
            list-style: none;
            padding: 0;
        }

        .country-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
        }

        .country-item:hover {
            background-color: #f5f5f5;
        }

        .flag {
            width: 30px;
            height: 20px;
            margin-right: 10px;
        }

        .country-popup .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            color: #000;
            padding: 5px 10px;
        }

        .country-popup .close-btn:hover {
            color: #ff4444;
        }

        .country-popup .search-bar {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #ccc;
            height: 40px;
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 20px;
        }

        .country-popup .search-bar input {
            border: none;
            outline: none;
            padding: 10px 10px 10px 40px;
            width: 100%;
            border-radius: 20px;
            font-size: 16px;
        }

        .country-popup .search-bar button {
            background: transparent;
            border: none;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            padding: 0;
        }

        .country-popup .search-bar img.search-icon {
            width: 16px;
            height: 16px;
        }

        .country-popup .search-bar button:hover img.search-icon {
            opacity: 0.7;
        }

        @media (max-width: 480px) {
            .category-tabs {
                top: 45px;
            }
            .search-container {
                margin-top: 105px;
                gap: 8px;
                padding: 0 20px;
            }
            .search-bar {
                width: calc(100% - 50px);
            }
            .search-icon {
                left: 25px;
                width: 14px;
                height: 14px;
            }
            .product-image {
                height: 80px;
            }
            .product-title {
                font-size: 14px;
                height: 28px;
            }
            .product-price {
                font-size: 14px;
            }
            .product-original-price {
                font-size: 12px;
            }
            .platform span {
                font-size: 12px;
            }
            .platform img {
                width: 14px;
                height: 14px;
            }
            .plus-btn {
                width: 24px;
                height: 24px;
                font-size: 16px;
            }
            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 80px;
                background-color: #fff;
                padding: 5px 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 45px;
                box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }
            .cart-icon {
                position: relative;
                display: flex;
                align-items: center;
                margin-right: 10px;
            }
            .cart-img {
                width: 40px;
                height: 40px;
                background-color: #ffe6e6;
                border-radius: 4px;
                padding: 2px;
            }
            .cart-badge {
                position: absolute;
                top: -5px;
                right: -5px;
                background-color: #ff4444;
                color: #fff;
                border-radius: 50%;
                padding: 1px 4px;
                font-size: 8px;
                line-height: 1;
            }
            .purchase-info {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .right-section {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 2px;
            }
            .purchase-container {
                display: flex;
                align-items: center;
                gap: 5px;
            }
            .purchase-label {
                font-size: 12px;
                color: #666;
                text-decoration: none !important;
                white-space: nowrap;
            }
            .purchase-amount {
                font-size: 14px;
                font-weight: 600;
                color: #ff4444;
                white-space: nowrap;
                position: relative;
                display: flex;
                align-items: flex-end;
            }
            .purchase-amount img {
                width: 18px;
                height: 18px;
                vertical-align: bottom;
                margin-left: 2px;
            }
            .pay-btn {
                padding: 6px 10px;
                background-color: #ff4444;
                color: #fff;
                text-decoration: none !important;
                border-radius: 5px;
                font-size: 17px;
                white-space: nowrap;
                transition: background-color 0.3s;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .pay-btn:hover {
                background-color: #cc0000;
            }
        }
    </style>
</head>
<body>
<div class="category-header">
    <a href="/" class="back-btn">←</a>
    <span class="title">{{ $categoryName }}</span>
</div>

<div class="category-tabs">
    @foreach ($categories as $cat)
        <a href="/category/{{ $cat['id'] }}" class="category-tab {{ $cat['id'] === $categoryId ? 'active' : '' }}">
            <span>{{ $cat['name'] }}</span>
        </a>
    @endforeach
</div>

<div class="search-container">
    <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="search-icon">
    <input type="text" class="search-bar" placeholder="Tìm kiếm...">
    <button class="advanced-search-btn" onclick="showAdvancedSearchPopup()"></button>
</div>

<div class="product-grid">
    @foreach ($filteredProducts as $product)
        <a href="/voucher/{{ $product['id'] }}" class="product-card-wrapper">
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}">
                    @if ($product['badge'])
                        <span class="badge {{ $product['badge_color'] }}">{{ $product['badge'] }}</span>
                    @endif
                    <button class="plus-btn" onclick="window.location.href='/voucher/{{ $product['id'] }}'">+</button>
                </div>
                <div class="product-info">
                    <div class="platform-info">
                        <div class="platform">
                            <img src="{{ $product['platform'] }}" alt="Platform Icon">
                            <span>{{ $product['platform_name'] }}</span>
                        </div>
                    </div>
                    <div class="product-title">{{ $product['title'] }}</div>
                    <div class="price-info">
                        <div class="product-original-price">{{ $product['original_price'] }}</div>
                        <div class="product-price">{{ $product['sale_price'] }}</div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>

<div class="footer">
    <div class="cart-icon">
        <img src="{{ asset('images/vector.svg') }}" alt="Cart Icon" class="cart-img">
        <span class="cart-badge">1</span>
    </div>
    <div class="purchase-container">
        <div class="purchase-info">
            <div class="right-section">
                <span class="purchase-label">Purchase</span>
                <span class="purchase-amount">1.002.000.000<img src="{{ asset('images/hehe.svg') }}" alt="Hehe Icon"></span>
            </div>
        </div>
        <div class="pay-button">
            <a href="/payment" class="pay-btn">Thanh toán</a>
        </div>
    </div>
</div>

<div class="advanced-search-popup" id="advancedSearchPopup">
    <div class="container">
        <button class="close-btn" onclick="hideAdvancedSearchPopup()">×</button>
        <h1>Bộ lọc nâng cao</h1>
        <form id="filter-form" action="/category/{{ $categoryId }}" method="GET">
            <div class="filter-group">
                <div class="filter-title">Danh mục</div>
                <div class="filter-options">
                    <button type="button" class="filter-btn {{ request()->input('category') == 'tat_ca' ? 'active' : '' }}" data-filter="category" data-value="tat_ca">Tất cả</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'doc_quyen' ? 'active' : '' }}" data-filter="category" data-value="doc_quyen">Độc quyền</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'am_thuc' ? 'active' : '' }}" data-filter="category" data-value="am_thuc">Ẩm thực</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'di_chuyen' ? 'active' : '' }}" data-filter="category" data-value="di_chuyen">Di chuyển</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'lam_dep' ? 'active' : '' }}" data-filter="category" data-value="lam_dep">Làm đẹp</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'vien_thong' ? 'active' : '' }}" data-filter="category" data-value="vien_thong">Viễn thông</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'gia_tri' ? 'active' : '' }}" data-filter="category" data-value="gia_tri">Giá trị</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'giao_duc' ? 'active' : '' }}" data-filter="category" data-value="giao_duc">Giáo dục</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'du_lich' ? 'active' : '' }}" data-filter="category" data-value="du_lich">Du lịch</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'mua_sam' ? 'active' : '' }}" data-filter="category" data-value="mua_sam">Mua sắm</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'suc_khoe' ? 'active' : '' }}" data-filter="category" data-value="suc_khoe">Sức khỏe</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'khac_san' ? 'active' : '' }}" data-filter="category" data-value="khac_san">Khách sạn</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'vi_tri' ? 'active' : '' }}" data-filter="category" data-value="vi_tri">Vị trí</button>
                    <button type="button" class="filter-btn {{ request()->input('category') == 'xem_them' ? 'active' : '' }}" data-filter="category" data-value="xem_them">Xem thêm</button>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Vị trí</div>
                <div class="filter-options">
                    <button type="button" class="filter-btn {{ request()->input('location') == 'toan_cau' ? 'active' : '' }}" data-filter="location" data-value="toan_cau">Toàn cầu</button>
                    <button type="button" class="filter-btn {{ request()->input('location') == 'viet_nam' ? 'active' : '' }}" data-filter="location" data-value="viet_nam">Việt Nam</button>
                    <button type="button" class="filter-btn {{ request()->input('location') == 'thai_lan' ? 'active' : '' }}" data-filter="location" data-value="thai_lan">Thái Lan</button>
                    <button type="button" class="filter-btn {{ request()->input('location') == 'my' ? 'active' : '' }}" data-filter="location" data-value="my">Mỹ</button>
                    <button type="button" class="more-btn" onclick="showCountryPopup()">Xem thêm</button>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Khoảng giá</div>
                <div class="price-slider">
                    <div class="price-label">United States Dollars ($)</div>
                    <div class="price-range">
                        <span>$0</span>
                        <span>$200,000+</span>
                    </div>
                    <div class="price-track">
                        <div class="track-fill" id="track-fill"></div>
                        <div class="price-handle left" id="price-handle-left"></div>
                        <div class="price-handle right" id="price-handle-right"></div>
                    </div>
                    <input type="hidden" name="price_min" id="price-min" value="0">
                    <input type="hidden" name="price_max" id="price-max" value="200000">
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Sắp xếp</div>
                <div class="filter-options">
                    <button type="button" class="filter-btn {{ request()->input('sort') == 'dau_xuat' ? 'active' : '' }}" data-filter="sort" data-value="dau_xuat">Đầu xuất</button>
                    <button type="button" class="filter-btn {{ request()->input('sort') == 'moi_nhat' ? 'active' : '' }}" data-filter="sort" data-value="moi_nhat">Mới nhất</button>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Giá tiền rẻ nhất</div>
                <div class="filter-options">
                    <button type="button" class="filter-btn {{ request()->input('price_sort') == 'gia_tien_re_nhat' ? 'active' : '' }}" data-filter="price_sort" data-value="gia_tien_re_nhat">Giá tiền rẻ nhất</button>
                    <button type="button" class="filter-btn {{ request()->input('price_sort') == 'gia_diem_re_nhat' ? 'active' : '' }}" data-filter="price_sort" data-value="gia_diem_re_nhat">Giá điểm rẻ nhất</button>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Bán chạy nhất</div>
                <div class="filter-options">
                    <button type="button" class="filter-btn {{ request()->input('top') == 'ban_chay_nhat' ? 'active' : '' }}" data-filter="top" data-value="ban_chay_nhat">Bán chạy nhất</button>
                </div>
            </div>

            <div class="action-buttons">
                <button type="button" class="action-btn reset-btn" id="reset-btn">Đặt lại</button>
                <button type="submit" class="action-btn confirm-btn">Xác nhận</button>
            </div>
        </form>

        <div class="country-popup" id="countryPopup">
            <button class="close-btn" onclick="hideCountryPopup()">×</button>
            <div class="country-content">
                <h2>Chọn quốc gia</h2>
                <p>Các quốc gia đang áp dụng</p>
                <div class="search-bar">
                    <button><img src="{{ asset('images/ff.svg') }}" alt="Biểu tượng tìm kiếm" class="search-icon"></button>
                    <input type="text" placeholder="Tìm quốc gia của bạn" onkeyup="filterCountries()">
                </div>
                <ul class="country-list">
                    <li class="country-item" data-value="viet_nam"><img src="https://flagcdn.com/vn.svg" alt="Việt Nam" class="flag"> Việt Nam</li>
                    <li class="country-item" data-value="anh"><img src="https://flagcdn.com/gb.svg" alt="Anh" class="flag"> Anh</li>
                    <li class="country-item" data-value="duc"><img src="https://flagcdn.com/de.svg" alt="Đức" class="flag"> Đức</li>
                    <li class="country-item" data-value="an_do"><img src="https://flagcdn.com/in.svg" alt="Ấn Độ" class="flag"> Ấn Độ</li>
                    <li class="country-item" data-value="han_quoc"><img src="https://flagcdn.com/kr.svg" alt="Hàn Quốc" class="flag"> Hàn Quốc</li>
                    <li class="country-item" data-value="nhat_ban"><img src="https://flagcdn.com/jp.svg" alt="Nhật Bản" class="flag"> Nhật Bản</li>
                    <li class="country-item" data-value="thai_lan"><img src="https://flagcdn.com/th.svg" alt="Thái Lan" class="flag"> Thái Lan</li>
                    <li class="country-item" data-value="indonesia"><img src="https://flagcdn.com/id.svg" alt="Indonesia" class="flag"> Indonesia</li>
                    <li class="country-item" data-value="singapore"><img src="https://flagcdn.com/sg.svg" alt="Singapore" class="flag"> Singapore</li>
                    <li class="country-item" data-value="phap"><img src="https://flagcdn.com/fr.svg" alt="Pháp" class="flag"> Pháp</li>
                    <li class="country-item" data-value="ha_lan"><img src="https://flagcdn.com/nl.svg" alt="Hà Lan" class="flag"> Hà Lan</li>
                    <li class="country-item" data-value="hy_lap"><img src="https://flagcdn.com/gr.svg" alt="Hy Lạp" class="flag"> Hy Lạp</li>
                    <li class="country-item" data-value="tho_nhi_ky"><img src="https://flagcdn.com/tr.svg" alt="Thổ Nhĩ Kỳ" class="flag"> Thổ Nhĩ Kỳ</li>
                    <li class="country-item" data-value="trung_quoc"><img src="https://flagcdn.com/cn.svg" alt="Trung Quốc" class="flag"> Trung Quốc</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Dữ liệu sản phẩm tĩnh từ ProductData
    const products = @json(collect(\App\Data\ProductData::getAllCategories())->flatMap(function ($category) {
            return $category['products'];
        })->all());

    // Khởi tạo trạng thái bộ lọc
    let filters = {
        category: '{{ request()->input('category') ?? 'tat_ca' }}',
        location: '{{ request()->input('location') ?? '' }}',
        price_min: parseInt('{{ request()->input('price_min') ?? 0 }}'),
        price_max: parseInt('{{ request()->input('price_max') ?? 200000 }}'),
        sort: '{{ request()->input('sort') ?? '' }}',
        price_sort: '{{ request()->input('price_sort') ?? '' }}',
        top: '{{ request()->input('top') ?? '' }}'
    };

    // Hàm cập nhật class active cho nút
    function updateButtonStates() {
        document.querySelectorAll('.filter-btn').forEach(btn => {
            const filter = btn.getAttribute('data-filter');
            const value = btn.getAttribute('data-value');
            if (filters[filter] === value) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    // Xử lý click nút bộ lọc
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            const value = this.getAttribute('data-value');
            if (filter === 'category') filters.category = value;
            if (filter === 'location') filters.location = value;
            if (filter === 'sort') filters.sort = value;
            if (filter === 'price_sort') filters.price_sort = value;
            if (filter === 'top') filters.top = value;
            updateButtonStates();
        });
    });

    // Xử lý thanh trượt giá
    const trackFill = document.getElementById('track-fill');
    const handleLeft = document.getElementById('price-handle-left');
    const handleRight = document.getElementById('price-handle-right');
    const priceMin = document.getElementById('price-min');
    const priceMax = document.getElementById('price-max');

    function updatePriceRange() {
        const min = filters.price_min;
        const max = filters.price_max;
        const range = 200000;
        const leftPos = (min / range) * 100;
        const rightPos = 100 - (max / range) * 100;
        trackFill.style.width = `${100 - rightPos}%`;
        trackFill.style.left = `${leftPos}%`;
        handleLeft.style.left = `${leftPos}%`;
        handleRight.style.right = `${rightPos}%`;
        priceMin.value = min;
        priceMax.value = max;
    }

    // Xử lý reset
    document.getElementById('reset-btn').addEventListener('click', function() {
        filters = {
            category: 'tat_ca',
            location: '',
            price_min: 0,
            price_max: 200000,
            sort: '',
            price_sort: '',
            top: ''
        };
        updateButtonStates();
        updatePriceRange();
        document.getElementById('filter-form').reset();
    });

    // Xử lý popup tìm kiếm nâng cao
    function showAdvancedSearchPopup() {
        const popup = document.getElementById('advancedSearchPopup');
        popup.classList.add('show');
    }

    function hideAdvancedSearchPopup() {
        const popup = document.getElementById('advancedSearchPopup');
        popup.classList.remove('show');
    }

    // Xử lý popup chọn quốc gia
    function showCountryPopup() {
        const countryPopup = document.getElementById('countryPopup');
        countryPopup.classList.add('show');
    }

    function hideCountryPopup() {
        const countryPopup = document.getElementById('countryPopup');
        countryPopup.classList.remove('show');
    }

    function filterCountries() {
        let input = document.querySelector('.country-popup .search-bar input').value.toLowerCase();
        let items = document.querySelectorAll('.country-item');
        items.forEach(item => {
            let text = item.textContent.toLowerCase();
            item.style.display = text.includes(input) ? '' : 'none';
        });
    }

    // Xử lý chọn quốc gia
    document.querySelectorAll('.country-item').forEach(item => {
        item.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            filters.location = value;
            updateButtonStates();
            hideCountryPopup();
        });
    });

    // Khởi tạo
    updateButtonStates();
    updatePriceRange();
</script>
</body>
</html>
