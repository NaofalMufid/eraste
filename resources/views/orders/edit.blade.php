@extends('layouts.admin.app')
@section('content')
    <form action="{{route('order.update',['id' => $order->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
          <label for="">Product</label>
          <select name="product" class="form-control">
            <option value="" disabled selected>Choose Product</option>
            @foreach ($products as $product)
                <option value="{{$product->id}}" {{$product->id == $order->product_id ? "selected" : ""}}>{{$product->name}}</option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
            <label for="">Qty</label>
            <input type="number" name="qty" id="qty" class="form-control" placeholder="E-mail" value="{{$order->qty}}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection