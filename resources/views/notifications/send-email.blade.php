@extends('layouts.layout')
@section('title','send email')
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
        <h3>{{__('notification.send-email')}}</h3>
        <form action="{{route('notification.send.email')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">Email address</label>
                <select name="user"  class="form-select" aria-label="Default select example">
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="email_type" class="form-label">Password</label>
                <select name="email_type" class="form-select" aria-label="Default select example">
                    @foreach($emailTypes as $key=>$val)
                        <option value="{{$key}}">{{$val}}</option>
                    @endforeach
                </select>
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