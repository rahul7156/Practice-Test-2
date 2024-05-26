@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-10 text-center">
                        <h2>Manage Categories</h2>
                    </div>
                    <div class="col-2">
                        <a href="{{ url('/add-category') }}">
                            <button type="button" class="btn btn-primary float-end mb-2">
                                Create Category
                            </button>
                        </a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Category ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Parent Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{ $category['category_id'] }}</td>
                                <td>
                                    {{ $category['children_recursive_name'] }}
                                </td>
                                <td>{{ $category['status'] == 1 ? 'Enabled' : 'Disabled' }}</td>
                                <td>{{ $category['parent_id'] }}</td>
                                <td>
                                    <a href="{{ url('/edit-category') . '/' . $category['category_id'] }}"
                                        class="btn btn-primary btn-sm"> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($categories) < 1)
                            <tr>
                                <td colspan="5">
                                    <center>No Records Found</center>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
