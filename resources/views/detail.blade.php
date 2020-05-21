@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Success</h3>
        </div>
        @php
            $data = json_decode($order,true);
        @endphp
        <ul class="list-group">
            <li class="list-group-item">Order No : {{$order->order_code}}</li>
            <li class="list-group-item">Produk Name : {{$data['product']['name']}}</li>
            <li class="list-group-item">Qty : {{$order->qty}}</li>
            <li class="list-group-item">Total : {{$order->subtotal}}</li>
        </ul>
    </div>
@endsection