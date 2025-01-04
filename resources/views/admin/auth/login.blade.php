<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UMC-SlotBooking | Sign In</title>
        <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}">
        <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
        <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <style>
            body{
                background-color: #f0f8ff;
                overflow-x: hidden;
            }

            .bg-img{
                background-image: url('{{ asset('admin/images/Disaster Management System.jpg') }}');
                background-repeat: no-repeat;
                background-position: 0%;
                background-size: cover;
                content: "";
                height: 100vh;
            }
            .right-content-div{
                background: #284db2;
                color: #fff;
                padding: 3% 2%;
                text-align: center;
                margin: 0% 10%;
                font-size: 18px;
                font-weight: 800;
                border-radius: 10px;
            }
            .custompadding{
                padding: 5% 10%;
            }

            .form-control{
                padding: 10px;
                border: 1px solid #2b5de4;
            }

            @media only screen and (min-width: 1200px) {
                .bg-img {
                    background-position: 1%;
                }
            }

            @media only screen and (max-width: 1999px) {
                .bg-img {
                    background-position: 1%;
                }
            }

            @media only screen and (max-width: 1115px) {
                .bg-img {
                    background-position: 16%;
                }
            }

            @media only screen and (max-width: 1060px) {
                .bg-img {
                    background-position: 24%;
                }
            }

            @media only screen and (max-width: 992px) {
                .bg-img {
                    background-position: 30%;
                }
            }

            @media only screen and (max-width: 767px) {
                .bg-img {
                    background-image: none;
                    background-color: #fff;
                    height: auto;
                    display: flex: 
                    justify-content: center;
                }

                .mobile-view-bgcolor{
                    background-color: #234cb3;
                }

                .mobile-view-bgcolor, body{
                    background-color: #234cb3;
                }

                .form-control{
                    padding: 10px;
                    background-color: #fff;
                    border: 1px solid #fff;
                }

                .form-label, .form-check-label{
                    color: #fff;
                }

                #loginForm_submit{
                    background-color: #fff;
                    color: #234cb3;
                    font-weight: 900;
                    font-size: 18px;
                    width : 50% !important;
                }

                .textSignup{
                    color: #fff!important;
                }
            }

            .bg-img {
                background-image: url(admin/images/slotbooking.jpg);
                background-repeat: no-repeat;
                background-position: 0%;
                background-size: cover;
                content: "";
                height: 100vh;
            }

            .modal-backdrop{
                background-color: #0000009c!important;
            }
        </style>
    </head>
    <body>
        <section class="">
            <div class="container-fluid">
                <div class="row">
                    <div class="bg-img col-lg-6 col-md-6 col-12 d-flex justify-content-center">
                        <img class="d-md-none d-lg-none d-xl-none d-sm-block d-block mt-4" src="{{ asset('admin/images/slotbooking.jpg') }}" style="width: 300px;">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 d-md-none d-lg-none d-xl-none d-sm-block d-block mobile-view-bgcolor">
                        <img src="{{ asset('admin/images/slotbooking.jpg') }}" style="width: 100%" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mobile-view-bgcolor">
                        <div class="d-flex justify-content-center mt-3">
                            <img src="{{ asset('admin/images/logo.png') }}" alt=""  height="150">
                        </div>
                        <div class="text-center mt-3">
                            <h3><b>SLOT-BOOKING</b></h3>
                        </div>
                        <div class="text-center mt-3">
                            <h5>लॉगिन मध्ये आपले स्वागत आहे </h5>
                        </div>
        
                        <!-- Login Form -->
                        <div class="container custompadding" id="loginFormContainer">
                            <form id="loginForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                    <span class="text-danger is-invalid username_err"></span>
                                </div>
        
                                <div class="mb-3">
                                    <div style="display: flex !important; flex-wrap: nowrap; justify-content: space-between;">
                                        <label class="form-label" for="password-input">Password<span class="text-danger">*</span></label>
                                        <p class="">
                                            <a class="text-primary"   style="cursor: pointer;">
                                                Forgot Password
                                            </a>
                                        </p>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password" name="password" required>
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon" onclick="togglePassword()">
                                            <i class="ri-eye-fill align-middle" id="eye-icon"></i>
                                        </button>
                                    </div>
                                    <span class="text-danger is-invalid password_err"></span>
                                </div>
                               
                                <div class="mt-4">
                                    <div class="text-center">
                                    <button class="btn btn-primary w-30" type="submit" id="loginForm_submit">Sign In</button>
                                    </div> 
                                </div>
                                <p class="mt-3 text-center">Don't Have An Account? <a class="text-primary signUp" style="cursor: pointer;"> Signup </a></p>
                            </form>
                        </div>

        
                        <!-- Signup Form (Initially Hidden) -->
                        <div class="container custompadding d-none" id="signupFormContainer">
                            <form id="signupForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="signupFullName" class="form-label">Full Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="signupFullName" name="fullname" required 
                                            pattern="^[A-Za-z\s]+$" 
                                            title="Only letters and spaces are allowed.">
                                    </div>
                                    
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="signupEmail" class="form-label">Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="signupEmail" name="email"  required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="signupMobile" class="form-label">Mobile Number<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="signupMobile" name="mobile" required>
                                        <span id="mobile-error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="signupDob" class="form-label">DOB<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="signupDob" name="dob" required onchange="calculateAge()">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="signupAge" class="form-label">Age<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="signupAge" name="age" required readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="signupUsername" class="form-label">Username<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="signupUsername" name="username" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="signupcitizenType" class="form-label">Select Citizen<span class="text-danger">*</span></label>
                                        <select id="signupcitizenType" name="citizenType" class="form-select">
                                            <option>Select Citizen Type</option>
                                            <option value="individual">Individual</option>
                                            <option value="seniorCitizen">Senior Citizen</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="signupPassword" class="form-label">Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="signupPassword" name="password" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon" onclick="togglePassword('signupPassword')">
                                                <i class="ri-eye-fill align-middle" id="eye-icon-password"></i>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="signupImage" class="form-label">Upload Image<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="signupImage" accept="image/*" name="image" required>
                                    </div> --}}
                                    
                                </div>

                                <div class="row">
                                   
                                    <div class="col-md-6 mb-3">
                                        <label for="signupConfirmPassword" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Confirm password" id="signupConfirmPassword" name="confirmPassword" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-addon" onclick="togglePassword('signupConfirmPassword')">
                                                <i class="ri-eye-fill align-middle" id="eye-icon-confirmPassword"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary w-30"  id="signupForm_submit">Signup</button>
                                </div>
                                <p class="mt-3 text-center">Already Have An Account? <a class="text-primary signIntext" style="cursor: pointer;"> Signin </a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- JavaScript/jQuery to Toggle Forms -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
              
                $(".signUp").click(function() {
                    $("#loginFormContainer").addClass("d-none");
                    $("#signupFormContainer").removeClass("d-none");
                });
        
          
                $(".signIntext").click(function() {
                    $("#signupFormContainer").addClass("d-none");
                    $("#loginFormContainer").removeClass("d-none");
                });
            });

            function togglePassword(fieldId) {
            var passwordInput = document.getElementById(fieldId);
            var eyeIcon = document.getElementById('eye-icon-' + fieldId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text'; 
                eyeIcon.classList.remove('ri-eye-fill');
                eyeIcon.classList.add('ri-eye-off-fill'); 
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('ri-eye-off-fill');
                eyeIcon.classList.add('ri-eye-fill'); 
            }
        }
         

        </script>
        <script>
            $(document).ready(function(){

                $(".signUp").click(function(){
                    $("#loginFormContainer").addClass("d-none");
                    $("#signupFormContainer").removeClass("d-none");
                });
        
               
                $("#loginForm_submit").click(function(){
                    $("#loginFormContainer").addClass("d-block");
                    $("#signupFormContainer").removeClass("d-none");
                });
            });
        </script>
        

        <script src="{{ asset('admin/js/jquery.min.js') }}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('admin/js/sweetalert.min.js') }}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $("#loginForm").submit(function(e) {
                
                e.preventDefault();
                $("#loginForm_submit").prop('disabled', true);
                $("#signupFormContainer").css('display', 'none'); 
                var formdata = new FormData(this);
                $.ajax({
                    url: '{{ route('signin') }}',
                    type: 'POST',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    beforeSend: function()
                    {
                        $('#preloader').css('opacity', '0.5');
                        $('#preloader').css('visibility', 'visible');
                    },
                    success: function(data) {
                        if (!data.error && !data.error2) {
                          
                                window.location.href = '{{ route('dashboard') }}';
                        } else {
                            if (data.error2) {

                                
                                swal("Error!", data.error2, "error");
                                $("#loginForm_submit").prop('disabled', false);
                            } else {
                                $("#loginForm_submit").prop('disabled', false);
                                resetErrors();
                                printErrMsg(data.error);
                            }
                        }
                    },
                    error: function(error) {
                        $("#loginForm_submit").prop('disabled', false);
                    },
                    statusCode: {
                        422: function(responseObject, textStatus, jqXHR) {
                            $("#addSubmit").prop('disabled', false);
                            resetErrors();
                            printErrMsg(responseObject.responseJSON.errors);
                        },
                        500: function(responseObject, textStatus, errorThrown) {
                            $("#addSubmit").prop('disabled', false);
                            swal("Error occured!", "Something went wrong please try again", "error");
                        }
                    },
                    complete: function() {
                        $('#preloader').css('opacity', '0');
                        $('#preloader').css('visibility', 'hidden');
                    },
                });

                function resetErrors() {
                    var form = document.getElementById('loginForm');
                    var data = new FormData(form);
                    for (var [key, value] of data) {
                        console.log(key, value)
                        $('.' + key + '_err').text('');
                        $('#' + key).removeClass('is-invalid');
                        $('#' + key).addClass('is-valid');
                    }
                }

                function printErrMsg(msg) {
                    $.each(msg, function(key, value) {
                        console.log(key);
                        $('.' + key + '_err').text(value);
                        $('#' + key).addClass('is-invalid');
                    });
                }

            });
        </script>

<script>
    $("#signupForm").submit(function(e) {
        e.preventDefault();
    
        var password = $("#signupPassword").val();
        var confirmPassword = $("#signupConfirmPassword").val();

        if (password !== confirmPassword) {
            swal("Error!", "Passwords do not match!", "error");
            return; 
        }

        $("#signupForm_submit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('register') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#signupForm_submit").prop('disabled', false);
                if (!data.error2) {
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('login') }}';
                    });
                } else {
                    swal("Error!", data.error2, "error");
                }
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#signupForm_submit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#signupForm_submit").prop('disabled', false);
                    swal("Error occurred!", "Something went wrong. Please try again.", "error");
                }
            }
        });
    });



    function calculateAge() {
    var dob = document.getElementById("signupDob").value; 
    var dobDate = new Date(dob); 
    var today = new Date(); 

    var age = today.getFullYear() - dobDate.getFullYear(); 
    var monthDifference = today.getMonth() - dobDate.getMonth(); 

    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
        age--;
    }

    document.getElementById("signupAge").value = age;

    if (age < 18) {
        alert("You must be at least 18 years old.");
        document.getElementById("signupAge").value = ""; 
        document.getElementById("signupDob").value = ""; 
        return false; 
    }

    return true; 
}

</script>


        {{-- show password --}}
        <script>
            document.getElementById('password-addon').addEventListener('click', function () {
                var passwordInput = document.getElementById('password');
                var icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        </script>
        <script>
            function validateMobile() {
                    var mobile = document.getElementById("signupMobile"); 
                    var errorSpan = document.getElementById("mobile-error"); 

                    var mobileValue = mobile.value.replace(/\D/g, ''); 

                    if (mobileValue.length > 10) {
                        mobileValue = mobileValue.substring(0, 10);
                    }

                    mobile.value = mobileValue;

                    if (mobileValue.length === 10) {
                        errorSpan.textContent = "";
                        mobile.classList.remove("is-invalid");
                    } else {
                        errorSpan.textContent = "Please enter a valid 10-digit mobile number."; 
                        mobile.classList.add("is-invalid"); 
                    }
                }
           document.getElementById("signupMobile").addEventListener("input", validateMobile);
        </script>
        
    </body>
</html>