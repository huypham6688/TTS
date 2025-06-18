<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KFC Country Selection</title>
    <link rel="stylesheet" href="{{ asset('css/search-bar.css') }}">
    <style>
        .container {
            padding: 20px;
            font-family: Arial, sans-serif;
            position: relative;
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
        .close-btn {
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
        .close-btn:hover {
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
    </style>
</head>
<body>
<div class="container">
    <button class="close-btn" onclick="history.back()">×</button>
    <h2>KFC</h2>
    <p>Các quốc gia đang áp dụng</p>
    <div class="search-bar">
        <button><img src="{{ asset('images/ff.svg') }}" alt="Search Icon" class="search-icon"></button>
        <input type="text" placeholder="Search your country" onkeyup="filterCountries()">
    </div>
    <ul class="country-list">
        <li class="country-item"><img src="https://flagcdn.com/vn.svg" alt="Vietnam" class="flag"> Việt Nam</li>
        <li class="country-item"><img src="https://flagcdn.com/gb.svg" alt="English" class="flag"> English</li>
        <li class="country-item"><img src="https://flagcdn.com/de.svg" alt="Deutsch" class="flag"> Deutsch</li>
        <li class="country-item"><img src="https://flagcdn.com/in.svg" alt="India" class="flag"> India</li>
        <li class="country-item"><img src="https://flagcdn.com/kr.svg" alt="Korea" class="flag"> Korea</li>
        <li class="country-item"><img src="https://flagcdn.com/jp.svg" alt="Japan" class="flag"> Japan</li>
        <li class="country-item"><img src="https://flagcdn.com/th.svg" alt="ThaiLand" class="flag"> ThaiLand</li>
        <li class="country-item"><img src="https://flagcdn.com/id.svg" alt="Indonesia" class="flag"> Indonesia</li>
        <li class="country-item"><img src="https://flagcdn.com/sg.svg" alt="Singapore" class="flag"> Singapore</li>
        <li class="country-item"><img src="https://flagcdn.com/fr.svg" alt="Français" class="flag"> Français</li>
        <li class="country-item"><img src="https://flagcdn.com/nl.svg" alt="Nederlands" class="flag"> Nederlands</li>
        <li class="country-item"><img src="https://flagcdn.com/gr.svg" alt="Ελληνικά" class="flag"> Ελληνικά</li>
        <li class="country-item"><img src="https://flagcdn.com/tr.svg" alt="Turk" class="flag"> Turk</li>
        <li class="country-item"><img src="https://flagcdn.com/cn.svg" alt="China" class="flag"> China</li>
    </ul>
</div>

<script>
    function filterCountries() {
        let input = document.querySelector('.search-bar input').value.toLowerCase();
        let items = document.querySelectorAll('.country-item');
        items.forEach(item => {
            let text = item.textContent.toLowerCase();
            item.style.display = text.includes(input) ? '' : 'none';
        });
    }
</script>
</body>
</html>
