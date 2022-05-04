@extends('layouts.auth.app')

@section('form')

<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">Profile</p>

                        <p class="white mb-0">
                            Profile Picture
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Upload</h6>
                        <form action="{{route('upload_pic')}}" class="frm-single" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="portlet light profile-sidebar-portlet bordered">
                                <div class="profile-userpic">
                                    <img class="profile-pic1" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbQhMGTrXKKq2SWR_oAMKqkPge-aKuxqLAIg&usqp=CAU" class="img-responsive" alt="">
                                </div>

                                <div class="profile-usertitle">


                                    <div class="custom-file">
                                    <input type="hidden" name="uid" value="{{$uid}}">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="profilePhoto" value="{{ old('profile') }}">
                                    <label class="custom-file-label" for="inputGroupFile01">Upload Profile Pic</label>
                                    <span class="text-danger">@error('profile'){{ $message }}@enderror</span>
                                </div>
                                </div>
                                <div class="profile-userbuttons d-flex justify-content-between align-items-center">
                                    <a href="{!! route('edit_profile', ['uid'=>$uid]) !!}"><button type="button" class="btn btn-primary btn-lg btn-shadow">Skip Now</button></a>
                                    <button type="submit" class="btn btn-primary btn-lg btn-shadow">Update</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection