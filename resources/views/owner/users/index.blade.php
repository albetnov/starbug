@extends('layouts.main')
@section('title', 'Manage Users')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Users List
                <br>
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.users.create') }}'">
                    <i class="bx bx-plus"></i> Create User
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Profile Picture</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td><img src="{{ asset('storage/propic/' . $user->propic) }}"
                                            style="max-width: 70px; max-height:70px;"></td>
                                    <td class="text-center">
                                        <button class="btn btn-info"
                                            onclick="location.href='{{ route('owner.users.edit', $user->id) }}'"><i
                                                class="bx bx-edit"></i>
                                        </button>
                                        <form action="{{ route('owner.users.delete', $user->id) }}" method="post"
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
        $("#table").DataTable();
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatable/datatables.min.css') }}">
@endpush
