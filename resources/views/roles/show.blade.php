@extends('layouts.app')
@section('title','عرض الدور')

@section('content')
<div class="d-flex justify-content-between">
    <h2>عرض الدور</h2>
    <a class="btn" href="{{ URL::previous() }}"> رجوع</a>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="form-group">
           <label for="">الاسم</label>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <strong>الصلاحيات</strong>
            @foreach ($role->permissions as $permission)
            <li>{{ $permission->description }}</li>
            @endforeach
        </div>
    </div>
</div>
@endsection