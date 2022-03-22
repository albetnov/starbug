@extends('layouts.main')
@section('title', 'Edit Users')
@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Edit User
                <br>
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.users') }}'">
                    <i class="bx bx-arrow-back"></i>
                </button>
            </div>
            <div class="card-body">
                <form class="mb-3" action="{{ route('owner.users.edit', $user->id) }}" method="POST" id="edit">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" placeholder="Enter your username" autofocus
                            value="{{ old('username', $user->username) }}" />
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            placeholder="Enter your name" value="{{ old('name', $user->name) }}" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-warning">Leave empty if you don't want to change the password.</div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="conpass">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="conpass" class="form-control @error('conpass') is-invalid @enderror"
                                name="conpass"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="conpass" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            @error('conpass')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                            <option value="">-</option>
                            <option value="owner" @selected(old('role', $user->role) == 'owner')>Owner</option>
                            <option value="cashier" @selected(old('role', $user->role) == 'cashier')>Cashier</option>
                            <option value="disabled" @selected(old('role', $user->role) == 'disabled')>Disabled</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedbac">{{ $message }}</div>
                        @enderror
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
