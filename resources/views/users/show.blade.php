@extends('layouts.app')
@section('title','عرض المستخدم')



@section('content')
<div class="d-flex justify-content-between">
    <h2>بيانات المستخدم</h2>
    <a class="btn" href="{{ URL::previous() }}"> رجوع</a>
</div>
<div class="row mt-2">
    <div class="col-lg-6">
            <strong>الرقم:</strong>
            {{ $user->id }}
    </div>
    <div class="col-lg-6">
            <strong>اليوزر:</strong>
            {{ $user->username }}
    </div>
    <hr>
    <div class="col-lg-6">
            <strong>الاسم:</strong>
            {{ $user->name }}
    </div>
    <div class="col-lg-6">
            <strong>العنوان:</strong>
            {{ $user->address }}
    </div>
    <hr>
    <div class="col-lg-6">
            <strong>الهاتف:</strong>
            {{ $user->phone }}
    </div>
    <div class="col-lg-6">
            <strong>البريد:</strong>
            {{ $user->email  }}
    </div>
    <hr>
    <div class="col-lg-6">
            <strong>هل مفعل؟:</strong>
            @if ($user->is_enabled==0)
                {{"لا"}}
            @else
                {{"نعم"}}
            @endif
    </div>
    <div class="col-lg-6">
            <strong>هل غير كلمة السر:</strong>
            @if ($user->hasChangedPassword==0)
                {{"لا"}}
            @else
                {{"نعم"}}
            @endif
    </div>
    <hr>
    <div class="col-lg-6">
            <strong>وقت الانشاء:</strong>
            {{ $user->created_at }}
    </div>
    <div class="col-lg-6">
            <strong>وقت التحديث:</strong>
            {{ $user->updated_at }}
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6">
                    <strong>الادوار:</strong>
                    @foreach ($user->roles as $role)
                    <br><label>{{ $role->name }}</label>
                    @endforeach
        </div>
        <div class="col-lg-6">
                    <strong>الصلاحيات:</strong>
                    @foreach ($user->permissions as $permission)
                    <br><label>{{ $permission->description }}</label>
                    @endforeach
        </div>
    </div>
</div>
@endsection