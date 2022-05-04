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
                        <form action="{{route('form_submit')}}" class="frm-single" method="post" autocomplete="off">
                            @csrf


                            <fieldset class="fieldset-password">
                                <!-- <div id="alert-invalid-password" class="alert alert-danger hide">Please enter a valid password</div> -->
                                <p>All checkmarks must turn green in order to proceed</p>
                                <div id="password-info">
                                    <ul>
                                        <li id="length" class="invalid clearfix">
                                            <span class="icon-container">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>
                                            At least 8 characters
                                        </li>
                                        <li id="capital" class="invalid clearfix">
                                            <span class="icon-container">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>
                                            At least 1 uppercase letter
                                        </li>
                                        <li id="lowercase" class="invalid clearfix">
                                            <span class="icon-container">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>
                                            At least 1 lowercase letter
                                        </li>
                                        <li id="number-special" class="invalid clearfix">
                                            <span class="icon-container">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>
                                            At least 1 number or <span title="&#96; &#126; &#33; &#64; &#35; &#36; &#37; &#94; &#38; &#42; &#40; &#41; &#43; &#61; &#124; &#59; &#58; &#39; &#34; &#44; &#46; &#60; &#62; &#47; &#63; &#92; &#45;" class="special-characters tip">special character</span>
                                        </li>
                                    </ul>
                                </div>

                                <br>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" id="input-password" type="password" placeholder="Enter New Password" name="password" value="{{ old('password') }}" />
                                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                    <span>Password</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" id="input-password1" type="password" placeholder="Retype Password for Confirmation" name="password_confirmation" value="{{ old('confirm_password') }}" />
                                    <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                                    <span>Confirm Password</span>
                                </label>

                                <div id="bar">
                                    <bar>
                                        <div class="mb-3">
                                            <span id='message'></span>
                                        </div>
                            </fieldset>
                            <span id='message1'></span>
                            <input type="hidden" name="uid" value="{{$uid}}">


                            <div class="d-flex justify-content-between align-items-center">

                                <button class="btn btn-primary btn-lg btn-shadow sign_up" type="submit">Sign up</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //password validation

    $(function() {
        $(".mybtn").prop("disabled", true);
    });
    /* Strong = 8 caracteres alfanuméricos + mayúsculas + símbolos
     * Medium = 7 caracteres alfanuméricos + mayúsculas
     * Normal = 6 o más caracteres
     * Bad = el resto
     */
    window.onload = function() {
        document.querySelector('#input-password').onkeyup = function(e) {
            var result = document.querySelector('#bar'),
                pass = this.value,
                strong = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g"),
                medium = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g"),
                normal = new RegExp("(?=.{6,}).*", "g"),
                meter;
            if (pass.length) {
                if (strong.test(pass)) {
                    meter = "strong";
                } else if (medium.test(pass)) {
                    meter = "medium";
                } else if (normal.test(pass)) {
                    meter = "normal";
                } else {
                    meter = "bad";
                }
            } else {
                meter = "";
            }
            result.className = meter;
            return true;
        };

    }

    // Tooltips
    // -----------------------------------------

    // Only initialise tooltips if devices is non touch
    if (!('ontouchstart' in window)) {
        $('.tip').tooltip();
    }

    // Password Validation
    // -----------------------------------------

    $(function passwordValidation() {

        var pwdInput = $('#input-password');
        var pwdInputText = $('#input-password-text'); // This is the input type="text" version for showing password
        var pwdValid = false;

        var A;
        var B;
        var C;
        var D;

        function validatePwdStrength() {

            var pwdValue = $(this).val(); // This works because when it's called it's called from the pwdInput, see end

            // Validate the length
            if (pwdValue.length > 7) {
                $('#length').removeClass('invalid').addClass('valid');
                pwdValid = true;
                A = true;
            } else {
                $('#length').removeClass('valid').addClass('invalid');
                A = false;
            }

            // Validate capital letter
            if (pwdValue.match(/[A-Z]/)) {
                $('#capital').removeClass('invalid').addClass('valid');
                pwdValid = pwdValid && true;
                B = true;
            } else {
                $('#capital').removeClass('valid').addClass('invalid');
                pwdValid = false;
                B = false;
            }

            // Validate lowercase letter
            if (pwdValue.match(/[a-z]/)) {
                $('#lowercase').removeClass('invalid').addClass('valid');
                pwdValid = pwdValid && true;
                C = true;
            } else {
                $('#lowercase').removeClass('valid').addClass('invalid');
                pwdValid = false;
                C = false;
            }

            // Validate number or special character
            if (pwdValue.match(/[\d`~!@#$%\^&*()+=|;:'",.<>\/?\\\-]/)) {
                $('#number-special').removeClass('invalid').addClass('valid');
                pwdValid = pwdValid && true;
                D = true;
            } else {
                $('#number-special').removeClass('valid').addClass('invalid');
                pwdValid = false;
                D = false;
            }

            if (A && B && C && D) {
                $(".mybtn").prop('disabled', false);
            } else {
                $(".mybtn").prop('disabled', true);
            }
        }



        pwdInput.bind('change keyup input', validatePwdStrength); // Keyup is a bit unpredictable
        pwdInputText.bind('change keyup input', validatePwdStrength); // This is the input type="text" version for showing password



    }); // END passwordValidation()

    $(function() {
        // $(".sign_up").attr('disabled' , true);
        $('#input-password, #input-password1').on('keyup', function() {
            if ($('#input-password').val() == $('#input-password1').val()) {
                $('#message1').html('Matching').css('color', 'green');
                $(':button[type="submit"]').prop('disabled', false);
            } else {
                $('#message1').html('Not Matching').css('color', 'red');
                $(':button[type="submit"]').prop('disabled', true);
            }

        });
    });
</script>