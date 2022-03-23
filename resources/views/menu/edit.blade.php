@extends('layouts.main')
@section('title', 'Edit Menu')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Edit Menu
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
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.menu') }}'">
                    <i class="bx bx-arrow-back"></i>
                </button>
            </div>
            <div class="card-body">
                <form class="mb-3" action="{{ route('owner.menu.update', $menu->id) }}" method="POST" id="update"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter menu name"
                            autofocus value="{{ old('name', $menu->name) }}" />
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter menu description"
                            rows="5">{{ old('description', $menu->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-select">
                            <option value="">-</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category', $menu->category->id) == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter menu price"
                            autofocus value="{{ old('price', $menu->price) }}" />
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-</option>
                            <option value="production" @selected(old('status', $menu->status) == 'production')>Production</option>
                            <option value="discontinued" @selected(old('status', $menu->status) == 'discontinued')>Discontinued</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <p>Current:</p>
                        <img src="{{ asset('storage/menu/' . $menu->photo) }}" alt="{{ $menu->name }}"
                            style="max-width: 150px;max-height:150px">
                        <input type="file" name="photo" class="form-control">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit" form="update">
                    <i class="bx bx-paper-plane"></i> Edit
                </button>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
