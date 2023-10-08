@extends('layouts.app')
@section('title','إضافة صلاحيات')


@section('content')
<div class="d-flex justify-content-between">
    <h2>إضافة صلاحيات جديدة</h2>
    <a class="btn" href="{{ URL::previous() }}"> رجوع</a>
</div>

<form class="row g-3" method="POST" action="{{route('permissions.store')}}" onsubmit="return confirm('هل انت متأكد');">
    @csrf
    <div class="col-md-4">
        <label for="name" class="form-label">الاسم </label>
        <input type="text" class="form-control" id="name" name="name" placeholder="الاسم " value="{{ old('name') }}">
        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
    </div>
    <div class="col-md-4">
        <label for="description" class="form-label">الوصف للمستخدم </label>
        <input type="text" class="form-control" id="description" name="description" placeholder="الوصف للمستخدم " value="{{ old('description') }}">
        <span class="text-danger">@error('description'){{ $message }}@enderror</span>
    </div>

    <div class="col-md-4">
        <label for="submit" class="form-label">اضافة </label>
        <button type="submit" id="submit" class="btn btn-primary mb-4 d-block w-100">اضافة</button>
    </div>

    </form>
    <table class="table table-bordered table-hover mt-4 text-center">
        <tr>
           <th>الرقم</th>
           <th>الاسم</th>
           <th>الوصف</th>
           <th width="280px">العمليات</th>
        </tr>
          @foreach ($permissions as $permission)
          <tr>
              <td data-label="الرقم">{{ $permission->id}}</td>
              <td data-label="الاسم">{{ $permission->name }}</td>
              <td data-label="الوصف">{{ $permission->description }}</td>
              <td data-label="العمليات">
                  @can('permission-edit')
                      <a class="btn btn-sm btn-secondary" href="{{ route('permissions.edit',$permission->id) }}">تعديل</a>
                  @endcan
                  @can('permission-delete')
                  <form method="POST" action="{{ route('permissions.destroy',$permission) }}" onsubmit=" return confirm('Are you sure!?') " class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                  </form>
                  @endcan
              </td>
          </tr>
          @endforeach
      </table>
      

@endsection