@extends('layouts.app')
@section('title','إدارة المستخدمين')


@section('content')
<div class="row">
    <div class="col-lg-12 mt-4">
        <div class="pull-left">
            <h2>إدارة المستخدمين</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-sm btn-success" href="{{ route('users.create') }}"> <i class="bi bi-person-plus"></i> إضافة مستخدم جديد</a>
        </div>
    </div>
</div>
<table class="table table-bordered table-hover mt-2 text-center">
    <tr>
    <th>الرقم</th>
    <th>اليوزر</th>
    <th>الاسم</th>
    <th>حالة الحساب</th>
    <th>الادوار</th>
    <th width="280px">العمليات</th>
    </tr>
    @foreach ($users as $user)
    <tr>
    <td data-label="الرقم">{{ $user->id }}</td>
    <td data-label="اليوزر">{{ $user->username }}</td>
    <td data-label="الاسم">{{ $user->name }}</td>
    <td data-label="حالة الحساب">
        @if ($user->is_enabled==1)
        <span class="badge text-bg-success">
            <i class="bi bi-unlock-fill"></i>
        </span>
        @else
        <span class="badge text-bg-danger">
            <i class="bi bi-lock-fill"></i>
        </span>
        @endif
    </td>
    <td data-label="الصلاحيات">
        @foreach ($user->roles as $role)
            <label>{{$role->name}}</label>
        @endforeach
    </td>
    <td data-label="العمليات">
        <a class="btn btn-sm btn-secondary" href="{{ route('users.show',$user->id) }}">عرض</a>
        <a class="btn btn-sm btn-secondary" href="{{ route('users.edit',$user->id) }}">تعديل</a>
    </td>
    </tr>
    @endforeach
</table>

<div class="pagination justify-content-center" dir="ltr"">
    {{  $users->links() }}
</div>




@endsection
