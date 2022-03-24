@extends('layouts.main')
@section('title', 'Create Menu')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Create Menu
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
                @if (Auth::user()->role == 'owner')
                    <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.menu') }}'">
                        <i class="bx bx-arrow-back"></i>
                    </button>
                @else
                    <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('cashier.menu') }}'">
                        <i class="bx bx-arrow-back"></i>
                    </button>
                @endif
            </div>
            <div class="card-body">
                @if (Auth::user()->role == 'owner')
                    <form class="mb-3" action="{{ route('owner.menu.store') }}" method="POST" id="create"
                        enctype="multipart/form-data">
                    @else
                        <form class="mb-3" action="{{ route('cashier.menu.store') }}" method="POST" id="create"
                            enctype="multipart/form-data">
                @endif
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter menu name" autofocus
                        value="{{ old('name') }}" />
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter menu description"
                        rows="5">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">-</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category') == $category->id)>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter menu price"
                        autofocus value="{{ old('price') }}" />
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">-</option>
                        <option value="production" @selected(old('status') == 'production')>Production</option>
                        <option value="discontinued" @selected(old('status') == 'discontinued')>Discontinued</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit" form="create">
                    <i class="bx bx-paper-plane"></i> Create
                </button>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
