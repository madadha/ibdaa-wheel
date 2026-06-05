@extends('admin.layout')

@section('content')

<div class="admin-header">
    <h1>إضافة مجال رئيسي</h1>

    <a class="btn btn-light" href="{{ route('admin.categories.index') }}">
        رجوع
    </a>
</div>

<div class="admin-card">

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>اسم المجال بالعربية</label>
                <input type="text" name="title_ar" value="{{ old('title_ar') }}" required>
            </div>

            <div class="form-group">
                <label>שם התחום בעברית</label>
                <input type="text" name="title_he" value="{{ old('title_he') }}" required>
            </div>

            <div class="form-group">
                <label>اللون</label>
                <input type="color" name="color" value="{{ old('color', '#3498db') }}" required>
            </div>

            <div class="form-group">
                <label>الترتيب</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" required>
            </div>

            <div class="form-group full">
                <label class="checkbox-row">
                    <input type="checkbox" name="is_active" checked>
                    <span>مفعّل</span>
                </label>
            </div>

        </div>

        <br>

        <button class="btn btn-primary" type="submit">
            حفظ
        </button>

    </form>

</div>

@endsection