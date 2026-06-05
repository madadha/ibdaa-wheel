@extends('admin.layout')

@section('content')

<div class="admin-header">
    <h1>خانات الدولاب</h1>

    <a class="btn btn-primary" href="{{ route('admin.wheel-items.create') }}">
        إضافة خانة
    </a>
</div>

<div class="admin-card table-wrap">

    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>المجال</th>
                <th>العنوان العربي</th>
                <th>العنوان العبري</th>
                <th>الأيقونة</th>
                <th>الترتيب</th>
                <th>الحالة</th>
                <th>إجراءات</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>

                    <td>
                        @if($item->category)
                            <span class="color-dot" style="background: {{ $item->category->color }}"></span>
                            <br>
                            {{ $item->category->title_ar }}
                        @else
                            غير محدد
                        @endif
                    </td>

                    <td>{{ $item->title_ar }}</td>
                    <td>{{ $item->title_he }}</td>

                    <td style="font-size: 24px;">
                        {{ $item->icon ?: '—' }}
                    </td>

                    <td>{{ $item->sort_order }}</td>

                    <td>
                        @if($item->is_active)
                            <span class="badge badge-active">مفعّل</span>
                        @else
                            <span class="badge badge-inactive">مخفي</span>
                        @endif
                    </td>

                    <td>
                        <div class="actions-row">
                            <a class="btn btn-warning" href="{{ route('admin.wheel-items.edit', $item) }}">
                                تعديل
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.wheel-items.destroy', $item) }}"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه الخانة؟');">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger" type="submit">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection