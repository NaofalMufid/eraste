@extends('layouts.admin.app')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h3 >Product Data</h3>
    <br />
    <div>
        <a class="btn btn-success" href="javascript:void(0)" id="NewProduct"> New Product</a>
        <a href="{{route('product.trash')}}" class="btn btn-warning">Product Trash</a>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="product_data">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script> 
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // show data
            imgSrc = "{{asset('/')}}"+'storage/';
            var table = $('#product_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                { data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                        return "<img src=\""+ imgSrc + data + "\" height=\"50\"/>";
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            });
        });    

        // show form new data
        $('#NewProduct').click(function () {
            window.location = "{{route('product.create')}}";
        });

        // save data
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
            data: $('#productForm').serialize(),
            url: "{{ route('product.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#productForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                var table = $('#product_data').DataTable();
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
            });
        });

        // show form edit
        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            window.location = "{{route('product.store')}}"+'/'+product_id+'/edit';
        });

        // delete data
        $('body').on('click', '.deleteProduct', function () {
        var product_id = $(this).data("id");
        confirm("Are You sure want to delete !");
            $.ajax({
                type: "DELETE",
                url: "{{ route('product.store') }}"+'/'+product_id,
                success: function (data) {
                    var table = $('#product_data').DataTable();
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection