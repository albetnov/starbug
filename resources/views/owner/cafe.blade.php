@extends('layouts.main')
@section('title', 'Manage Cafe')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Manage Cafe
                <br>
                <p class="text-muted">Last Updated: {{ $cafe->updated_at }}</p>
                @if ($errors->any())
                    <div class="alert mt-2 alert-danger">
                        <ul>
                            @foreach ($errors->all as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('owner.cafe') }}" method="POST" id="edit">
                    @csrf
                    <div class="mb-3">
                        <label for="cafe_name" class="form-label">Cafe Name</label>
                        <input type="text" class="form-control" name="cafe_name" id="cafe_name"
                            placeholder="Your cafe name..." value="{{ old('cafe_name', $cafe->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="cafe_address" class="form-label">Your Cafe Address</label>
                        <textarea type="text" class="form-control" name="cafe_address" id="cafe_address"
                            rows="5">{{ old('cafe_address', $cafe->address) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="disable_lp" @checked(old('disable_lp', $cafe->show_lp == 'true' ? false : true))
                                name="disable_lp" value="true" />
                            <label class="form-check-label" for="disable_lp" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Disable the landing page and redirect users directly to Login Page"> Disable Landing
                                Page
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit" form="edit">
                    <i class="bx bx-save"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
