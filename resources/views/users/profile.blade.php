@extends('layouts.app')
@section('title','حسابي')'
@section('content')

<div class="col-xl-12">
    @if (Auth::user()->hasChangedPassword==0)
        <div class="alert alert-danger" role="alert">
            الرجاء تغيير كلمة المرور لتتمكن من استخدام النظام
        </div>
    @endif
    <div class="card">
    <div class="card-body pt-3">
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered">

        <li class="nav-item">
            <button class="nav-link {{$errors->any()?'':'active'}}" data-bs-toggle="tab" data-bs-target="#profile-overview">حسابي</button>
        </li>

        @can('change-password')
        <li class="nav-item">
            <button class="nav-link {{$errors->any()?'active':''}}" data-bs-toggle="tab" data-bs-target="#profile-change-password">تغيير كلمة المرور</button>
        </li>
        @endcan

        </ul>
        <div class="tab-content pt-2">

        <div class=" tab-pane fade  {{$errors->any()?'':'show active'}} profile-overview" id="profile-overview">
        
            <h5 class="card-title">معلومات الحساب</h5>

            <div class="row">
            <div class="col-lg-3 col-md-4 label ">الاسم</div>
            <div class="col-lg-9 col-md-8">{{Auth::user()->name}}</div>
            </div>
            <hr>
            <div class="row">
            <div class="col-lg-3 col-md-4 label ">اليوزر</div>
            <div class="col-lg-9 col-md-8">{{Auth::user()->username}}</div>
            </div>
            <hr>
            <div class="row">
            <div class="col-lg-3 col-md-4 label ">رقم التلفون</div>
            <div class="col-lg-9 col-md-8">{{Auth::user()->phone}}</div>
            </div>
            <hr>
            <div class="row">
            <div class="col-lg-3 col-md-4 label ">العنوان</div>
            <div class="col-lg-9 col-md-8">{{Auth::user()->address}}</div>
            </div>
            <hr>
            <div class="row">
            <div class="col-lg-3 col-md-4 label ">الايميل</div>
            <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
            </div>
            

        </div>
        @can('change-password')
        <div class="tab-pane fade pt-3 {{$errors->any()?'show active':''}}" id="profile-change-password">
            <!-- Change Password Form -->
            <form method="POST" action="{{route('profile')}}">
                @csrf
                @method('PUT')
            <div class="row mb-3">
                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">كلمة المرور الحالية</label>
                <div class="col-md-8 col-lg-9">
                <input name="curentPassword" type="password" class="form-control" id="currentPassword">
                <span class="text-danger">@error('curentPassword'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">كلمة المرور الجديدة</label>
                <div class="col-md-8 col-lg-9">
                <input name="newPassword" type="password" class="form-control" id="newPassword">
                <span class="text-danger">@error('newPassword'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="cnewPassword" class="col-md-4 col-lg-3 col-form-label">تأكيد كلمة المرور الجديدة</label>
                <div class="col-md-8 col-lg-9">
                <input name="cnewPassword" type="password" class="form-control" id="cnewPassword">
                <span class="text-danger">@error('cnewPassword'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
            </form><!-- End Change Password Form -->

        </div>
        @endcan
        </div><!-- End Bordered Tabs -->

    </div>
    </div>

</div>

@endsection