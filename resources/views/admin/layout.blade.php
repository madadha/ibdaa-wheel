<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم عجلة التمكين</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>

<div class="admin-layout">

    <aside class="sidebar">
        <h2>لوحة التحكم</h2>

        <a href="{{ route('admin.dashboard') }}">الرئيسية</a>
        <a href="{{ route('admin.categories.index') }}">المجالات الرئيسية</a>
        <a href="{{ route('admin.wheel-items.index') }}">خانات الدولاب</a>
        <a href="{{ url('/ar') }}" target="_blank">عرض العربية</a>
        <a href="{{ url('/he') }}" target="_blank">عرض العبرية</a>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="logout-button" type="submit">
                تسجيل الخروج
            </button>
        </form>
    </aside>

    <main class="admin-main">

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>