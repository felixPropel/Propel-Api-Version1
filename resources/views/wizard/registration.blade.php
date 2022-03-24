@extends('layouts.auth.app')

@section('form')

<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">Create Account</p>

                        <p class="white mb-0">
                            Don’t have a Login yet, just enter your mobile number and follow us. we ensure your Signup for a New Account in few steps
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Register</h6>
                        <form action="{{route('confirmation')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="Mobile" name="mobile" value="{{ $mobile }}" />
                                <span class="text-danger">@error('mobile'){{ $message }}@enderror</span>
                                <span>Mobile Number</span>
                            </label>

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="email" placeholder="Email" name="email" value="{{ $email }}" />
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                <span>Email Address</span>
                            </label>

                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="dependency" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">The above details are my personal mobile number and email</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="dependency" value="2" required class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">The above details are not mine, I use or share information of my family member. Else I use my official, which I may hand over on my exit</label>
                                </div>
                            </div>


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