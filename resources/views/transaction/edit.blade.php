@extends('layouts.main')
@section('title', 'Edit Subcription')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Edit Subcription
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
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.subcription') }}'">
                    <i class="bx bx-arrow-back"></i>
                </button>
            </div>
            <div class="card-body">
                <form class="mb-3" action="{{ route('owner.subcription.update', $subcription->id) }}"
                    method="POST" id="edit" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter subcription name"
                            autofocus value="{{ old('name', $subcription->name) }}" />
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" class="form-control" id="discount" name="discount"
                            placeholder="Enter subcription discount" autofocus
                            value="{{ old('discount', $subcription->discount) }}" />
                    </div>

                    <div class="mb-3">
                        <label for="minimum_order" class="form-label">Minimum Order</label>
                        <input type="number" class="form-control" id="minimum_order" name="minimum_order"
                            placeholder="Enter subcription minimum_order" autofocus
                            value="{{ old('minimum_order', $subcription->minimum_order) }}" />
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">price</label>
                        <input type="number" class="form-control" id="price" name="price"
                            placeholder="Enter subcription price" autofocus
                            value="{{ old('price', $subcription->price) }}" />
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-</option>
                            <option value="applecible" @selected(old('status', $subcription->status) == 'applecible')>Applecible</option>
                            <option value="not_applecible" @selected(old('status', $subcription->status) == 'not_applecible')>Not Applecible</option>
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
