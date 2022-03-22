@extends('layouts.main')
@section('title', 'Manage Profile')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <form id="formAccountSettings" method="POST" action="{{ route('profile') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset('storage/propic/' . Auth::user()->propic) }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input"
                                            accept="image/png, image/jpeg" name="propic" />
                                    </label>
                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2M</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input class="form-control" type="text" id="fullname" name="fullname" autofocus
                                        value="{{ old('fullname', Auth::user()->name) }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" id="username" name="username"
                                        placeholder="asep.surasep@example.com"
                                        value="{{ old('username', Auth::user()->username) }}" />
                                </div>
                                <div class="alert alert-warning">Leave empty if you don't want to change ther password</div>
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="conpass" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="conpass" name="conpass" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="role">Role</label>
                                    <select id="role" class="select2 form-select" disabled>
                                        <option value="">{{ Auth::user()->role }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be
                                    certain.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" method="POST" action="{{ route('profile.delete') }}">
                            @csrf
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountDeletion"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountDeletion">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
