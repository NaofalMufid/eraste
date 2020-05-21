@extends('layouts.admin.app')
@section('content')
    <form action="{{route('product.update',['id' => $product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$product->name}}">
        </div>

        <div class="form-group">
            <label for="">Price</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="E-mail" value="{{$product->price}}">
        </div>

        <div class="form-group">
            <label for="">Recent Image</label>
            <img src="{{asset('/storage').'/'.$product->image}}" class="img-fluid" alt="Product Image" width="75">
        </div>

        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image" id="image">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection