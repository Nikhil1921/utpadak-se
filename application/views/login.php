<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="account-area mt-70 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="basic-login mb-50">
                    <h5>Login</h5>
                    <form action="#">
                        <label for="name">Username or email address  <span>*</span></label>
                        <input id="name" type="text" placeholder="Enter Username">
                        <label for="pass">Password <span>*</span></label>
                        <input id="pass" type="password" placeholder="Enter password...">
                        <div class="login-action mb-10 fix">
                            <span class="log-rem f-left">
                                <input id="remember" type="checkbox">
                                <label for="remember">Remember me</label>
                            </span>
                            <span class="forgot-login f-right">
                                <a href="#">Lost your password?</a>
                            </span>
                        </div>
                        <a href="login.html" class="tp-in-btn w-100">log in</a>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="basic-login">
                    <h5>Register</h5>
                    <?php
                    switch (true):
                        case $this->session->reg_mobile:
                            echo form_open('register/check', 'id="register-form"');
                            echo form_label('OTP <span>*</span>', 'otp');
                            echo form_input([
                                    'id'          => "otp",
                                    'placeholder' => "OTP",
                                    'name'        => "otp",
                                    'value'       => set_value('otp'),
                                    'maxlength'   => 4
                                ]);
                            echo form_error('otp');
                            break;

                        case $this->session->verified:
                            
                            break;
                        
                        default:
                            echo form_open('register', 'id="register-form"');
                            echo form_label('Mobile No. <span>*</span>', 'reg_mobile');
                            echo form_input([
                                    'id'          => "reg_mobile",
                                    'placeholder' => "Mobile No.",
                                    'name'        => "reg_mobile",
                                    'value'       => set_value('reg_mobile'),
                                    'maxlength'   => 10
                                ]);
                            echo form_error('reg_mobile');
                            break;
                    endswitch;
                        echo form_button([
                            'type'    => 'submit',
                            'class'   => 'tp-in-btn w-100',
                            'content' => 'Register'
                        ]);
                    echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>