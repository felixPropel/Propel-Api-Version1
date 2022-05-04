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
                        <h6 class="mb-4">Login</h6>
                        <form action="{{route('check')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf
                            @error('success')
                            <span style="color:green;">{{ $message }}</span>
                            @enderror
                          
                            @if( request()->get('m') == '')
                            @php
                            $mobile="";
                            @endphp
                            <label class="form-group has-float-label mb-4">
                                <input type="text" placeholder="mobile/email" class="form-control" name="username" value="{{ old('username') }}">
                                <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                                <span>Username</span>
                            </label>
                            @endif
                            @if( request()->get('m'))
                            @php 
                                $mobile=request()->get('m');
                                @endphp
                            <input type="hidden" name="username" value="{{request()->get('m')}}">
                            @endif
                            <label class="form-group has-float-label mb-4">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                <span>Password</span>
                            </label>
                            <div class="d-flex justify-content-between align-items-center">
                              
                                    @if ($mobile)
                                    <a href="{{url('forgot_password/'.$mobile)}}">Forget password?</a>
                                    @endif
                               
                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection