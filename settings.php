<?php
include "checklogin.php";

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/script3.js" defer></script>
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/settings.css">
        <link rel="stylesheet" href="fontawesome-free-5.15.2-web/css/all.css">
        <title>Home Page</title>
    </head>
    <body>
        <?php include 'nav.php'; ?>
        <div class="main-body">
            <div class="tab-list">
                
                <button class="tablinks active" onclick="opensettings(event, 'account')">Account</button>
                <button class="tablinks" onclick="opensettings(event, 'privacy')">Privacy</button>
                <button class="tablinks" onclick="opensettings(event, 'notify')">Notifications</button>
            </div>
                <!-- Tab content -->
            <div id="account" class="tabcontent default-tab">
                    <div class="ac_content">
                        <div class="email-det">
                            <h3>Your Email</h3>
                            <?php
                                $user_email = $user_info["email"];
                                echo "<input id='email_field' type='email' value='$user_email' disabled>";
                            ?>
                            
                            <a id="ch_email">change</a>
                            <input type="button" id="save1" value="save" style="display:none">
                        </div>
                        <div class="pwd-det">
                            <h3>Password</h3>
                            <a id="change_pwd">Change Password</a>
                            <input id="ch_pwd" type="text" value="Change password" disabled>
                            <input type="button" id="save2" style="display:none" value="save">
                        </div>
                    </div>
                    <div id="change_email_info">
                        
                    </div>
                    <div id="change_pwd_info">
                        
                    </div>
                
            </div>
            
            <div id="privacy" class="tabcontent">
                <div class="privacy-form">
                        <?php
                            $privacy = new Settings();
                            $privacy_details = $privacy->getPrivacy();
                        ?>

                        <div class="privacy-input">
                            <input class="check" id="check_1" type="checkbox" disabled onclick="update_privacy(1)" <?php if($privacy_details["follow_approve"]==1){echo " checked";}?> >
                            <span>Following Approval</span>
                        </div>
                        <div class="privacy-input">
                            <input class="check" id="check_2" type="checkbox" disabled onclick="update_privacy(2)" <?php if($privacy_details["indexing"]==1){echo " checked";}?> >
                            <span>Allow search engines to index your profile</span>
                        </div>
                        <div class="privacy-input">
                            <input class="check" id="check_3" type="checkbox" disabled onclick="update_privacy(3)" <?php if($privacy_details["discover"]==1){echo " checked";}?> >
                            <span>Allow your profile to be discovered by email</span>
                        </div>
                        <div>
                            <input type="button" value="Modify" class="pri-modify">
                            <input type="submit" value="Lock" class="pri-save" name="submit_privacy">
                        </div>
                        <div id="privacy_info">
                            
                        </div>
                    
                </div>
            </div>
        
            <div id="notify" class="tabcontent">
                <div class="notify-form">
                    <?php
                        $notify = new Settings();
                        $notify_details = $notify->getNotify();
                    ?>
                    <div class="notify-input">
                        <input class="ncheck" type="checkbox" id="check_4" onclick="update_notify(4)" disabled  <?php if($notify_details["oncomment"]==1){echo " checked";}?> >
                        <span>Notification on comments</span>
                    </div>
                    <div class="notify-input">
                        <input class="ncheck" type="checkbox" id="check_5" onclick="update_notify(5)" disabled <?php if($notify_details["onanswer"]==1){echo " checked";}?> >
                        <span>Notification on your questions</span>
                    </div>
                    <div class="notify-input">
                        <input class="ncheck" type="checkbox" id="check_6" onclick="update_notify(6)" disabled <?php if($notify_details["onfollowing"]==1){echo " checked";}?> >
                        <span>Notification on followings</span>
                    </div>
                    <div class="notify-input">
                        <input class="ncheck" type="checkbox" id="check_7" onclick="update_notify(7)" disabled <?php if($notify_details["onrequest"]==1){echo " checked";}?> >
                        <span>Notification on requests</span>
                    </div>
                    <div>
                        <input type="button" value="Modify" class="noty-modify">
                        <input type="button" value="Lock" class="noty-save">
                    </div>
                    <div id="notify_info">
                        
                    </div>
                </div>
            </div>            
        </div>
        <script>

            var a = document.getElementById("ch_email");
            var save1 = document.getElementById("save1");
            var b = document.getElementById("change_pwd");
            var save2 = document.getElementById("save2");
            a.onclick = function(){
                let inp = document.getElementById("email_field");
                inp.removeAttribute("disabled");
                inp.focus();
                a.style.display = "none";
                save1.style.display = "block";
            }
            save1.onclick = function(){
                var email = $("#email_field").val();
                var save_email = $("#save1").val();
                $("#change_email_info").load("includes/update.php",{
                    email: email,
                    save_email: save_email
                });
            }
            b.onclick = function(){
                
                let inp2 = document.getElementById("ch_pwd");
                inp2.style.display = "block";
                inp2.removeAttribute("disabled");
                inp2.focus();
                b.style.display = "none";
                save2.style.display = "block";
            }
            save2.onclick = function(){
                var pwd = $("#ch_pwd").val();
                var save_pwd = $("#save2").val();
                $("#change_pwd_info").load("includes/update.php",{
                    pwd: pwd,
                    save_pwd: save_pwd
                });
            }
            function update_privacy(key){
                var checkbox = document.getElementById("check_"+key);
                var val;
                if(checkbox.checked == true){
                    val = 1;
                }else{
                    val = 0;
                }
                $("#privacy_info").load("includes/update.php",{
                    key: key,
                    val: val,
                    privacy: "save"
                });
            }
            function update_notify(key){
                var checkbox = document.getElementById("check_"+key);
                var val;
                if(checkbox.checked == true){
                    val = 1;
                }else{
                    val = 0;
                }
                $("#notify_info").load("includes/update.php",{
                    key: key,
                    val: val,
                    notify: "save"
                });
            }
            var pr_mod = document.getElementsByClassName("pri-modify")[0];
            var pr_save = document.getElementsByClassName("pri-save")[0];
            var ch = document.getElementsByClassName("check");
            var l = ch.length;
            pr_mod.onclick = function(){
                for(i=0;i<l;i++){
                    ch[i].removeAttribute("disabled");
                }
                pr_mod.style.display = "none";
                pr_save.style.display = "block";
            }
            pr_save.onclick = function(){
                pr_save.style.display = "none";
                pr_mod.style.display = "block";
                for(i=0;i<l;i++){
                    ch[i].disabled = "true";
                }
            }
                   
            var noty_mod = document.getElementsByClassName("noty-modify")[0];
            var noty_save = document.getElementsByClassName("noty-save")[0];
            var nch = document.getElementsByClassName("ncheck");
            var nl = nch.length;
            noty_mod.onclick = function(){
                for(i=0;i<nl;i++){
                    nch[i].removeAttribute("disabled");
                }
                noty_mod.style.display = "none";
                noty_save.style.display = "block";
            }
            noty_save.onclick = function(){
                noty_save.style.display = "none";
                noty_mod.style.display = "block";
                for(i=0;i<nl;i++){
                    nch[i].disabled = "true";
                }
            }
        
        </script>
    </body>
</html>