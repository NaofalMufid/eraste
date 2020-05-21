@extends('layouts.admin.app')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h3 >User Data</h3>
    <br />
    <div>
        <a class="btn btn-success" href="javascript:void(0)" id="NewUser"> New User</a>
        <a href="{{route('user.trash')}}" class="btn btn-warning">User Trash</a>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="user_data">
            <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
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
                    <form id="userForm" name="userForm" class="form-horizontal">    
                       <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group">    
                            <label for="name" class="col-sm-2 control-label">Name</label>    
                            <div class="col-sm-12">    
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>    
                        </div>

                        <div class="form-group">    
                            <label for="name" class="col-sm-2 control-label">Email</label>    
                            <div class="col-sm-12">    
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>    
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label">{{ __('Password') }}</label>
                            <div class="col-sm-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-sm-6 control-label">{{ __('Confirm Password') }}</label>
                            <div class="col-sm-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
            var table = $('#user_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            });
        });    

        // show form new data
        $('#NewUser').click(function () {
            $('#saveBtn').val("create-user");
            $('#user_id').val('');
            $('#userForm').trigger("reset");
            $('#modelHeading').html("Create New User");
            $('#ajaxModel').modal('show');
        });

        // save data
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
            data: $('#userForm').serialize(),
            url: "{{ route('user.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#userForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                var table = $('#user_data').DataTable();
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
            });
        });

        // show form edit
        $('body').on('click', '.editUser', function () {
            var user_id = $(this).data('id');
            window.location = "{{route('user.store')}}"+'/'+user_id+'/edit';
        });

        // delete data
        $('body').on('click', '.deleteUser', function () {
        var user_id = $(this).data("id");
        confirm("Are You sure want to delete !");
            $.ajax({
                type: "DELETE",
                url: "{{ route('user.store') }}"+'/'+user_id,
                success: function (data) {
                    var table = $('#user_data').DataTable();
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection