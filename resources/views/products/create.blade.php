@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form class="col-md-4" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">    
                <label for="name" class="col-sm-2 control-label">Name</label>    
                <div class="col-sm-12">    
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="100" required="">    
                </div>    
            </div>

            <div class="form-group">    
                <label for="name" class="col-sm-2 control-label">Price</label>    
                <div class="col-sm-12">    
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" value="" maxlength="100" required="">    
                </div>    
            </div>

            <div class="form-group">    
                <label for="name" class="col-sm-4 control-label">Image</label>    
                <div class="col-sm-12">    
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>    
            </div>

            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
            </div>
        </form>       
    </div>
</div>
@endsection