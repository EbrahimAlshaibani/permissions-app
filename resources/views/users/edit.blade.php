@extends('layouts.app')
@section('title','تعديل المستخدمين')



@section('content')

<div class="d-flex justify-content-between">
    <h2>تعديل المستخدم</h2>
    <a class="btn" href="{{ URL::previous() }}"> رجوع</a>
</div>

<form id="reportUploadForm" class="row g-3" method="POST" action="{{route('users.update', $user->id)}}" onsubmit="return confirm('هل انت متأكد');" autocomplete="off"> 
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label for="name" class="form-label">الاسم</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="الاسم" value="{{ $user->name  }}">
        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-6">
        <label for="username" class="form-label">اليوزر</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="اليوزر" value="{{ $user->username }}">
        <span class="text-danger">@error('username'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-6">
        <label for="is_enabled" class="form-label">مفعل</label>
        <select class="form-select" id="is_enabled" name="is_enabled" aria-label="Default select example">
            <option selected value=""></option>
            <option value="1" {{ $user->is_enabled == 1 ? 'selected' : '' }}> {{ "مفعل" }}</option>
            <option value="0" {{ $user->is_enabled == 0 ? 'selected' : '' }}> {{ "غير مفعل" }}</option>
        </select>
        <span class="text-danger">@error('is_enabled'){{ $message }}@enderror</span>
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">الايميل (أختياري)</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="الايميل" value="{{ $user->email }}">
        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-6">
        <label for="phone" class="form-label"> رقم الهاتف (أختياري)</label>
        <input type="number" class="form-control" id="phone" name="phone" placeholder="رقم الهاتف" value="{{ $user->phone }}">
        <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-6">
        <label for="address" class="form-label">العنوان (أختياري)</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="العنوان" value="{{ $user->address }}">
        <span class="text-danger">@error('address'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-6">
        <label for="password" class="form-label">كلمة المرور</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="كلمة المرور" value="{{ old('password') }}" autocomplete="off">
        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-6">
        <label for="confirm-password" class="form-label">كلمة المرور</label>
        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="تأكيد كلمة المرور" value="{{ old('confirm-password') }}" autocomplete="off">
        <span class="text-danger">@error('confirm-password'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-12">
        <label for="roles" class="form-label">الادوار</label>
        <select class="form-select" name="roles[]" multiple>
            <option value="">---</option>
            @foreach ($roles as $role)
                <option value="{{$role->name}}" {{in_array($role->name, $user->roles->pluck('name')->toArray())?'selected':''}} > {{ $role->name }}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('roles'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-12">
        <label for="permissions" class="form-label">الصلاحيات</label>
        <select class="form-select" name="permissions[]" multiple>
            <option value="">---</option>
            @foreach ($permissions as $permission)
                <option value="{{$permission->name}}" {{in_array($permission->name, $user->permissions->pluck('name')->toArray())?'selected':''}}>{{$permission->description}}</option>
            @endforeach
        </select>
        <span class="text-danger">@error('permissions'){{ $message }}@enderror</span>
    </div>
    <div class="col-12">
        <button type="submit" id="submit" class="btn btn-primary mb-4" style="width: 100%" onclick="add()">تعديل <i class="bi bi-file-earmark-plus"></i></button>
    </div>
</div>


@endsection
@section('scripts')
    <script>function add(){ $('#submit').hide()}</script>
@endsection
