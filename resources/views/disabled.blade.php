@extends('layouts.main')
@section('title', 'Account Disabled')
@section('content')
    <div class="d-flex vh-100 justify-content-center align-items-center">
        <div class="card shadow mt-3">
            <div class="card-header text-danger">Account disabled!</div>
            <div class="card-body">
                <h4>Dear user, your account are waiting to be verified by the Owner. Please wait or try to contact the
                    owner.</h4>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>

    </div>
    </div>
@endsection
