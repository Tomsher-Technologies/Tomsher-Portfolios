@extends('backend.layouts.app')

@section('content')



<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h5 class="h4">Manage Portfolios</h5>
		</div>
		<div class="col-md-6 text-md-right">
            <a href="{{ route('portfolios.create') }}" class="btn btn-success mb-3">Add Portfolio</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header row">
        <h5 class="col-md-12 mb-1 h6">Portfolios</h5>
        <div class="col-md-12 ">
            <form class="row" id="sort_brands" action="" method="GET">
                <div class="col-md-4 input-group mt-2">
                    <input type="text" class="form-control" id="search" name="search"@isset($search) value="{{ $search }}" @endisset placeholder="Type title or site url">
                </div>

                <div class="col-sm-4 mt-2">
                    <select class="form-control" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="1" @if ($status == '1') selected @endif>Active</option>
                        <option value="2" @if ($status == '0') selected @endif>Inactive</option>
                    </select>
                </div>

                <div class="col-sm-4 mt-2">
                    <select name="category" class="form-control aiz-selectpicker" data-live-search="true">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 mt-2">
                    <select name="industry" class="form-control aiz-selectpicker" data-live-search="true">
                        <option value="">Select Industry</option>
                        @foreach($industries as $industry)
                            <option value="{{ $industry->id }}" {{ request('industry') == $industry->id ? 'selected' : '' }}>
                                {{ $industry->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 mt-2">
                    <select name="technology" class="form-control aiz-selectpicker" data-live-search="true">
                        <option value="">Select Technology</option>
                        @foreach($technologies as $technology)
                            <option value="{{ $technology->id }}" {{ request('technology') == $technology->id ? 'selected' : '' }}>
                                {{ $technology->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mt-2">
                    <button class="btn btn-info " type="submit">Filter</button>
                    <a href="{{ route('portfolios.index') }}" class="btn btn-cancel">Reset</a>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th  class="text-center">#</th>
                    <th>Title</th>
                    <th>Site Link</th>
                    <th >Category</th>
                    <th >Industry</th>
                    <th >Technology</th>
                    <th class="text-center">Sort Order</th>
                    <th class="text-center">{{trans('messages.status')}}</th>
                    <th class="text-center">{{trans('messages.options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portfolios as $key => $portfolio)
                    <tr>
                        <td class="text-center">{{ ($key+1) + ($portfolios->currentPage() - 1)*$portfolios->perPage() }}</td>
                        <td>{{ $portfolio->name }}</td>
                        <td>{{ $portfolio->site_url }}</td>
                        <td class="text-start" style="">
                            <ul style="margin-left: -20px;">
                                {!! $portfolio->categories->map(fn($category) => "<li>{$category->name}</li>")->implode('') !!}
                            </ul>
                        </td>
                        <td>
                            <ul style="margin-left: -20px;">
                                {!! $portfolio->industries->map(fn($industry) => "<li>{$industry->name}</li>")->implode('') !!}
                            </ul>
                        </td>
                        <td>
                            <ul style="margin-left: -20px;">
                                {!! $portfolio->technologies->map(fn($technology) => "<li>{$technology->name}</li>")->implode('') !!}
                            </ul>
                        </td>
                        <td class="text-center">{{ $portfolio->sort_order }}</td>
                        <td class="text-center">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" onchange="update_status(this)" value="{{ $portfolio->id }}"
                                    <?php if ($portfolio->status == 1) {
                                        echo 'checked';
                                    } ?>>
                                <span></span>
                            </label>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-soft-success btn-sm btn-icon btn-circle" href="{{route('portfolios.edit', encrypt($portfolio->id))}}" title="{{ trans('messages.edit') }}">
                                <i class="las la-edit"></i>
                            </a>

                            <a href="#" class="btn btn-soft-danger btn-sm btn-icon btn-circle confirm-delete" data-href="{{route('portfolios.destroy', $portfolio->id)}}" title="{{ trans('messages.delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $portfolios->appends(request()->input())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

   
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
    
        function update_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('portfolios.status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Portfolio status updated successfully');
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