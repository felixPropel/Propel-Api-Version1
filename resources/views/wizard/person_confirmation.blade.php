@extends('layouts.auth.app')

@section('form')

<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">User Data Not Found</p>

                        <p class="white mb-0">
                            Would You like to convert your person data into working user data,  
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">User</h6>
                        <form action="{{route('person_otp')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf
                            <h5>No user information was found on our system,</h5>
                            <h5>Click the next button to convert your person data to user data</h5>
                            <h5>Its our Pleasure to have you as user</h5>
                            <input type="hidden" name="uid" value="{{$uid}}">

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