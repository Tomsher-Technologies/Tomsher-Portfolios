@extends('backend.layouts.app', ['title' => 'Create Portfolio'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h5>Create Portfolio</h5>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ isset($portfolio) ? route('portfolios.update', $portfolio->id ?? 0) : route('portfolios.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Portfolio Title</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $portfolio->name ?? '') }}">
                            @error('name')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Short Description</label>
                            <input type="text" class="form-control" name="description" value="{{ old('description', $portfolio->description ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="site_url">Website URL</label>
                            <input type="url" class="form-control" name="site_url" value="{{ old('site_url', $portfolio->site_url ?? '') }}">
                            @error('site_url')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="site_url">Launch Date</label>
                            <input type="date" class="form-control" id="dateInput" name="launch_date" value="{{ old('launch_date', $portfolio->launch_date ?? '') }}">
                            @error('launch_date')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}">
                            @error('sort_order')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="1" {{ isset($portfolio) && $portfolio->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ isset($portfolio) && $portfolio->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Categories</label>
                            <select name="categories[]" class="form-control select2" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        @if(isset($portfolio) && $portfolio->categories->contains($category->id)) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label>Industries</label>
                            <select name="industries[]" class="form-control select2" multiple>
                                @foreach($industries as $industry)
                                    <option value="{{ $industry->id }}" 
                                        @if(isset($portfolio) && $portfolio->industries->contains($industry->id)) selected @endif>
                                        {{ $industry->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('industries')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label>Technologies</label>
                            <select name="technologies[]" class="form-control select2" multiple>
                                @foreach($technologies as $technology)
                                    <option value="{{ $technology->id }}" 
                                        @if(isset($portfolio) && $portfolio->technologies->contains($technology->id)) selected @endif>
                                        {{ $technology->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('technologies')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">{{ isset($portfolio) ? 'Update' : 'Create' }}</button>
                        <a href="{{ route('portfolios.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        window.onload = function () {
            $('.select2').select2({
                placeholder: "Select options",
                allowClear: true
            });
        };

        $(document).ready(function(){
            $('#dateInput').on('focus click', function () {
                this.showPicker();
            });
        });
    </script>
@endsection