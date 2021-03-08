<?php
    if(isset($_COOKIE["login_info"])){
        $current_user = $_COOKIE["login_info"];
        include "classes/classes.php";
        $person = new Users();
        $user_info = $person->getUserInfo();
    }else{
        header("Location: http://localhost/qa/account.php");
    }
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
       
            <div class="nav-container">
            <nav>
                <div class="icon-bar">
                    <a class="nav-link" href="home.php" id="logo">Logo</a>
                    <a class="nav-link" id="active_home" href="home.php"><i class="fa fa-home"></i></a>
                    <a class="nav-link" id="active_sub" href="subscription.php"><i class='far fa-newspaper'></i></a>
                    <a class="nav-link" id="active_disc" href="spaces.php"><i class='far fa-compass'></i></a>
                    <a class="nav-link" id="active_notify" href="notifications.php"><i class='far fa-bell'></i></a>
                    <div class="profile-drop icon-a">
                        <a id="profile-icon" class="nav-link" href="#"><i class='far fa-user-circle'></i></a>
                        <div id="proflie-drop-content">
                            <a href='profile.php' id= 'profilename' class='drop-item'><?php echo $user_info["name"];?></a>
                            <a href='settings.php' class='drop-item'>Settings</a>
                            <button class='logout' id = 'logout-btn'>Log Out</button>
                        </div>
                    </div>
                    <div class="search" id="search_container">
                        <input class="search-input" id="search_qtn_input" type="text" placeholder="Search..">
                        <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                        <div id="qtn_suggest_container">
                            <div id="qtn_suggest">
                                
                            </div>
                        </div>
                    </div>
                    <button class="ask_btn" onclick="show_ask()">Ask Question</button>
                    <span id="ask_btn_mobile" onclick="show_ask()"><i class="fas fa-plus-circle" style="color: #f26c1b;font-size: 30px"></i></span>
                </div>
            </nav>
        </div>
<!--For asking-->
<div id="myModal3" class="modal3">
  <!-- Modal content -->
  <div class="modal-content3">
    <div class="modal-top3">
        <span>
            Please type your Question...
        </span>
        <span class="close-icon3" onclick="hide_ask()">
            &times;
        </span>
    </div>
    <div class="modal-body3">
        <div id="ask_info1"></div>
        <textarea id="qtn-text" placeholder="Type your Question..." class="askqtn"></textarea>
        <p id="qtn-error" style="color: red">Please type your Question</p>
        <textarea id="qtn-topics" placeholder="Enter related topic names seperated by commas..." class="kwords"></textarea>
        <input id="submit3" type="button" value="Submit Question" class="submit3">
    </div>
  </div>

</div>
<!--For Asking-->
<script>
    $(document).ready(function(){
        $("#submit3").click(function(){
            var qtn_text = $("#qtn-text").val();
            var qtn_topics = $("#qtn-topics").val();
            var submit3 = $("#submit3").val();
            $("#ask_info1").load("includes/ask.php",{
                qtn_text: qtn_text,
                qtn_topics: qtn_topics,
                submit: submit3
            });
        });
    });
    $(document).ready(function(){
        $("#logout-btn").click(function(){
            $("#logout_info").load("includes/logout.php");
        });
    });
var modal3 = document.getElementById("myModal3");
var btn3 = document.getElementById("ask");
var span3 = document.getElementsByClassName("close-icon3")[0];
function hide_ask(){
    modal3.style.display = "none";
}
</script>
<script>
    function show_ask(){
        modal3.style.display = 'block';
        document.getElementById("qtn-text").value = "";
        document.getElementById("qtn-topics").value = "";
    }
</script>


<!--For requesting answers-->
<div id="myModal4" class="modal4">
  <!-- Modal content -->
  <div class="modal-content4">
    <div class="modal-top4">
        <span>
            Search people to request...
        </span>
        <span class="close-icon4">
            &times;
        </span>
    </div>
    <div class="modal-body4">
        <input type="text" id="input_suggest" placeholder="Enter names of people to search..." class="rqst" autocomplete="off">
        <div id="suggestions_container">
            <div id="suggestions">
                
            </div>
            <div id="sugg-info">

            </div>
        </div>
    </div>
    <input type="submit" class="submit4" id="submit4" value="Finish">
  </div>
</div>
<script>
    $(document).ready(function(){
        $("#input_suggest").keyup( function(){
            var name = $("#input_suggest").val();
            $("#suggestions").load("includes/suggestions.php",{
                name: name
            });
        });
    });
    function add_rqst(to){
        var qtn_link = link_id;
        $("#sugg-info").load("includes/send_notifications.php",{
            to: to,
            type: 1, 
            link: qtn_link
        });
    }
    $(document).ready(function(){
        $("#search_qtn_input").keyup( function(){
            var qtn_text_input = $("#search_qtn_input").val();
            $("#qtn_suggest").load("includes/qtn_suggestions.php",{
                qtn_text_input: qtn_text_input
            });
        });
    });

</script>















<!--For requesting answers-->
<script>
var modal4 = document.getElementById("myModal4");
var finish = document.getElementById("submit4");
var span4 = document.getElementsByClassName("close-icon4")[0];
span4.onclick = function() {
    modal4.style.display = "none";
}
finish.onclick = function(){
    document.getElementById("input_suggest").value= "";
    document.getElementById("suggestions").innerHTML = "";
    modal4.style.display = "none";
    
}

</script>
<span id="logout_info"></span>