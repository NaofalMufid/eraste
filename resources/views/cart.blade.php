@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Order Information</h3>
            <ul class="list-group">
                <li class="list-group-item">{{$product->name}}</li>
                <li class="list-group-item price">Rp. <strong id="price">{{$product->price}}</strong></li>
                <li class="list-group-item">Qty 1 pcs</li>
            </ul>
                    
        </div>
        <div class="col-md-6">            
            <h3>Customer Informatin</h3>
            <form action="{{route('buy')}}" method="post">
                @csrf
                <input type="hidden" name="pid" value="{{$product->id}}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="price" value="{{$product->price}}">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
        
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
                </div>
        
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea class="form-control" name="address" id="address" rows="3" placeholder="Address"></textarea>
                </div>
        
                <button type="submit" class="btn btn-primary">Order</button>
            </form>
        </div>    
    </div>
@endsection