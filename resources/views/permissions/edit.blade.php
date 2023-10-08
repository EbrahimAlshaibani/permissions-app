@extends('layouts.app')
@section('title','تعديل صلاحية')


@section('content')
<div class="d-flex justify-content-between">
    <h2>تعديل صلاحية </h2>
    <a class="btn" href="{{ URL::previous() }}"> رجوع</a>
</div>

<form class="row g-3" method="POST" action="{{route('permissions.update',$permission)}}" onsubmit="return confirm('هل انت متأكد');">
    @csrf
    @method('PUT')
    <div class="col-md-4">
        <label for="name" class="form-label">الاسم </label>
        <input type="text" class="form-control" id="name" name="name" placeholder="الاسم " value="{{ $permission->name }}">
        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-4">
        <label for="description" class="form-label">الوصف للمستخدم </label>
        <input type="text" class="form-control" id="description" name="description" placeholder="الوصف للمستخدم " value="{{ $permission->description }}">
        <span class="text-danger">@error('description'){{ $message }}@enderror</span>
    </div>

    <div class="col-md-4">
        <label for="submit" class="form-label">تعديل </label>
        <button type="submit" id="submit" class="btn btn-primary mb-4 d-block w-100">اضافة</button>
    </div>
@endsection