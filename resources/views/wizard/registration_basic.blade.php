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
                        <form action="{{route('basic_details1')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf
                            <span class="text-danger">@error('error'){{ $message }}@enderror</span>
                            <label class="form-group has-float-label mb-4">
                                <select name="gender" class="form-control" id="gender" required>
                                    <option value="">Select</option>
                                    @foreach ($gender as $key => $value)
                                    <option value="{{ $value->id }}">
                                        {{ $value->gender }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                <span>Gender</span>
                            </label>

                            <label class="form-group has-float-label mb-4">
                                <select name="blood_group" class="form-control" id="blood_group" required>
                                    <option value="">Select</option>
                                    @foreach ($blood as $key => $value)
                                    <option value="{{ $value->id }}">
                                        {{ $value->blood_group }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
                                <span>Blood Group</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="date" placeholder="DOB" name="dob" value="{{ old('dob') }}" />
                                <span class="text-danger">@error('dob'){{ $message }}@enderror</span>
                                <span>DOB</span>
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