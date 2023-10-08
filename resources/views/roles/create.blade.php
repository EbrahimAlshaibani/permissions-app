@extends('layouts.app')
@section('title','إضافة دور')


@section('content')
<div class="d-flex justify-content-between">
    <h2>إضافة دور جديدة</h2>
    <a class="btn" href="{{ URL::previous() }}"> رجوع</a>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<form action="{{route('roles.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row mt-4">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="name">الاسم</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="الاسم">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الدور:</strong>
                <br/>
                @foreach($permission as $value)
                <input type="checkbox" name="permission[]" id="{{$value->name}}" value="{{$value->id}}" class="form-check-input">
                <label for="{{$value->name}}"> {{ $value->description }} </label>
                <br>
                
                    {{-- <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                    {{ $value->description }}</label>
                <br/> --}}
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">إضافة</button>
        </div>
    </div>
</form>


@endsection