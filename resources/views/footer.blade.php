<div class="footer">
    <div class="footer-item active">
        <img src="{{ asset('images/home 04.png') }}" alt="Trang chủ" class="footer-icon">
        <span class="footer-text">Trang chủ</span>
    </div>
    <div class="footer-item">
        <img src="{{ asset('images/voucher.png') }}" alt="Voucher của tôi" class="footer-icon">
        <span class="footer-text">Voucher của tôi</span>
    </div>
    <div class="footer-item">
        <img src="{{ asset('images/user.png') }}" alt="Tài khoản" class="footer-icon">
        <span class="footer-text">Tài khoản</span>
    </div>
</div>

<style>
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        max-width: 100vw;
        background-color: #fff;
        display: flex;
        justify-content: space-around;
        align-items: center;
        border-top: 1px solid #e0e0e0;
        padding: 8px 0;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .footer-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #666;
        font-size: 12px;
        transition: color 0.3s ease;
    }

    .footer-item.active {
        color: #FF0000; /* Màu đỏ cho mục active */
    }

    .footer-icon {
        width: 24px;
        height: 24px;
        margin-bottom: 2px;
    }

    .footer-text {
        font-weight: 500;
    }

    @media (min-width: 768px) {
        .footer {
            display: none; /* Ẩn footer trên màn hình lớn */
        }
    }
</style>
