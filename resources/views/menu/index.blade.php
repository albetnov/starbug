@extends('layouts.main')
@section('title', 'Manage Menus')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Menu Lists
                <br>
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.menu.create') }}'">
                    <i class="bx bx-plus"></i> Create Menu
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
                                    <option value="production">Production</option>
                                    <option value="discontinued">Discontinued</option>
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
                                <th>Description</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->description }}</td>
                                    <td>{{ $menu->status }}</td>
                                    <td>Rp. {{ $menu->price }}</td>
                                    <td>{{ $menu->category->name }}</td>
                                    <td>{{ $menu->created_at }}</td>
                                    <td>{{ $menu->updated_at }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#photoPreview{{ $menu->id }}"><i
                                                class="bx bx-photo-album"></i></button>
                                        <div id="photoPreview{{ $menu->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="my-modal-title">Photo Preview</h5>
                                                        <button class="btn btn-sm btn-primary" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('storage/menu/' . $menu->photo) }}"
                                                            alt="{{ $menu->name }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-info"
                                            onclick="location.href='{{ route('owner.menu.edit', $menu->id) }}'"><i
                                                class="bx bx-edit"></i>
                                        </button>
                                        <form action="{{ route('owner.menu.delete', $menu->id) }}" method="post"
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
