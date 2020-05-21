@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card-deck mb-3 text-center">
        @foreach ($products as $item)
        <div class="col-md-3">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="{{asset('storage').'/'.$item->image}}" alt="Card image cap" width="150">
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p class="card-text"><strong>Rp. {{$item->price}}</strong></p>
                    <a href="{{route('cart', ['id' => $item->id])}}" class="btn btn-primary btn-block"> Buy </a>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
@endsection