@extends('layouts.main')
@section('title', 'Create Tables')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Create Tables
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
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.tables') }}'">
                    <i class="bx bx-arrow-back"></i>
                </button>
            </div>
            <div class="card-body">
                <form class="mb-3" action="{{ route('owner.tables.store') }}" method="POST" id="create"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter table name"
                            autofocus value="{{ old('name') }}" />
                    </div>

                    <div class="mb-3">
                        <label for="seat" class="form-label">Seat</label>
                        <input type="number" class="form-control" id="seat" name="seat" placeholder="Enter table seat"
                            autofocus value="{{ old('seat') }}" />
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-</option>
                            <option value="useable" @selected(old('status') == 'useable')>Useable</option>
                            <option value="broken" @selected(old('status') == 'broken')>Broken</option>
                        </select>
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
