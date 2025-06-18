<?php
// app/Data/ProductData.php
namespace App\Data;

class ProductData
{
    public static function getFeaturedProducts()
    {
        return [
            [
                'id' => 1,
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400&h=300&fit=crop',
                'title' => 'Mua KFC với giá chỉ từ',
                'subtitle' => 'Flash Sale Giá Tăng',
                'original_price' => '19.000đ',
                'sale_price' => '20.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'GrabFood',
                'badge' => 'Flash Sale',
                'badge_color' => 'bg-green-500',
                'brand' => 'Starbucks',
                'url' => '/products/1'
            ],
            [
                'id' => 2,
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400&h=300&fit=crop',
                'title' => 'Chỉ với 28K một ly MIXUE',
                'subtitle' => 'với mùa hè cực chill',
                'original_price' => '35.000đ',
                'sale_price' => '28.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'MIXUE',
                'badge' => 'Hot Deal',
                'badge_color' => 'bg-red-500',
                'brand' => 'MIXUE',
                'url' => '/products/2'
            ],
            [
                'id' => 3,
                'image' => 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=400&h=300&fit=crop',
                'title' => 'Pizza Hut Combo Đặc Biệt',
                'subtitle' => 'Giảm giá 50% tất cả size',
                'original_price' => '299.000đ',
                'sale_price' => '149.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'ShopeeFood',
                'badge' => 'Giảm 50%',
                'badge_color' => 'bg-orange-500',
                'brand' => 'Pizza Hut',
                'url' => '/products/3'
            ],
            [
                'id' => 4,
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=300&fit=crop',
                'title' => 'Burger King Whopper Meal',
                'subtitle' => 'Combo tiết kiệm nhất',
                'original_price' => '159.000đ',
                'sale_price' => '99.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'GrabFood',
                'badge' => 'Tiết Kiệm',
                'badge_color' => 'bg-yellow-500',
                'brand' => 'Burger King',
                'url' => '/products/4'
            ],
            [
                'id' => 5,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop',
                'title' => 'Trà Sữa Thái Xanh Đặc Biệt',
                'subtitle' => 'Size L miễn phí topping',
                'original_price' => '65.000đ',
                'sale_price' => '45.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'Baemin',
                'badge' => 'Mới',
                'badge_color' => 'bg-blue-500',
                'brand' => 'TocoToco',
                'url' => '/products/5'
            ]
        ];
    }

    public static function getFlashSaleProducts()
    {
        return [
            [
                'id' => 6,
                'image' => 'https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=400&h=300&fit=crop',
                'title' => 'Cà Phê Espresso Đặc Biệt',
                'subtitle' => 'Hương vị đậm đà',
                'original_price' => '45.000đ',
                'sale_price' => '25.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'Highland Coffee',
                'badge' => 'Flash Sale',
                'badge_color' => 'bg-red-600',
                'brand' => 'Highland Coffee',
                'url' => '/products/6'
            ],
            [
                'id' => 7,
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=400&h=300&fit=crop',
                'title' => 'Sushi Set Premium',
                'subtitle' => 'Combo 12 miếng tươi ngon',
                'original_price' => '350.000đ',
                'sale_price' => '199.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'Now',
                'badge' => 'Cao Cấp',
                'badge_color' => 'bg-purple-500',
                'brand' => 'Sushi World',
                'url' => '/products/7'
            ]
        ];
    }

    public static function getDrinksProducts()
    {
        return [
            [
                'id' => 8,
                'image' => 'https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=400&h=300&fit=crop',
                'title' => 'Cà Phê Americano',
                'subtitle' => 'Vị cà phê đậm đà',
                'original_price' => '35.000đ',
                'sale_price' => '30.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'Starbucks',
                'badge' => 'Best Seller',
                'badge_color' => 'bg-green-600',
                'brand' => 'Starbucks',
                'url' => '/products/8'
            ],
            [
                'id' => 9,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop',
                'title' => 'Trà Sữa Ô Long',
                'subtitle' => 'Hương trà thơm ngon',
                'original_price' => '55.000đ',
                'sale_price' => '40.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'Gong Cha',
                'badge' => 'Hot',
                'badge_color' => 'bg-orange-500',
                'brand' => 'Gong Cha',
                'url' => '/products/9'
            ]
        ];
    }

    public static function getFoodProducts()
    {
        return [
            [
                'id' => 10,
                'image' => 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=400&h=300&fit=crop',
                'title' => 'Pizza Margherita Đặc Biệt',
                'subtitle' => 'Phô mai tươi và sốt cà chua',
                'original_price' => '250.000đ',
                'sale_price' => '199.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'Dominos',
                'badge' => 'Giảm Giá',
                'badge_color' => 'bg-red-500',
                'brand' => 'Dominos',
                'url' => '/products/10'
            ],
            [
                'id' => 11,
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=300&fit=crop',
                'title' => 'Hamburger Bò Nướng',
                'subtitle' => 'Thịt bò Úc 100%',
                'original_price' => '120.000đ',
                'sale_price' => '89.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/3039/3039359.png',
                'platform_name' => 'McDonald',
                'badge' => 'Premium',
                'badge_color' => 'bg-yellow-600',
                'brand' => 'McDonald',
                'url' => '/products/11'
            ]
        ];
    }

    public static function getTravelProducts()
    {
        return [
            [
                'id' => 12,
                'image' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400&h=300&fit=crop',
                'title' => 'Tour Đà Lạt 3 Ngày 2 Đêm',
                'subtitle' => 'Khám phá thiên đường ngàn hoa',
                'original_price' => '2.500.000đ',
                'sale_price' => '1.999.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/5968/5968703.png',
                'platform_name' => 'Traveloka',
                'badge' => 'Giảm 20%',
                'badge_color' => 'bg-blue-500',
                'brand' => 'Du Lịch Việt',
                'url' => '/products/12'
            ],
            [
                'id' => 13,
                'image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=400&h=300&fit=crop',
                'title' => 'Vé Máy Bay Hà Nội - Phú Quốc',
                'subtitle' => 'Khứ hồi giá ưu đãi',
                'original_price' => '3.200.000đ',
                'sale_price' => '2.500.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/5968/5968703.png',
                'platform_name' => 'Vietjet Air',
                'badge' => 'Hot Deal',
                'badge_color' => 'bg-green-500',
                'brand' => 'Vietjet',
                'url' => '/products/13'
            ],
            [
                'id' => 13,
                'image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=400&h=300&fit=crop',
                'title' => 'Vé Máy Bay Hà Nội - Phú Quốc',
                'subtitle' => 'Khứ hồi giá ưu đãi',
                'original_price' => '3.200.000đ',
                'sale_price' => '2.500.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/5968/5968703.png',
                'platform_name' => 'Vietjet Air',
                'badge' => 'Hot Deal',
                'badge_color' => 'bg-green-500',
                'brand' => 'Vietjet',
                'url' => '/products/13'
            ],


        ];
    }

    public static function getEntertainmentProducts()
    {
        return [
            [
                'id' => 14,
                'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=400&h=300&fit=crop',
                'title' => 'Vé Cinema CGV',
                'subtitle' => 'Phim bom tấn 2025',
                'original_price' => '120.000đ',
                'sale_price' => '80.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/174/174200.png',
                'platform_name' => 'CGV Cinemas',
                'badge' => 'Giảm 33%',
                'badge_color' => 'bg-red-500',
                'brand' => 'CGV',
                'url' => '/products/14'
            ],
            [
                'id' => 14,
                'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=400&h=300&fit=crop',
                'title' => 'Vé Cinema CGV',
                'subtitle' => 'Phim bom tấn 2025',
                'original_price' => '120.000đ',
                'sale_price' => '80.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/174/174200.png',
                'platform_name' => 'CGV Cinemas',
                'badge' => 'Giảm 33%',
                'badge_color' => 'bg-red-500',
                'brand' => 'CGV',
                'url' => '/products/14'
            ],
            [
                'id' => 15,
                'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=400&h=300&fit=crop',
                'title' => 'Vé Công Viên Nước',
                'subtitle' => 'Trải nghiệm mùa hè',
                'original_price' => '200.000đ',
                'sale_price' => '150.000đ',
                'platform' => 'https://cdn-icons-png.flaticon.com/24/174/174200.png',
                'platform_name' => 'VinWonders',
                'badge' => 'Mới',
                'badge_color' => 'bg-purple-500',
                'brand' => 'Vinpearl',
                'url' => '/products/15'
            ]
        ];
    }

    public static function getNewProducts()
    {
        return [];
    }

    public static function getAllCategories()
    {
        return [
            [
                'id' => 'featured',
                'name' => 'Nổi Bật',
                'category_image' => '/images/icon1.png',
                'products' => self::getFeaturedProducts()
            ],
            [
                'id' => 'travel',
                'name' => 'Du Lịch',
                'category_image' => '/images/beach.png',
                'products' => self::getTravelProducts()
            ],
            [
                'id' => 'drinks',
                'name' => 'Đồ Uống',
                'category_image' => '/images/coffee.png',
                'products' => self::getDrinksProducts()
            ],
            [
                'id' => 'food',
                'name' => 'Thức Ăn',
                'category_image' => '/images/heart.png',
                'products' => self::getFoodProducts()
            ],
            [
                'id' => 'entertainment',
                'name' => 'Giải Trí',
                'category_image' => '/images/icon.png',
                'products' => self::getEntertainmentProducts()
            ],
            [
                'id' => 'travel',
                'name' => 'Du Lịch',
                'category_image' => '/images/beach.png',
                'products' => self::getTravelProducts()
            ],
            [
                'id' => 'entertainment',
                'name' => 'Giải Trí',
                'category_image' => '/images/icon.png',
                'products' => self::getEntertainmentProducts()
            ],
            [
                'id' => 'new',
                'name' => 'Sản Phẩm Mới',
                'category_image' => '/images/icon1.png',
                'products' => self::getNewProducts()
            ]
        ];
    }
}
