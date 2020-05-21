@extends('layouts.admin.app')
@section('content')
    <form action="{{route('user.update',['id' => $user->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$user->name}}">
        </div>

        <div class="form-group">
            <label for="">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="{{$user->email}}">
        </div>

        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{$user->password}}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection