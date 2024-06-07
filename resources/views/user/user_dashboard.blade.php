@extends('user.user_master')
@section('user')
<div class="page-content">
    <div class="container-fluid">

        @if ($message = Session::get('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bg-soft-success ">
                        <h4 class="card-title mb-4">Teacher Detail </h4>
                        <hr />

                        <h1>User Dashboard</h1>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection