<!DOCTYPE html>
<html lang="{{ $texts['html_lang'] }}" dir="{{ $texts['dir'] }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $texts['page_title'] }}</title>

    <!-- Fonts: Arabic Cairo + Hebrew Rubik -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Rubik:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/wheel.css') }}">
</head>
<body class="lang-{{ $lang }}">

<div class="page-shell">

    <header class="hero-header">

        <a class="language-link" href="{{ $texts['switch_url'] }}">
            {{ $texts['switch_lang'] }}
        </a>

        <div class="logo-card">
            <img class="school-logo"
                 src="{{ $texts['logo_url'] }}"
                 alt="{{ $texts['school'] }}">
        </div>

        <div class="school-badge">
            {{ $texts['school'] }}
        </div>

        <h1>
            {{ $texts['page_title'] }}
        </h1>

        <p>
            {{ $texts['subtitle'] }}
        </p>

    </header>

    @if($items->count() > 0)

        <main class="wheel-section">

            <div class="wheel-card">

                <div class="pointer"></div>

                <div class="wheel-wrapper">

                    <canvas id="wheelCanvas" width="720" height="720"></canvas>

                    <div class="wheel-center">
                        <span>♥</span>
                    </div>

                </div>

                <button id="spinButton" class="spin-button">
                    {{ $texts['spin'] }}
                </button>

            </div>

        </main>

    @else

        <div class="empty-message">
            {{ $texts['empty'] }}
        </div>

    @endif

</div>


<div id="resultModal" class="modal-overlay">

    <div class="modal-box">

        <button id="closeModal" class="modal-close">
            ×
        </button>

        <div id="modalCategory" class="modal-category"></div>

        <h2 id="modalTitle"></h2>

        <p id="modalDescription"></p>

        <div class="question-box">
            <strong>{{ $texts['question'] }}</strong>
            <p id="modalQuestion"></p>
        </div>

        <button id="spinAgainButton" class="again-button">
            {{ $texts['again'] }}
        </button>

    </div>

</div>


<footer class="site-footer">

    <div class="footer-inner">

        <div class="footer-logo-box">
            <img src="{{ $texts['logo_url'] }}" alt="{{ $texts['school'] }}">
        </div>

        <div class="footer-content">

            @if($lang === 'ar')

                <h3>مدرسة إبداع التكنولوجية – بير المكسور</h3>

                <p class="footer-description">
                    مدرسة إبداع التكنولوجية في بير المكسور مؤسسة تعليمية تسعى إلى دمج التعليم الأكاديمي بالتطبيق العملي وبناء جيل مبدع لمستقبل تكنولوجي متطور.
                </p>

                <div class="footer-contact-title">
                    معلومات الاتصال
                </div>

                <div class="footer-contact-list">
                    <p>📍 Bir al-Maksur, North District, 1792500, Israel</p>
                    <p>📞 047706271</p>
                    <p>📞 0505858644</p>
                    <p>✉️ atidtek@atid.org.il</p>
                </div>

            @else

                <h3>בית הספר הטכנולוגי איבדאע – ביר אלמכסור</h3>

                <p class="footer-description">
                    בית הספר הטכנולוגי איבדאע בביר אלמכסור הוא מוסד חינוכי השואף לשלב בין למידה אקדמית להתנסות מעשית, ולבנות דור יצירתי לעתיד טכנולוגי מתקדם.
                </p>

                <div class="footer-contact-title">
                    פרטי התקשרות
                </div>

                <div class="footer-contact-list">
                    <p>📍 Bir al-Maksur, North District, 1792500, Israel</p>
                    <p>📞 047706271</p>
                    <p>📞 0505858644</p>
                    <p>✉️ atidtek@atid.org.il</p>
                </div>

            @endif

        </div>

    </div>

</footer>


<script>
    window.wheelCategories = @json($categories);
    window.wheelItems = @json($items);
    window.wheelTexts = @json($texts);
    window.currentLang = @json($lang);
</script>

<script src="{{ asset('assets/js/wheel.js') }}"></script>

</body>
</html>