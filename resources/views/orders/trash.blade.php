@extends('layouts.admin.app')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h3 >Order Trash Data</h3>
    <br />
    <div>
    <a href="{{route('order.index')}}" class="btn btn-success">Back</a>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="order_data">
            <thead>
            <tr>
                <th>Order Code</th>
                <th>Product</th>
                <th>Total Order</th>
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
            var table = $('#order_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('order.trash') }}",
            columns: [
                {data: 'order_code', name: 'order_code'},
                { data: 'product.name',
                    render: function(data) {
                            return data        
                    }
                },
                {data: 'subtotal', name: 'subtotal'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            });
        });

        // restore data
        $('body').on('click', '.restoreOrder', function () {
            var order_id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "restore/"+order_id,
                success: function (data) {
                    var table = $('#order_data').DataTable();
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        // delete permanent data
        $('body').on('click', '.deletePermanentOrder', function () {
        var order_id = $(this).data("id");
        confirm("Are You sure want to delete permanently !");
            $.ajax({
                type: "DELETE",
                url: "delete-permanent"+'/'+order_id,
                success: function (data) {
                    var table = $('#order_data').DataTable();
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection