<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        .outer-container {
            width: 100%;
            max-width: 100vw;
            margin: 0 auto;
            padding: 0;
        }

        .categories-section {
            width: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: transparent;
            padding: 20px 0;
            box-sizing: border-box;
            max-width: 100vw;
            margin: 0;
        }

        .categories-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 100vw;
            height: var(--bg-height, 100px);
            background: #ffd1dc;
            border-radius: 0 0 50px 50px;
            z-index: 1;
            transform: translate(-50%, -20%);
        }

        .categories-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: 90%;
            max-width: 90vw;
            gap: 8px;
            flex-wrap: nowrap;
            background: white;
            border-radius: 15px;
            padding: 8px 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
            box-sizing: border-box;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }

        .categories-row {
            display: flex;
            gap: 12px;
            width: fit-content;
        }

        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #666;
            transition: transform 0.3s ease, color 0.3s ease;
            padding: 10px;
            border-radius: 10px;
            min-width: 70px;
            max-width: 130px;
            flex: 0 0 auto;
        }

        .category-item:hover {
            transform: translateY(-5px);
            color: #333;
        }

        .category-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 6px;
            overflow: hidden;
        }

        .category-icon img {
            width: 60px;
            height: 60px;
            object-fit: contain; /* Thay đổi từ cover sang contain để giữ nguyên tỷ lệ ảnh */
        }

        .category-item:hover .category-icon {
            box-shadow: 0 6px 18px rgba(0,0,0,0.2);
            transform: scale(1.05);
        }

        .category-text {
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .categories-container {
                width: 90%;
                max-width: 90vw;
                padding: 8px 8px;
            }
            .categories-row {
                gap: 8px;
            }
            .category-item {
                min-width: 60px;
                max-width: 110px;
            }
            .category-icon {
                width: 50px;
                height: 50px;
            }
            .category-icon img {
                width: 50px;
                height: 50px;
            }
            .category-text {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .categories-section {
                padding: 15px 0;
            }
            .categories-container {
                width: 90%;
                max-width: 90vw;
                padding: 6px 6px;
            }
            .categories-row {
                gap: 6px;
            }
            .category-item {
                min-width: 50px;
                max-width: 90px;
                padding: 6px;
            }
            .category-icon {
                width: 40px;
                height: 40px;
            }
            .category-icon img {
                width: 40px;
                height: 40px;
            }
            .category-text {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
<div class="outer-container">
    <div class="categories-section">
        <div class="categories-container">
            <div class="categories-row">
                @php
                    use App\Data\ProductData;
                    $categories = ProductData::getAllCategories();
                    $visibleCategories = array_slice($categories, 0, 5);
                    foreach ($visibleCategories as $category) {
                        $categoryId = $category['id'];
                        $categoryName = $category['name'];
                        $categoryImage = $category['category_image'];
                        echo "<a href='/category/$categoryId' class='category-item'>";
                        echo "<div class='category-icon'><img src='$categoryImage' alt='$categoryName'></div>";
                        echo "<div class='category-text'>$categoryName</div>";
                        echo "</a>";
                    }
                    $remainingCategories = array_slice($categories, 5);
                    foreach ($remainingCategories as $category) {
                        $categoryId = $category['id'];
                        $categoryName = $category['name'];
                        $categoryImage = $category['category_image'];
                        echo "<a href='/category/$categoryId' class='category-item'>";
                        echo "<div class='category-icon'><img src='$categoryImage' alt='$categoryName'></div>";
                        echo "<div class='category-text'>$categoryName</div>";
                        echo "</a>";
                    }
                @endphp
            </div>
        </div>
    </div>
</div>
</body>
</html>
