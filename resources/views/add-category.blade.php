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
                        <h2>Create Category</h2>
                    </div>
                    <div class="col-2">
                        <a href="{{ url('/home') }}">
                            <button type="button" class="btn btn-primary float-end"> Back </button>
                        </a>
                    </div>
                </div>
                <form action="{{ route('create-category') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Category Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Category">
                    </div>
                    <div class="form-group">
                        <label>Status *</label>
                        <select class="form-control form-select" name="status">
                            <option value="1">Enabled</option>
                            <option value="2">Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Parent Category</label>
                        <select class="form-control form-select" name="parent_id">
                            <option value="">-- Select Category --</option>
                            @foreach ($all_parent_categories as $parent)
                                <option value="{{ $parent['category_id'] }}">
                                    {{ $parent['children_recursive_name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-4">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
