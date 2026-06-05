@extends('admin.layout')

@section('content')

<div class="admin-header">
    <h1>المجالات الرئيسية</h1>

    <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">
        إضافة مجال
    </a>
</div>

<div class="admin-card table-wrap">

    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>العربي</th>
                <th>العبري</th>
                <th>اللون</th>
                <th>الترتيب</th>
                <th>الحالة</th>
                <th>إجراءات</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title_ar }}</td>
                    <td>{{ $category->title_he }}</td>
                    <td>
                        <span class="color-dot" style="background: {{ $category->color }}"></span>
                    </td>
                    <td>{{ $category->sort_order }}</td>
                    <td>
                        @if($category->is_active)
                            <span class="badge badge-active">مفعّل</span>
                        @else
                            <span class="badge badge-inactive">مخفي</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions-row">
                            <a class="btn btn-warning" href="{{ route('admin.categories.edit', $category) }}">
                                تعديل
                            </a>

                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟ سيتم حذف الخانات التابعة أيضًا.');">
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