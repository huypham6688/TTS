<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm nâng cao</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
        }
        h1 {
            font-size: 18px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
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
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1002;
            pointer-events: auto;
        }
        .overlay.show {
            display: block;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Bộ lọc nâng cao</h1>

    <form id="filter-form" action="/category/featured" method="GET">
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
        window.location.href = '/category/featured';
    });

    // Xử lý popup chọn quốc gia
    function showCountryPopup() {
        const countryPopup = document.getElementById('countryPopup');
        const overlay = document.createElement('div');
        overlay.className = 'overlay show';
        overlay.addEventListener('click', hideCountryPopup);
        document.body.appendChild(overlay);
        countryPopup.classList.add('show');
    }

    function hideCountryPopup() {
        const countryPopup = document.getElementById('countryPopup');
        const overlay = document.querySelector('.overlay');
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

