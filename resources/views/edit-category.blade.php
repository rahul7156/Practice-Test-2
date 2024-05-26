@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-10 text-center">
                        <h2>Update Category</h2>
                    </div>
                    <div class="col-2">
                        <a href="{{ url('/home') }}">
                            <button type="button" class="btn btn-primary float-end"> Back </button>
                        </a>
                    </div>
                </div>
                <form action="{{ route('update-category') }}" method="post">
                    <input type="hidden" name="category_id" value="{{ $edit_category['category_id'] }}">
                    @csrf
                    <div class="form-group">
                        <label>Category Name *</label>
                        <input type="text" name="name" value="{{ $edit_category['name'] }}" class="form-control"
                            placeholder="Enter Category">
                    </div>
                    <div class="form-group">
                        <label>Status *</label>
                        <select class="form-control form-select" name="status">
                            <option value="1" {{ $edit_category['status'] == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="2" {{ $edit_category['status'] == 2 ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Parent Category</label>
                        <select class="form-control form-select" name="parent_id">
                            <option value="">-- Select Category --</option>
                            @foreach ($all_parent_categories as $parent)
                                <option value="{{ $parent['category_id'] }}"
                                    {{ $edit_category['parent_id'] == $parent['category_id'] ? 'selected' : '' }}>
                                    {{ $parent['children_recursive_name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-4">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
