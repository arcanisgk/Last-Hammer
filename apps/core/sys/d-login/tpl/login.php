<?php
    $enable_registry = (CONF_DATA['SETUP']['USER_ACC_REGISTRY'] == 'true' ?: 'style="display: none;"');
?>
<div class="container">
    <form id="formarea" name="f-sign-in-up" autocomplete="off">
        <div class="row" style="margin-top: 5%;">
            <!-- For Demo Purpose -->
            <div class="offset-lg-2 col-lg-4 text-center">
                <img src="assets/img/logos/logo.png" class="mx-auto" style="width: 200px; margin-top: 5%; margin-bottom: 5%;">
            </div>
            <!-- Registeration Form -->
            <div class="col-lg-4 collapse signforms animated bounceInRight" id="signup">
                <div class="row">
                     <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">{toglein}
                            <button class="btn btn-danger btn-sm" type="button" data-toggle="collapse" data-target=".signforms" aria-expanded="false" aria-controls="signin signup">{togleinbtn}</button>
                        </p>
                    </div>
                    <!-- First Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-right-0">
                                <i class="fa fa-user text-danger"></i>
                            </span>
                        </div>
                        <input type="text" name="firstname" placeholder="{firstname}" class="form-control bg-white border-left-0">
                    </div>
                    <!-- Last Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-right-0">
                                <i class="fa fa-user text-danger"></i>
                            </span>
                        </div>
                        <input type="text" name="lastname" placeholder="{lastname}" class="form-control bg-white border-left-0">
                    </div>
                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-right-0">
                                <i class="fa fa-envelope text-danger"></i>
                            </span>
                        </div>
                        <input type="email" name="email" placeholder="{email}" class="form-control bg-white border-left-0 ">
                    </div>
                    <!-- Phone Number -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-right-0">
                                <i class="fa fa-phone-square text-danger"></i>
                            </span>
                        </div>
                        <select name="countryCode" style="max-width: 80px" class="custom-select form-control bg-white border-left-0 h-100 font-weight-bold text-danger">
                            <option value="">+507</option>
                        </select>
                        <input type="tel" name="phone" placeholder="{phone}" class="form-control bg-white border-left-0 pl-3">
                    </div>
                    <!-- Password -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-right-0">
                                <i class="fa fa-lock text-danger"></i>
                            </span>
                        </div>
                        <input type="password" name="password" placeholder="{password}" class="form-control bg-white border-left-0 border-right-0">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white px-3 border-left-0">
                                <i class="fas fa-eye text-danger"></i>
                            </span>
                        </div>
                    </div>
                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-right-0">
                                <i class="fa fa-lock text-danger"></i>
                            </span>
                        </div>
                        <input type="text" name="passwordConfirmation" placeholder="{confpassword}" class="form-control bg-white border-left-0 border-right-0">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white px-3 border-left-0">
                                <i class="fas fa-eye text-danger"></i>
                            </span>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <a href="#" class="btn btn-gold btn-block py-2" name="e-signup">
                            <span class="font-weight-bold">{signupbtn}</span>
                        </a>
                    </div>
                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">{or}</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>
                    <!-- Social Login -->
                    <div class="form-group col-lg-12 mx-auto">
                        <a href="#" class="btn btn-silver btn-block py-2" name="e-signup-google">
                            <i class="fab fa-google mr-2"></i>
                            <span class="font-weight-bold">{signupgooglebtn}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 collapse signforms show animated bounceInRight" id="signin">
                <div class="row">
                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p <?=$enable_registry?> class="text-muted font-weight-bold">{togleup}
                            <button class="btn btn-danger btn-sm" type="button" data-toggle="collapse" data-target=".signforms" aria-expanded="false" aria-controls="signin signup">{togleupbtn}</button>
                        </p>
                    </div>
                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-right-0">
                                <i class="fa fa-envelope text-danger"></i>
                            </span>
                        </div>
                        <input type="email" name="email" placeholder="{email}" class="form-control bg-white border-left-0">
                    </div>
                    <!-- Password -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-right-0">
                                <i class="fa fa-lock text-danger"></i>
                            </span>
                        </div>
                        <input type="password" name="password" placeholder="{password}" class="form-control bg-white border-left-0 border-right-0">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white px-3 border-left-0">
                                <i class="fas fa-eye text-danger"></i>
                            </span>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <a href="#" class="btn btn-gold btn-block py-2" name="e-signin">
                            <span class="font-weight-bold">{signinbtn}</span>
                        </a>
                    </div>
                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">{or}</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>
                    <!-- Social Login -->
                    <div class="form-group col-lg-12 mx-auto">
                        <a href="#" class="btn btn-silver btn-block py-2" name="e-signin-google">
                            <i class="fab fa-google mr-2"></i>
                            <span class="font-weight-bold">{signingooglebtn}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

