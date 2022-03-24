@extends('layouts.main')
@section('title', 'Manage Subcriptions')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Subcriptions List
                <br>
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.subcription.create') }}'">
                    <i class="bx bx-plus"></i> Create Subcriptions
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
                                    <option value="applecible">Applecible</option>
                                    <option value="not_applecible">Not Applecible</option>
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
                                <th>Discount</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcriptions as $subcription)
                                <tr>
                                    <td>{{ $subcription->name }}</td>
                                    <td>{{ $subcription->discount }}</td>
                                    <td>{{ $subcription->price }}</td>
                                    <td>
                                        @if ($subcription->status == 'applecible')
                                            <span
                                                class="badge bg-label-success me-1">{{ str_replace('_', ' ', $subcription->status) }}</span>
                                        @else
                                            <span
                                                class="badge bg-label-danger me-1">{{ str_replace('_', ' ', $subcription->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $subcription->created_at }}</td>
                                    <td>{{ $subcription->updated_at }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info"
                                            onclick="location.href='{{ route('owner.subcription.edit', $subcription->id) }}'"><i
                                                class="bx bx-edit"></i>
                                        </button>
                                        <form action="{{ route('owner.subcription.delete', $subcription->id) }}"
                                            method="post" style="display: inline">
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
