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
                            No credentials are found, with your mobile number {{$mobile}}, Kindly provide email for cross verification
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Login</h6>
                        <form action="{{route('stage_3')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="email" placeholder="Enter Your Personal Email only" name="email" value="{{ old('email') }}" />
                                <input type="hidden" name="mobile" value="{{$mobile}}">
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                <span>Email Address</span>
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