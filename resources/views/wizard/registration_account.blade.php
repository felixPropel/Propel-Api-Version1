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
                        <form action="{{route('basic_details')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf
                            <span class="text-danger">@error('error'){{ $message }}@enderror</span>
                            <label class="form-group has-float-label mb-4">
                                <!-- <input class="form-control" type="text" placeholder="Saluation" name="saluation" value="{{ old('saluation') }}" /> -->
                                <select name="saluation" class="form-control" id="exampleFormControlSelect1">
                                    <option value="">Select</option>
                                    @foreach ($saluations as $key => $value)
                                    <option value="{{ $value->id }}">
                                        {{ $value->saluation }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('saluation'){{ $message }}@enderror</span>
                                <span>Saluation</span>
                            </label>

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" />
                                <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                <span>First Name</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" />
                                <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                <span>Last Name</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="Nick Name" name="nick_name" value="{{ old('nick_name') }}" />
                                <span class="text-danger">@error('nick_name'){{ $message }}@enderror</span>
                                <span>Nick Name</span>
                            </label>

                            <input type="hidden" name="uid" value="{{$uid}}">


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