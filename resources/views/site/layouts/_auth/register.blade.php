@extends('layouts.app')
    <!-- Sign Up Section Start -->
    <div class="login-section">
        <div class="materialContainer">
            <div class="box">
                <form method="POST" action="http://localhost:8000/register">
                    <input type="hidden" name="_token" value="MkRqEzTGuoSx6LqJUm0OAKxSgNUYt26wTT7RMUZY">
                    <div class="login-title">
                        <h2>Register</h2>
                    </div>

                    <div class="input">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required="" autofocus="" autocomplete="name">
                    </div>

                    <div class="input">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone')" required="" autofocus="" autocomplete="phone">
                    </div>

                    <div class="input">
                        <label for="emailname">Email Address</label>
                        <input type="email" id="emailname" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required="" autocomplete="username">
                    </div>

                    <div class="input">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" class="block mt-1 w-full" name="password" required=""
                            autocomplete="new-password">
                    </div>

                    <div class="input">
                        <label for="compass">Confirm Password</label>
                        <input type="password" id="compass" class="block mt-1 w-full" name="password_confirmation"
                            required="" autocomplete="new-password">
                    </div>

                    <div class="button login">
                        <button type="submit">
                            <span>Sign Up</span>
                            <i class="fa fa-check"></i>
                        </button>
                    </div>
                </form>
            </div>
            <p><a href="login.html" class="theme-color">Already have an account?</a></p>
        </div>
    </div>


