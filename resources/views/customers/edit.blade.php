@extends('layouts.main')
@section('title', 'Edit Customer')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Edit Customer
                <br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.customers') }}'">
                    <i class="bx bx-arrow-back"></i>
                </button>
            </div>
            <div class="card-body">
                <form class="mb-3" action="{{ route('owner.customers.update', $customer->id) }}" method="POST"
                    id="edit" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter subcription name"
                            autofocus value="{{ old('name', $customer->name) }}" />
                    </div>

                    <div class="mb-3">
                        <label for="id_subcription" class="form-label">Subcription</label>
                        <select name="id_subcription" id="id_subcription" class="form-select">
                            @foreach ($subcriptions as $subcription)
                                <option value="{{ $subcription->id }}" @selected(old('id_subcription', $customer->subcription->id) == $subcription->id)>
                                    {{ $subcription->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-</option>
                            <option value="active" @selected(old('status', $customer->status) == 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $customer->status) == 'inactive')>Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit" form="edit">
                    <i class="bx bx-paper-plane"></i> Edit
                </button>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
