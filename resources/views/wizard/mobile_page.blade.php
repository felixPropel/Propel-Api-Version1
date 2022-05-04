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
                        <form action="{{route('stage1')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+91</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="India" style="text-align:center;" readonly>
                                <span class="input-group-addon">
                                    <img src="{{asset('assets/images/Flag-India.jpg')}}" height="38px" width="38px" />
                                </span>
                            </div>

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control"  placeholder="Enter Your Personal Mobile Number only" name="mobile" value="{{ old('mobile') }}"/>
                                <span class="text-danger">@error('mobile'){{ $message }}@enderror</span>
                                <span>Mobile Number</span>
                            </label>



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