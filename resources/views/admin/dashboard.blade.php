@extends('admin.layout')

@section('content')

<div class="admin-header">
    <h1>الرئيسية</h1>
</div>

<div class="stats-grid">

    <div class="stat-box">
        <span>{{ $categoriesCount }}</span>
        <p>كل المجالات</p>
    </div>

    <div class="stat-box">
        <span>{{ $activeCategoriesCount }}</span>
        <p>المجالات المفعلة</p>
    </div>

    <div class="stat-box">
        <span>{{ $itemsCount }}</span>
        <p>كل الخانات</p>
    </div>

    <div class="stat-box">
        <span>{{ $activeItemsCount }}</span>
        <p>الخانات المفعلة</p>
    </div>

</div>

@endsection