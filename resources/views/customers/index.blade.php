@extends('layouts.main')
@section('title', 'Manage Customers')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Customers List
                <br>
                @if (Auth::user()->role == 'owner')
                    <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.customers.create') }}'">
                        <i class="bx bx-plus"></i> Create Customers
                    </button>
                @else
                    <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('cashier.customers.create') }}'">
                        <i class="bx bx-plus"></i> Create Customers
                    </button>
                @endif
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
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
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
                                <th>Subcriptions</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>
                                        @if ($customer->subcription->status == 'not_applecible')
                                            <span class="badge bg-label-warning me-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Subcription is not longer supported. Consider edit this customer.">{{ $customer->subcription->name }}</span>
                                        @else
                                            {{ $customer->subcription->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($customer->status == 'active')
                                            <span class="badge bg-label-success me-1">{{ $customer->status }}</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">{{ $customer->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $customer->created_at }}</td>
                                    <td>{{ $customer->updated_at }}</td>
                                    <td class="text-center">
                                        @if (Auth::user()->role == 'owner')
                                            <button class="btn btn-info"
                                                onclick="location.href='{{ route('owner.customers.edit', $customer->id) }}'"><i
                                                    class="bx bx-edit"></i>
                                            </button>
                                            <form action="{{ route('owner.customers.delete', $customer->id) }}"
                                                method="post" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bx bx-trash"></i></button>
                                            </form>
                                        @else
                                            <button class="btn btn-info"
                                                onclick="location.href='{{ route('cashier.customers.edit', $customer->id) }}'"><i
                                                    class="bx bx-edit"></i>
                                            </button>
                                            <form action="{{ route('cashier.customers.delete', $customer->id) }}"
                                                method="post" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bx bx-trash"></i></button>
                                            </form>
                                        @endif
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
