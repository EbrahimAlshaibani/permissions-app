@extends('layouts.app')
@section('title','إدارة الادوار')


@section('content')
    <h2>إدارة الادوار</h2>
@can('role-create')
    <a class="btn btn-sm btn-success" href="{{ route('roles.create') }}"> إضافة دور جديد</a>
@endcan
@can('role-create')
    <a class="btn btn-sm btn-success" href="{{ route('permissions.create') }}"> إضافة صلاحية</a>
@endcan
<table class="table table-bordered table-hover mt-4 text-center">
  <tr>
     <th>الرقم</th>
     <th>الاسم</th>
     <th width="280px">العمليات</th>
  </tr>
    @foreach ($roles as $role)
    <tr>
        <td data-label="الرقم">{{ $role->id}}</td>
        <td data-label="الاسم">{{ $role->name }}</td>
        <td data-label="العمليات">
            <a class="btn btn-sm btn-secondary" href="{{ route('roles.show',$role->id) }}">عرض</a>
            @can('role-edit')
                <a class="btn btn-sm btn-secondary" href="{{ route('roles.edit',$role->id) }}">تعديل</a>
            @endcan
            @can('role-delete')
            <form method="POST" action="{{ route('roles.destroy',$role) }}" onsubmit=" return confirm('Are you sure!?') " class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">حذف</button>
            </form>
            @endcan
        </td>
    </tr>
    @endforeach
</table>


<div class="pagination justify-content-center" dir="ltr"">
    {{  $roles->links() }}
</div>


@endsection