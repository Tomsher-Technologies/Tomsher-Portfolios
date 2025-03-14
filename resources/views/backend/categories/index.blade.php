@extends('backend.layouts.app')

@section('content')



<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h5 class="h4">Manage Categories</h5>
		</div>
		<div class="col-md-6 text-md-right">
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#categoryModal">Add Category</button>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">Categories</h5>
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
                    <a href="{{ route('categories.index') }}" class="btn btn-cancel">Reset</a>
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
                    <th class="text-center">{{trans('messages.status')}}</th>
                    <th class="text-center">{{trans('messages.options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <td class="text-center">{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                        <td>{{ $category->name }}</td>
                        <td class="text-center">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" onchange="update_status(this)" value="{{ $category->id }}"
                                    <?php if ($category->status == 1) {
                                        echo 'checked';
                                    } ?>>
                                <span></span>
                            </label>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-soft-success btn-sm btn-icon btn-circle editBtn" id="" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                <i class="las la-edit"></i>
                            </button>
                            <a href="#" class="btn btn-soft-danger btn-sm btn-icon btn-circle confirm-delete" data-href="{{route('categories.destroy', $category->id)}}" title="{{ trans('messages.delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $categories->appends(request()->input())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

    <!-- Add/Edit Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        @csrf
                        <input type="text" class="form-control" id="name" placeholder="Enter category name">
                        <input type="hidden" id="categoryId">
                        <span id="errorShow" class="mt-1" style="color: red;"></span><br>
                        <button type="submit" class="btn btn-primary mt-3" id="saveBtn">Save</button>
                        <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Cancel</button>
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
            // Open modal for adding new category
         
            $(document).on("click", ".editBtn", function() {
                let id = $(this).data("id");
                let name = $(this).data("name");
               
                $("#categoryId").val(id);
                $("#name").val(name);
                $("#modalTitle").text("Edit Category");
                $("#saveBtn").text("Update");
                $('#categoryModal').modal('show');
            });

            $(document).on("click", ".btn-success", function() {
                $("#categoryId").val('');
                $("#name").val('');
                $("#modalTitle").text("Add Category");
                $("#saveBtn").text("Save");
            });

            // Handle form submission
            $("#categoryForm").submit(function(e) {

                e.preventDefault();
                $('#errorShow').html('');

                let id = $("#categoryId").val();
                let url = id ? "/admin/categories/update/"+id : "{{ route('categories.store') }}";
                let method = id ? "POST" : "POST";
                let name = $("#name").val();

                if(name != null && name != ''){
                    $.ajax({
                        url: url,
                        type: method,
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: $("#name").val()
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr) {
                            $('#errorShow').html(xhr.responseJSON.errors.name[0]);
                        }
                    });
                }else{
                    $('#errorShow').html('The name field is required.');
                }
                
            });

        });
        function update_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('categories.status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Category status updated successfully');
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