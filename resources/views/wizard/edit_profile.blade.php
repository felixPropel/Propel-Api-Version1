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
                        <h6 class="mb-4">Profile</h6>
                        <form action="{{route('complete_profile')}}" class="frm-single" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <div class="row form-group header_profile_pic">
                                <div class="small-12 medium-2 large-2 columns">
                                    <div class="circle">
                                        <!-- User Profile Image -->
                                        <img class="profile-pic" src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?size=338&ext=jpg">

                                        <!-- Default Image -->
                                        <!-- <i class="fa fa-user fa-5x"></i> -->
                                    </div>
                                    <div class="p-image">
                                        <i class="glyph-icon simple-icon-camera upload-button"></i>
                                        <input class="file-upload" type="file" name="profilePhoto" accept="image/*" />
                                    </div>
                                </div>
                            </div>

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="Name" name="name" value="{{$result[0]['first_name']}}" />
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                <span>Name</span>
                            </label>

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="Mobile" name="mobile" value="{{$result[0]['mobile'][0]['mobile']}}" />
                                <span class="text-danger">@error('mobile'){{ $message }}@enderror</span>
                                <span>Mobile</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="Email" name="email" value="{{$result[0]['email'][0]['email']}}" />
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                <span>Email</span>
                            </label>

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="date" placeholder="DOB" name="dob" value="{{$result[0]['dob']}}" />
                                <span class="text-danger">@error('dob'){{ $message }}@enderror</span>
                                <span>DOB</span>
                            </label>
                            @foreach ( $result[0]['person_address'] as $address)

                            @if ($address['address_type']==1)

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="home address" name="home_address" value="{{$address['address']}}" />
                                <span class="text-danger">@error('home_address'){{ $message }}@enderror</span>
                                <span>Home Address</span>
                            </label>
                            @endif
                            @if ($address['address_type']==2)
                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="office address" name="office_address" value="{{$address['address']}}" />
                                <span class="text-danger">@error('office_address'){{ $message }}@enderror</span>
                                <span>Office Address</span>
                            </label>
                            @endif
                            @endforeach

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="text" placeholder="Family Name" name="family_name" value="{{$result[0]['family_name'].' '.'family'}}" />
                                <span class="text-danger">@error('family_name'){{ $message }}@enderror</span>
                                <span>Family Name</span>
                            </label>

                            <input type="hidden" name="uid" value="{{$uid}}">


                            <div class="d-flex justify-content-between align-items-center">

                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection