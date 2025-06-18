<div class="product-card">
    <div class="card-image">
        <img src="{{ $image }}" alt="{{ $title }}">

        <!-- Badge -->
        @if($badge)
            <div class="badge {{ $badgeColor }}">
                {{ $badge }}
            </div>
        @endif

        <!-- Plus Button -->
        <button class="plus-btn">+</button>
    </div>

    <div class="card-content">
        <div class="platform-info">
            <div class="platform">
                <img src="{{ $platform }}" alt="Platform">
                <span>{{ $brand }}</span>
            </div>
        </div>

        <h3 class="card-title">{{ $title }}</h3>

        <div class="price-info">
            @if($originalPrice && $originalPrice !== $salePrice)
                <span class="original-price">{{ $originalPrice }}</span>
            @endif
            <span class="sale-price">{{ $salePrice }}</span>
        </div>
    </div>
</div>
