@extends('user.user_master')
@section('user')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card overflow-hidden">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card"><br><br>


                                @if ($userData->photo)
                                <img class="rounded-circle avatar-xl" src="{{ asset('upload/photo/'.$userData->photo) }}" alt="">
                                @else
                                <img class="rounded-circle avatar-xl" src="{{ asset('upload/user.jpg') }}" alt="">
                                @endif





                                <div class="card-body">
                                    <h4 class="card-title">Name : {{ $userData->name }} </h4>
                                    <hr>
                                    <h4 class="card-title">User Email : {{ $userData->email }} </h4>
                                    <hr>
                                    <h4 class="card-title">User Name : {{ $userData->username }} </h4>
                                    <hr>
                                    <h4 class="card-title">User Phone : {{ $userData->phone }} </h4>
                                    <hr>
                                    <h4 class="card-title">User Address : {{ $userData->address }} </h4>
                                    <hr>
                                    <a href="{{ route('user.edit.profile') }}" class="btn btn-info btn-rounded waves-effect waves-light"> Edit Profile</a>
                                    <a href="{{ route('user.delete.profile') }}" class="btn btn-danger btn-rounded waves-effect waves-light"> Delete Prfile</a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>



    </div>
</div>


@endsection