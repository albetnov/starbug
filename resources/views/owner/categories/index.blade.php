@extends('layouts.main')
@section('title', 'Manage Categories')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Categories List
                <br>
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.category.create') }}'">
                    <i class="bx bx-plus"></i> Create Category
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info"
                                            onclick="location.href='{{ route('owner.category.edit', $category->id) }}'"><i
                                                class="bx bx-edit"></i>
                                        </button>
                                        <form action="{{ route('owner.category.delete', $category->id) }}" method="post"
                                            style="display: inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor/datatable/datatables.min.js') }}"></script>
    <script>
        $("#table").DataTable({
            "aaSorting": []
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatable/datatables.min.css') }}">
@endpush
