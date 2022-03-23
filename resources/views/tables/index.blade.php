@extends('layouts.main')
@section('title', 'Manage Tables')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Table List
                <br>
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.tables.create') }}'">
                    <i class="bx bx-plus"></i> Create Table
                </button>
                <button class="mt-1 btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filter"
                    aria-expanded="false" aria-controls="filter">
                    Filter
                </button>
                <div class="collapse" id="filter">
                    <div class="card card-body">
                        <form method="get">
                            <div class="mb-2">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">-</option>
                                    <option value="useable">Useable</option>
                                    <option value="broken">Broken</option>
                                </select>
                            </div>
                            <button class="btn btn-primary"><i class="bx bx-filter"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Seat</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tables as $table)
                                <tr>
                                    <td>{{ $table->name }}</td>
                                    <td>{{ $table->seat }}</td>
                                    <td>
                                        @if ($table->status == 'useable')
                                            <span class="badge bg-label-success me-1">{{ $table->status }}</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">{{ $table->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $table->created_at }}</td>
                                    <td>{{ $table->updated_at }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info"
                                            onclick="location.href='{{ route('owner.tables.edit', $table->id) }}'"><i
                                                class="bx bx-edit"></i>
                                        </button>
                                        <form action="{{ route('owner.tables.delete', $table->id) }}" method="post"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
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
