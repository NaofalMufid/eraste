@extends('layouts.admin.app')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h3 >Customer Data</h3>
    <br />
    <div>
        <a class="btn btn-success" href="javascript:void(0)" id="NewCustomer"> New Customer</a>
        <a href="{{route('customer.trash')}}" class="btn btn-warning">Customer Trash</a>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="customer_data">
            <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    {{-- Form Modal --}}
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">  
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>    
                <div class="modal-body">    
                    <form id="customerForm" name="customerForm" class="form-horizontal">    
                       <input type="hidden" name="customer_id" id="customer_id">
                        <div class="form-group">    
                            <label for="name" class="col-sm-2 control-label">Name</label>    
                            <div class="col-sm-12">    
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="100" required="">    
                            </div>    
                        </div>

                        <div class="form-group">    
                            <label for="name" class="col-sm-2 control-label">Email</label>    
                            <div class="col-sm-12">    
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="100" required="">    
                            </div>    
                        </div>

                        <div class="form-group">    
                            <label for="name" class="col-sm-4 control-label">Phone Number</label>    
                            <div class="col-sm-12">    
                                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" value="" required="">    
                            </div>    
                        </div>
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label> 
                            <div class="col-sm-12">    
                                <textarea id="address" name="address" required="" placeholder="Enter Address" class="form-control"></textarea>   
                            </div>    
                        </div>   
    
                        <div class="col-sm-offset-2 col-sm-10">
                         <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
            var table = $('#customer_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            });
        });    

        // show form new data
        $('#NewCustomer').click(function () {
            $('#saveBtn').val("create-customer");
            $('#customer_id').val('');
            $('#customerForm').trigger("reset");
            $('#modelHeading').html("Create New Customer");
            $('#ajaxModel').modal('show');
        });

        // save data
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
            data: $('#customerForm').serialize(),
            url: "{{ route('customer.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#customerForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                var table = $('#customer_data').DataTable();
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
            });
        });

        // show form edit
        $('body').on('click', '.editCustomer', function () {
            var customer_id = $(this).data('id');
            window.location = "{{route('customer.store')}}"+'/'+customer_id+'/edit';
        });

        // delete data
        $('body').on('click', '.deleteCustomer', function () {
        var customer_id = $(this).data("id");
        confirm("Are You sure want to delete !");
            $.ajax({
                type: "DELETE",
                url: "{{ route('customer.store') }}"+'/'+customer_id,
                success: function (data) {
                    var table = $('#customer_data').DataTable();
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection