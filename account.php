<?php 

if(isset($_COOKIE["login_info"])) {
    header("Location: http://localhost/qa/home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
<link rel="stylesheet" type="text/css" href="css/common.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="nav-container" style="z-index: 11">
        <nav>
            <div class="icon-bar">
                <a class="nav-link" href="home.php" id="account_page_logo">Logo</a>
            </div>
        </nav>
    </div>


    <div id="myModal" class="account_page">
        <div class="modals-container" id="both_modals">
            <div class="modal-content" id="login_modal">
                <div class="modal-top">
                    <span>
                        Please Login...
                    </span>
                </div>
                <div class="modal-body">
                    <input type="email" placeholder="Email..." class="lemail" id="lemail">
                    <input type="password" placeholder="Password..." class="lpwd" id="lpwd">
                    <input type="button" id="login-btn" class="submit account_page_submit" value="submit">
                    <p id="login-info" style="color: red"></p>
                </div>
            </div>
            <div class="modal-content2" id="signup_modal">
                <div class="modal-top2">
                    <span>
                        Please Sign up...
                    </span>
                </div>
                <div class="modal-body2">
                    <input id="name" type="text" placeholder="Your name" class="rname">
                    <p class="error-text" id = "name-empty-error" style="color: red">Please fill in your name</p>
                    <input id="uname" type="text" placeholder="Please choose username..." class="uname">
                    <p class="error-text" id="uname-empty-error" style="color: red">Please choose your username</p>
                    <p class="error-text" id = "uname-exists-error" style="color: red">Username already exists</p>
                    <input id="email" type="email" placeholder="Email..." class="remail">
                    <p class="error-text" id = "email-empty-error" style="color: red">Please fill in your email address</p>
                    <p class="error-text" id = "email-invalid-error" style="color: red">Please enter a valid email address</p>
                    <p class="error-text" id = "email-exists-error" style="color: red">Email address already exists</p>
                    <input id="pwd" type="password" placeholder="Password..." class="rpwd">
                    <p class="error-text" id = "pwd-empty-error" style="color: red">Please choose your password</p>
                    <p class="error-text" id = "pwd-length-error" style="color: red">Password must be atleast 8 characters</p>
                    <input id="signup-submit" type="submit" class="submit2 account_page_submit" value="submit">
                    <p id="signup-info" style="color: 'green"></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#signup-submit").click(function(){
                $('#name-empty-error').css('display','none');
                $('#uname-empty-error').css('display','none');
                $('#uname-exists-error').css('display','none');
                $('#pwd-empty-error').css('display','none');
                $('#pwd-length-error').css('display','none');
                $('#email-empty-error').css('display','none');
                $('#email-exists-error').css('display','none');
                $('#email-invalid-error').css('display','none');
                var name = $("#name").val();
                var uname = $("#uname").val();
                var pwd = $("#pwd").val();
                var email = $("#email").val();
                var submit = $("#signup-submit").val();
                $("#signup-info").load("includes/signup.php",{
                    name: name,
                    uname: uname,
                    pwd: pwd,
                    email: email,
                    submit: submit
                });
            });
        });
        $(document).ready(function(){
            $("#login-btn").click(function(){
                var email = $("#lemail").val();
                var pwd = $("#lpwd").val();
                var login_submit = $("#login-btn").val();
                $("#login-info").load("includes/newlogin.php",{
                    email: email,
                    pwd: pwd,
                    submit: login_submit
                });
            });
        });
    </script>
</body>
</html>