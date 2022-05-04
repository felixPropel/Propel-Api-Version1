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
                            Don’t have a Login yet, just enter your mobile number and follow us. we ensure your Signup for a New Account in few steps

                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        @if ($error)
                                <span class="danger" style="color:red;">{{$error}}</span>
                            @endif
                            @if ($success)
                                <span class="success" style="color:green;">{{$success}}</span>
                            @endif
                        <h6 class="mb-4">OTP Verification</h6>
                      
                        <form action="{{route('validate_otp')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf
                           
                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" placeholder="Enter OTP Received on your email" name="otp" value="{{ old('otp') }}" required />
                                <span class="text-danger">@error('otp'){{ $message }}@enderror</span>
                                <span>Enter OTP Received on your email {{$email}}</span>
                            </label>

                            <input type="hidden" name="uid" value="{{$uid}}">
                            <input type="hidden" name="email" value="{{$email}}">
                            <div class="d-flex justify-content-between align-items-center">

                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">Next</button>
                                @if($error)
                                <a href="{{route('resend_email_otp',['uid'=>$uid])}}"><button class="btn btn-primary btn-lg btn-shadow" type="button">Resend OTP</button></a>
                                @endif
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection