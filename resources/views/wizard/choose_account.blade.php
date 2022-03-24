@extends('layouts.auth.app')

@section('form')

<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">Welcome,</p>

                        <p class="white mb-0">
                            Propel Soft Welcomes,{{ $first_name->first_name }}!
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Profile</h6>


                        <h4>Select an account to manage</h4>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Account</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr tabindex="0" onmousedown="window.location='#';">
                                    <td>{{$family_name->family_name}}</td>
                                    <td>Personal</td>
                                    <td>Administrator</td>
                                </tr>

                            </tbody>
                        </table>

                        <input type="hidden" name="uid" value="{{$uid}}">


                        <div class="d-flex justify-content-between align-items-center">

                            <a href="{{route('/login',['m'=>$mobile->mobile])}}"><button class="btn btn-primary btn-lg btn-shadow" type="submit">Enable Default Login</button></a>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
if (window.performance && window.performance.navigation.type == window.performance.navigation.TYPE_BACK_FORWARD) {
    window.location.href="/logout";
}
</script>