@extends('admin.layout')

@section('content')

<div class="admin-header">
    <h1>تعديل خانة</h1>

    <a class="btn btn-light" href="{{ route('admin.wheel-items.index') }}">
        رجوع
    </a>
</div>

<div class="admin-card">

    <form method="POST" action="{{ route('admin.wheel-items.update', $item) }}">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label>المجال الرئيسي</label>
                <select name="category_id" required>
                    <option value="">اختر المجال</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title_ar }} / {{ $category->title_he }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>الأيقونة</label>
                <input type="text"
                       name="icon"
                       value="{{ old('icon', $item->icon) }}"
                       placeholder="مثال: ⭐ أو 🛡️ أو 🤝">
            </div>

            <div class="form-group">
                <label>عنوان الخانة بالعربية</label>
                <input type="text"
                       name="title_ar"
                       value="{{ old('title_ar', $item->title_ar) }}"
                       required>
            </div>

            <div class="form-group">
                <label>כותרת בעברית</label>
                <input type="text"
                       name="title_he"
                       value="{{ old('title_he', $item->title_he) }}"
                       required>
            </div>

            <div class="form-group full">
                <label>الشرح بالعربية</label>
                <textarea name="description_ar">{{ old('description_ar', $item->description_ar) }}</textarea>
            </div>

            <div class="form-group full">
                <label>הסבר בעברית</label>
                <textarea name="description_he">{{ old('description_he', $item->description_he) }}</textarea>
            </div>

            <div class="form-group full">
                <label>سؤال للتفكير بالعربية</label>
                <textarea name="question_ar">{{ old('question_ar', $item->question_ar) }}</textarea>
            </div>

            <div class="form-group full">
                <label>שאלה למחשבה בעברית</label>
                <textarea name="question_he">{{ old('question_he', $item->question_he) }}</textarea>
            </div>

            <div class="form-group">
                <label>الترتيب</label>
                <input type="number"
                       name="sort_order"
                       value="{{ old('sort_order', $item->sort_order) }}"
                       min="0"
                       required>
            </div>

            <div class="form-group">
                <label>الحالة</label>

                <label class="checkbox-row">
                    <input type="checkbox"
                           name="is_active"
                           {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
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