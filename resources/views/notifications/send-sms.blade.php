@extends('layouts.layout')
@section('title','send sms')
@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
        @if(session('failed'))
                <div class="alert alert-danger">
                    {{session('failed')}}
                </div>
            @endif
        <h3>{{__('notification.send-sms')}}</h3>
        <form action="{{route('notification.send.sms')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">@lang('notification.users')</label>
                <select  name="user"  class="form-select" aria-label="Default select example">
                    @foreach($users as $user)
                    <option {{old('user')==$user->id?'selected':''}} value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">@lang('notification.sms_text')</label>
                <textarea class="form-control" name="text" rows="3">{{old('text')}}</textarea>
            </div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="text-danger">{{$error}}</div>
                @endforeach
            @endif
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection