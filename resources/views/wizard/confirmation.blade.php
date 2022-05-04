@extends('layouts.auth.app')

@section('form')

<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>

                        <p class="white mb-0">

                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Login</h6>
                        <form action="{{route('registration')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf
                            <h5>No user information was found on our system,</h5>
                            <h5>To continue further kindly signup for a new account by filling the following details.</h5>
                            <h5>Its our Pleasure to have you as user</h5>
                            <input type="hidden" name="email" value="{{$email}}">
                            <input type="hidden" name="mobile" value="{{$mobile}}">

                            <span class="text-danger">@error('error'){{ $message }}@enderror</span>
                            <div class="d-flex justify-content-between align-items-center">

                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">Next</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection