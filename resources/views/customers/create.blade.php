@extends('layouts.admin.app')
@section('content')
    <form action="{{route('customer.store')}}" method="post">
        @csrf

        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Name">
        </div>

        <div class="form-group">
            <label for="">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
        </div>

        <div class="form-group">
            <label for="">Phone Number</label>
            <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
        </div>

        <div class="form-group">
            <label for="">Address</label>
            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Address"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection