@extends('backend.layouts.app')

@section('content')



<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h5 class="h4">Manage Users</h5>
		</div>
		<div class="col-md-6 text-md-right">
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#userModal">Add User</button>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">Users</h5>
        <div class="col-md-10">
            <form class="row" id="sort_brands" action="" method="GET">
                <div class="col-md-4 input-group">
                    <input type="text" class="form-control" id="search" name="search"@isset($search) value="{{ $search }}" @endisset placeholder="{{ trans('messages.type_name_enter') }}">
                </div>

                <div class="col-sm-4">
                    <select class="form-control" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="1" @if ($status == '1') selected @endif>Active</option>
                        <option value="2" @if ($status == '0') selected @endif>Inactive</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-info " type="submit">Filter</button>
                    <a href="{{ route('users.index') }}" class="btn btn-cancel">Reset</a>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered aiz-table mb-0">
            <thead>
                <tr>
                    <th  class="text-center">#</th>
                    <th>{{trans('messages.name')}}</th>
                    <th>{{trans('messages.email')}}</th>
                    <th class="text-center">{{trans('messages.status')}}</th>
                    <th class="text-center">{{trans('messages.options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td class="text-center">{{ ($key+1) + ($users->currentPage() - 1)*$users->perPage() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" onchange="update_status(this)" value="{{ $user->id }}"
                                    <?php if ($user->status == 1) {
                                        echo 'checked';
                                    } ?>>
                                <span></span>
                            </label>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-soft-success btn-sm btn-icon btn-circle editBtn" id="" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}">
                                <i class="las la-edit"></i>
                            </button>

                            <a href="#" class="btn btn-soft-danger btn-sm btn-icon btn-circle confirm-delete" data-href="{{route('users.destroy', $user->id)}}" title="{{ trans('messages.delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $users->appends(request()->input())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

    <!-- Add/Edit User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        @csrf
                        <label class=" mt-3">User Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter user name" >
                        <label class=" mt-3">User Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Enter user email" >
                        <input type="hidden" id="userId">
                        <span id="errorShow" class="mt-1" style="color: red;"></span><br>
                        <button type="submit" class="btn btn-primary mt-2" id="saveBtn">Save</button>
                        <button type="button" class="btn btn-secondary mt-2" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
       
       $(document).ready(function() {
            // Open modal for adding new user
         
            $(document).on("click", ".editBtn", function() {
                let id = $(this).data("id");
                let name = $(this).data("name");
                let email = $(this).data("email");
               
                $("#userId").val(id);
                $("#name").val(name);
                $("#email").val(email);
                $("#modalTitle").text("Edit User");
                $("#saveBtn").text("Update");
                $('#userModal').modal('show');
            });

            $(document).on("click", ".btn-success", function() {
                $("#userId").val('');
                $("#name").val('');
                $("#email").val('');
                $("#modalTitle").text("Add User");
                $("#saveBtn").text("Save");
            });

            // Handle form submission
            $("#userForm").submit(function(e) {
                e.preventDefault();
                $('#errorShow').html('');

                let id = $("#userId").val();
                let url = id ? "/admin/users/update/"+id : "{{ route('users.store') }}";
                let method = id ? "POST" : "POST";
                let name = $("#name").val();
                let email = $("#email").val();

                if(name != null && name != '' && email != null && email != ''){
                    $.ajax({
                        url: url,
                        type: method,
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: $("#name").val(),
                            email: $("#email").val()
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            if (errors.name) {
                                errorMessage += errors.name[0] + "<br>";
                            }
                            if (errors.email) {
                                errorMessage += errors.email[0];
                            }

                            $('#errorShow').html(errorMessage);
                        }
                    });
                }else{
                    $('#errorShow').html('Please fill all the fields.');
                }
            });

        });
        function update_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('users.status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'User status updated successfully');
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);

                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            });
        }
    </script>
@endsection