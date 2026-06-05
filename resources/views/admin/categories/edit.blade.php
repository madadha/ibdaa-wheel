@extends('admin.layout')

@section('content')

<div class="admin-header">
    <h1>تعديل مجال رئيسي</h1>

    <a class="btn btn-light" href="{{ route('admin.categories.index') }}">
        رجوع
    </a>
</div>

<div class="admin-card">

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label>اسم المجال بالعربية</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $category->title_ar) }}" required>
            </div>

            <div class="form-group">
                <label>שם התחום בעברית</label>
                <input type="text" name="title_he" value="{{ old('title_he', $category->title_he) }}" required>
            </div>

            <div class="form-group">
                <label>اللون</label>
                <input type="color" name="color" value="{{ old('color', $category->color) }}" required>
            </div>

            <div class="form-group">
                <label>الترتيب</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0" required>
            </div>

            <div class="form-group full">
                <label class="checkbox-row">
                    <input type="checkbox" name="is_active" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <span>مفعّل</span>
                </label>
            </div>

        </div>

        <br>

        <button class="btn btn-primary" type="submit">
            حفظ التعديل
        </button>

    </form>

</div>

@endsection