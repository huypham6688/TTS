<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Trang Voucher - KFC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F2F2F2;
            color: #333;
            overflow-x: hidden;
            position: relative;
            padding-bottom: 80px; /* Chiều cao của footer */
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 0;
            position: relative;
        }

        .header {
            width: 100%;
            padding: 20px 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-image: url('{{ asset("images/Background.svg") }}');
            background-size: cover;
            max-width: 100%;
            box-sizing: border-box;
            box-shadow: none;
            height: 180px;
            position: relative;
            z-index: 1;
        }
        .header .back-btn {
            text-decoration: none;
            display: flex;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            margin-top: 5px;
        }
        .header .back-btn2 {
            text-decoration: none;
            display: flex;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            margin-top: 5px;
        }
        .header .back-btn .back-icon {
            font-size: 24px;
            color: #fff;
            line-height: 1;
            margin: 0;
        }
        .header .menu-btn {
            display: flex;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 5px;
            height: 20px;
            width: 60px;
            position: relative;
            z-index: 2;
        }
        .header .menu-btn .menu-icon1 img,
        .header .menu-btn .menu-icon2 img {
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }
        .header .menu-btn .separator {
            color: #fff;
            margin: 0 8px;
            font-size: 20px;
        }
        .header .menu-btn::after {
            content: '';
            position: absolute;
            height: 10px;
            width: 1px;
            background-color: rgba(255, 255, 255, 0.5);
            left: 50%;
            transform: translateX(-50%);
        }
        .voucher-container {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            margin: 10px 20px;
            margin-top: -50px;
            text-align: center;
            position: relative;
            overflow: visible;
            z-index: 2;
        }
        .voucher-info {
            background-color: #fff;
            padding: 10px;
            border-radius: 0 0 10px 10px;
            text-align: left;
        }
        .voucher-info .brand-logo {
            width: 40px;
            vertical-align: middle;
            margin-right: 5px;
        }
        .voucher-info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .voucher-info .brand-name {
            color: #666;
            font-size: 12px;
        }
        .voucher-info .highlight {
            color: #ff4444;
            font-weight: bold;
        }
        .voucher-info .price {
            font-size: 18px;
            color: #ff3333;
            font-weight: bold;
        }
        .voucher-info .original-price {
            text-decoration: line-through;
            color: #666;
            margin-right: 10px;
            font-size: 14px;
        }
        .voucher-action {
            background-color: #fff;
            padding: 10px;
            text-align: center;
        }
        .voucher-action .country {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            margin: 0;
        }
        .voucher-action .country img.flag {
            width: 20px;
            margin-right: 5px;
        }
        .voucher-action .country img.small-icon {
            width: 70px;
        }
        .add-to-cart {
            background-color: #ff3333;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 50px;
            margin-top: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .add-to-cart:hover {
            background-color: #DB3D42;
        }
        .voucher-divider {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 15px 0;
            width: 100%;
            position: relative;
        }
        .voucher-divider img {
            height: 20px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        .voucher-divider .ellipse {
            width: 20px;
            flex-shrink: 0;
        }
        .voucher-divider .ellipse.left {
            left: -20px;
        }
        .voucher-divider .ellipse.right {
            right: -20px;
        }
        .voucher-divider .dashed-line {
            flex-grow: 1;
            height: 2px;
            border-top: 2px dashed #ccc;
            margin: 0 5px;
        }
        .nav-tabs {
            display: flex;
            justify-content: space-around;
            background-color: #fff;
            height: 40px;
            margin: 1px 20px;
            border-radius: 10px 10px 0 0;
            padding: 5px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
        }
        .small-text {
            font-size: 12px;
        }
        .small-text2 {
            font-size: 20px;
        }
        .nav-tabs button {
            border: none;
            background: none;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            flex: 1;
            color: #666;
            position: relative;
        }
        .nav-tabs button.active {
            color: #ff3333;
            border-bottom: none;
        }
        .nav-tabs button.active::after {
            content: '';
            position: absolute;
            bottom: -7px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #ff3333;
        }
        .tab-content {
            background-color: #fff;
            padding: 15px;
            border-radius: 0 0 10px 10px;
            margin: 0 20px 10px 20px;
            display: none;
        }
        .tab-content.active {
            display: block;
            margin-bottom: 150px;
        }
        .guide-step {
            height: 33px;
            display: flex;
            align-items: center;
            margin: 33px 2px;
            position: relative;
        }
        .step-icon {
            width: 40px;
            height: 40px;
            margin-right: 15px;
            z-index: 1;
            position: relative;
        }
        .step-icon img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }
        .guide-step p {
            margin: 0;
            font-size: 14px;
        }
        .guide-step:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 20px;
            top: 40px;
            bottom: -30px;
            width: 2px;
            background-color: #ccc;
            z-index: 0;
        }
        @media (max-width: 480px) {
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
                z-index: 1002;
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

        .cart-popup {
            display: none;
            position: fixed;
            bottom: 80px; /* Chiều cao của footer */
            left: 0;
            width: 95%;
            height: 420px;
            background-color: #fff;
            padding: 10px 10px 60px 10px;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            text-align: left;
            font-family: Arial, sans-serif;
            transform: translateY(100%);
            transition: transform 0.3s ease-in-out;
        }

        .cart-popup.show {
            display: block;
            transform: translateY(0);
        }

        .cart-popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #000;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            z-index: 1002;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 110%; /* Chiếm toàn bộ chiều ngang */
            padding: 10px;
            height: 60px;
            position: relative;
            transition: transform 0.3s ease;
        }

        .cart-item.sliding {
            transform: translateX(-50px); /* Trượt sang trái để hiển thị nút xóa */
        }

        .cart-item.sliding .product-image {
            display: none; /* Ẩn ảnh sản phẩm khi trượt */
        }

        .product-image {
            width: 60px;
            height: 60px;
            margin-right: 10px;
            object-fit: cover;
            border-radius: 5px;
        }

        .item-details {
            flex-grow: 1;
            overflow: hidden;
            margin-right: 50px; /* Khoảng trống cho nút xóa */
        }

        .brand-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .brand-logo {
            width: 25px;
            height: 25px;
            margin-bottom: 2px;
            object-fit: cover;
        }

        .brand-logo-container {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .brand-text {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-left: 5px;
        }

        .description {
            text-align: left;
        }

        .description p {
            margin: 0;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .price-purchase {
            display: flex;
            justify-content: space-between;
            background-color: #f0f0f0;
            padding: 2px 5px;
            border-radius: 5px;
            margin-top: 2px;
            align-items: center;
        }

        .price-purchase .price,
        .price-purchase .purchase {
            font-size: 12px;
            color: #333;
        }

        .price-purchase .purchase {
            color: #ff4444;
            display: flex;
            align-items: center;
        }

        .purchase-icon {
            width: 14px;
            height: 14px;
            margin-left: 3px;
            vertical-align: middle;
        }

        .quantity {
            font-size: 12px;
            color: #666;
            background-color: #f0f0f0;
            padding: 1px 4px;
            border-radius: 3px;
            margin-left: auto;
        }

        .delete-btn {
            display: none; /* Ẩn ban đầu */
            position: absolute;
            right: -56px;
            top: 18%;
            transform: translateY(-50%);
            background-color: #ff4444;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            height: 60px;
            width: 60px;
            font-size: 14px;
            z-index: 1;
        }

        .cart-item.sliding .delete-btn {
            display: block; /* Hiển thị nút xóa khi trượt */
            transform: translateX(-50px);
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(100% - 80px);
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            pointer-events: auto;
        }

        .overlay.show {
            display: block;
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
            z-index: 1002; /* Cao hơn popup */
        }

        .country-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            z-index: 1003; /* Cao hơn popup giỏ hàng và footer */
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
            color: #ff3333;
        }

        .search-bar {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #ccc;
            height: 40px;
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 20px;
        }

        .search-bar input {
            border: none;
            outline: none;
            padding: 10px 10px 10px 40px;
            width: 100%;
            border-radius: 20px;
            font-size: 16px;
        }

        .search-bar button {
            background: transparent;
            border: none;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            padding: 0;
        }

        .search-bar img.search-icon {
            width: 16px;
            height: 16px;
        }

        .search-bar button:hover img.search-icon {
            opacity: 0.7;
        }

        .overlay.country-overlay {
            z-index: 1002; /* Dưới popup quốc gia nhưng trên nội dung khác */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <a href="/" class="back-btn">
            <span class="back-icon">←</span>
        </a>
        <div class="menu-btn">
            <span class="menu-icon1"><img src="{{ asset('images/top2.svg') }}" alt="Menu Icon 1"></span>
            <span class="separator">|</span>
            <a href="/" class="back-btn22"> <span class="menu-icon2"><img src="{{ asset('images/top1.svg') }}" alt="Menu Icon 2"></span> </a>
        </div>
    </div>
    <div class="voucher-container">
        <div class="voucher-info">
            <p><img src="{{ asset('images/191.svg') }}" alt="KFC Logo" class="brand-logo"> <span class="brand-name">KFC</span></p>
            <p>Voucher hot giảm 40k cho hóa đơn từ 120k trong hôm nay 🔥 [KFC]</p>
            <p><span class="original-price">20.000đ</span><span class="price">0đ</span></p>
        </div>
        <div class="voucher-divider">
            <img src="{{ asset('images/Ellipse.svg') }}" alt="Ellipse Left" class="ellipse left">
            <div class="dashed-line"></div>
            <img src="{{ asset('images/Ellipse.svg') }}" alt="Ellipse Right" class="ellipse right">
        </div>
        <div class="voucher-action">
            <p class="country">
                <span>Quốc gia áp dụng: 123 quốc gia</span>
                <a href="#" onclick="showCountryPopup()">
                    <img src="{{ asset('images/avatars.svg') }}" alt="Small Icon" class="small-icon">
                </a>
            </p>
            <div class="add-to-cart" onclick="showCartPopup()">
                Thêm vào giỏ hàng
            </div>
        </div>
    </div>
    <div class="nav-tabs">
        <button class="active" onclick="showTab('terms')">Điều khoản</button>
        <button onclick="showTab('guide')">Hướng dẫn</button>
        <button onclick="showTab('description')">Mô tả</button>
    </div>
    <div id="terms" class="tab-content">
        <p>Voucher chỉ áp dụng cho hóa đơn từ 120k, không kết hợp với các ưu đãi khác, hết hạn trong ngày 18/06/2025.</p>
    </div>
    <div id="guide" class="tab-content active">
        <h2 class="small-text2">Hướng dẫn sử dụng</h2>
        <p class="small-text">Thanh toán dịch vụ online bằng mã code trên website hoặc ứng dụng của nhãn hàng</p>
        <div class="guide-step">
            <div class="step-icon"><img src="{{ asset('images/huy.svg') }}" alt="Step 1"></div>
            <p><strong>Bước 1:</strong> Chọn voucher ưu đãi muốn sử dụng, ấn <strong>“Sử dụng ngay”</strong> để xem chi tiết mã Code giảm giá</p>
        </div>
        <div class="guide-step">
            <div class="step-icon"><img src="{{ asset('images/huy2.svg') }}" alt="Step 2"></div>
            <p><strong>Bước 2:</strong> Chọn <strong>Sao chép</strong> mã khuyến mãi</p>
        </div>
        <div class="guide-step">
            <div class="step-icon"><img src="{{ asset('images/huy3.svg') }}" alt="Step 3"></div>
            <p><strong>Bước 3:</strong> Dán mã tại trang thanh toán trên website hoặc ứng dụng của nhãn hàng/thương hiệu để áp dụng ưu đãi</p>
        </div>
    </div>
    <div id="description" class="tab-content">
        <p>Đây là mô tả về voucher giảm giá 40k cho hóa đơn từ 120k tại KFC. Ưu đãi áp dụng trong hôm nay với điều kiện thanh toán trực tuyến.</p>
    </div>
    <div class="footer">
        <div class="cart-icon">
            <img src="{{ asset('images/vector.svg') }}" alt="Cart Icon" class="cart-img">
            <span class="cart-badge">4</span>
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
    <div class="cart-popup" id="cartPopup">
        <button class="close-btn" onclick="hideCartPopup()">X</button>
        <h2>Giỏ hàng</h2>
        <div class="cart-item" onclick="toggleDelete(this)">
            <img src="{{ asset('images/dd.svg') }}" alt="Product Image" class="product-image">
            <div class="item-details">
                <div class="brand-info">
                    <div class="brand-logo-container">
                        <img src="{{ asset('images/dd1.svg') }}" alt="KFC Logo" class="brand-logo">
                        <span class="brand-text">Starbucks</span>
                        <span class="quantity">x1</span>
                    </div>
                    <div class="description">
                        <p>Voucher mua KFC với giá 19.000đ</p>
                    </div>
                </div>
                <div class="price-purchase">
                    <span class="price">Price: 30.000đ</span>
                    <span class="purchase">Purchase: 200.000đ <img src="{{ asset('images/hehe.svg') }}" alt="Purchase Icon" class="purchase-icon"></span>
                </div>
            </div>
            <button class="delete-btn" onclick="removeItem(this)">Xóa</button>
        </div>
        <div class="cart-item" onclick="toggleDelete(this)">
            <img src="{{ asset('images/dd.svg') }}" alt="Product Image" class="product-image">
            <div class="item-details">
                <div class="brand-info">
                    <div class="brand-logo-container">
                        <img src="{{ asset('images/dd1.svg') }}" alt="KFC Logo" class="brand-logo">
                        <span class="brand-text">Starbucks</span>
                        <span class="quantity">x1</span>
                    </div>
                    <div class="description">
                        <p>Voucher mua KFC với giá 19.000đ</p>
                    </div>
                </div>
                <div class="price-purchase">
                    <span class="price">Price: 30.000đ</span>
                    <span class="purchase">Purchase: 200.000đ <img src="{{ asset('images/hehe.svg') }}" alt="Purchase Icon" class="purchase-icon"></span>
                </div>
            </div>
            <button class="delete-btn" onclick="removeItem(this)">Xóa</button>
        </div>
        <div class="cart-item" onclick="toggleDelete(this)">
            <img src="{{ asset('images/dd.svg') }}" alt="Product Image" class="product-image">
            <div class="item-details">
                <div class="brand-info">
                    <div class="brand-logo-container">
                        <img src="{{ asset('images/dd1.svg') }}" alt="KFC Logo" class="brand-logo">
                        <span class="brand-text">Starbucks</span>
                        <span class="quantity">x1</span>
                    </div>
                    <div class="description">
                        <p>Voucher mua KFC với giá 19.000đ</p>
                    </div>
                </div>
                <div class="price-purchase">
                    <span class="price">Price: 30.000đ</span>
                    <span class="purchase">Purchase: 200.000đ <img src="{{ asset('images/hehe.svg') }}" alt="Purchase Icon" class="purchase-icon"></span>
                </div>
            </div>
            <button class="delete-btn" onclick="removeItem(this)">Xóa</button>
        </div>
        <div class="cart-item" onclick="toggleDelete(this)">
            <img src="{{ asset('images/dd.svg') }}" alt="Product Image" class="product-image">
            <div class="item-details">
                <div class="brand-info">
                    <div class="brand-logo-container">
                        <img src="{{ asset('images/dd1.svg') }}" alt="KFC Logo" class="brand-logo">
                        <span class="brand-text">Starbucks</span>
                        <span class="quantity">x1</span>
                    </div>
                    <div class="description">
                        <p>Voucher mua KFC với giá 19.000đ</p>
                    </div>
                </div>
                <div class="price-purchase">
                    <span class="price">Price: 30.000đ</span>
                    <span class="purchase">Purchase: 200.000đ <img src="{{ asset('images/hehe.svg') }}" alt="Purchase Icon" class="purchase-icon"></span>
                </div>
            </div>
            <button class="delete-btn" onclick="removeItem(this)">Xóa</button>
        </div>
        <div class="cart-item" onclick="toggleDelete(this)">
            <img src="{{ asset('images/dd.svg') }}" alt="Product Image" class="product-image">
            <div class="item-details">
                <div class="brand-info">
                    <div class="brand-logo-container">
                        <img src="{{ asset('images/dd1.svg') }}" alt="KFC Logo" class="brand-logo">
                        <span class="brand-text">Starbucks</span>
                        <span class="quantity">x1</span>
                    </div>
                    <div class="description">
                        <p>Voucher mua KFC với giá 19.000đ</p>
                    </div>
                </div>
                <div class="price-purchase">
                    <span class="price">Price: 30.000đ</span>
                    <span class="purchase">Purchase: 200.000đ <img src="{{ asset('images/hehe.svg') }}" alt="Purchase Icon" class="purchase-icon"></span>
                </div>
            </div>
            <button class="delete-btn" onclick="removeItem(this)">Xóa</button>
        </div>
    </div>
    <div class="country-popup" id="countryPopup">
        <button class="close-btn" onclick="hideCountryPopup()">×</button>
        <div class="country-content">
            <h2>KFC</h2>
            <p>Các quốc gia đang áp dụng</p>
            <div class="search-bar">
                <button><img src="{{ asset('images/ff.svg') }}" alt="Biểu tượng tìm kiếm" class="search-icon"></button>
                <input type="text" placeholder="Tìm quốc gia của bạn" onkeyup="filterCountries()">
            </div>
            <ul class="country-list">
                <li class="country-item"><img src="https://flagcdn.com/vn.svg" alt="Việt Nam" class="flag"> Việt Nam</li>
                <li class="country-item"><img src="https://flagcdn.com/gb.svg" alt="Anh" class="flag"> Anh</li>
                <li class="country-item"><img src="https://flagcdn.com/de.svg" alt="Đức" class="flag"> Đức</li>
                <li class="country-item"><img src="https://flagcdn.com/in.svg" alt="Ấn Độ" class="flag"> Ấn Độ</li>
                <li class="country-item"><img src="https://flagcdn.com/kr.svg" alt="Hàn Quốc" class="flag"> Hàn Quốc</li>
                <li class="country-item"><img src="https://flagcdn.com/jp.svg" alt="Nhật Bản" class="flag"> Nhật Bản</li>
                <li class="country-item"><img src="https://flagcdn.com/th.svg" alt="Thái Lan" class="flag"> Thái Lan</li>
                <li class="country-item"><img src="https://flagcdn.com/id.svg" alt="Indonesia" class="flag"> Indonesia</li>
                <li class="country-item"><img src="https://flagcdn.com/sg.svg" alt="Singapore" class="flag"> Singapore</li>
                <li class="country-item"><img src="https://flagcdn.com/fr.svg" alt="Pháp" class="flag"> Pháp</li>
                <li class="country-item"><img src="https://flagcdn.com/nl.svg" alt="Hà Lan" class="flag"> Hà Lan</li>
                <li class="country-item"><img src="https://flagcdn.com/gr.svg" alt="Hy Lạp" class="flag"> Hy Lạp</li>
                <li class="country-item"><img src="https://flagcdn.com/tr.svg" alt="Thổ Nhĩ Kỳ" class="flag"> Thổ Nhĩ Kỳ</li>
                <li class="country-item"><img src="https://flagcdn.com/cn.svg" alt="Trung Quốc" class="flag"> Trung Quốc</li>
            </ul>
        </div>
    </div>
</div>
<script>
    function showTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.nav-tabs button').forEach(btn => btn.classList.remove('active'));
        document.getElementById(tabName).classList.add('active');
        document.querySelector(`.nav-tabs button[onclick="showTab('${tabName}')"]`).classList.add('active');
    }

    function showCartPopup() {
        const cartPopup = document.getElementById('cartPopup');
        const overlay = document.createElement('div');
        overlay.className = 'overlay show cart-overlay';
        overlay.style.height = 'calc(100% - 80px)';
        overlay.addEventListener('click', hideCartPopup);
        document.body.appendChild(overlay);
        cartPopup.classList.add('show');
        cartPopup.style.bottom = '80px';
    }

    function hideCartPopup() {
        const cartPopup = document.getElementById('cartPopup');
        const overlay = document.querySelector('.overlay.cart-overlay');
        if (overlay) overlay.remove();
        cartPopup.classList.remove('show');
    }

    function showCountryPopup() {
        const countryPopup = document.getElementById('countryPopup');
        const overlay = document.createElement('div');
        overlay.className = 'overlay show country-overlay';
        overlay.addEventListener('click', hideCountryPopup);
        document.body.appendChild(overlay);
        countryPopup.classList.add('show');
    }

    function hideCountryPopup() {
        const countryPopup = document.getElementById('countryPopup');
        const overlay = document.querySelector('.overlay.country-overlay');
        if (overlay) overlay.remove();
        countryPopup.classList.remove('show');
    }

    function filterCountries() {
        let input = document.querySelector('.search-bar input').value.toLowerCase();
        let items = document.querySelectorAll('.country-item');
        items.forEach(item => {
            let text = item.textContent.toLowerCase();
            item.style.display = text.includes(input) ? '' : 'none';
        });
    }

    function toggleDelete(item) {
        item.classList.toggle('sliding');
    }

    function removeItem(button) {
        const item = button.parentElement;
        item.remove();
    }

    window.onload = function() { showTab('guide'); };
</script>
</body>
</html>
