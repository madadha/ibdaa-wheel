<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دخول لوحة التحكم</title>

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>

<div class="login-page">

    <form class="login-card" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <h1>دخول لوحة التحكم</h1>

        @if($errors->has('login_error'))
            <div class="alert-error">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <div class="form-group">
            <label>اسم المستخدم</label>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </div>

        <br>

        <div class="form-group">
            <label>كلمة المرور</label>
            <input type="password" name="password" required>
        </div>

        <br>

        <button class="btn btn-primary" type="submit" style="width:100%;">
            دخول
        </button>
    </form>

</div>

</body>
</html>