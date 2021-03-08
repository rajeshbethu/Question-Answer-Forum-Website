<?php
include "checklogin.php";
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/spaces.css">
        <link rel="stylesheet" href="fontawesome-free-5.15.2-web/css/all.css">
        <title>Home Page</title>
    </head>
    <body>
        <?php include 'nav.php' ?>
        <div class="main-body">
            <h1>Discover spaces</h1>
            <div class="sub">
            <span class="sub_head">Spaces you might like</span>
            <button id="create_space_btn" class="create_space_btn">Create space</button>
            </div>
            <div class="cards-container">
                <?php
                    $space_list = new Spaces();
                    echo $space_list->get();
                ?>
            </div>
        </div>
        
        
    
<div id="create-space" class="create-space">
  <!-- Modal content -->
  <div class="create-modal-content">
    <div class="create-modal-top">
        <span>
            Create new space...
        </span>
        <span class="create-close-icon">
            &times;
        </span>
    </div>
    <div class="create-modal-body">
     
        <input type="text" placeholder="Space name..." class="spname" id="spcname">
        <p class="space-error-text" id = "sname-empty-error" style="color: red">Please fill in the space name</p>
        <p class="space-error-text" id = "sname-exists-error" style="color: red">This space name already exists</p>
        <input type="text" placeholder="One line description..." class="shdesc" id="spcdesc">
        <p class="space-error-text" id = "sdesc-empty-error" style="color: red">Please fill in the short description</p>
        <textarea class="ldesc" placeholder="Detailed description..." id="longspcdesc"></textarea>
        
        <button class="create-submit" id="create_submit">submit</button>
     
    </div>
    
  </div>

</div>
<div id="create_space_info">
        
</div>
<div id="follow_space_info">
    
</div>

<script>
var create_space = document.getElementById("create-space");

var create_sp_btn = document.getElementById("create_space_btn");

var create_close = document.getElementsByClassName("create-close-icon")[0];

create_sp_btn.onclick = function() {
    create_space.style.display = "block";
}

create_close.onclick = function() {
    create_space.style.display = "none";
}
$(document).ready(function(){
    $("#create_submit").click(function(){
        $('#sname-exists-error').css('display','none');
        $('#sname-empty-error').css('display','none');
        $('#sdesc-empty-error').css('display','none');
        var sname = $("#spcname").val();
        var sdesc = $("#spcdesc").val();
        var ldesc = $("#longspcdesc").val();
        var submit = $("#create_submit").val();
        $("#create_space_info").load("includes/create_space.php",{
            sname: sname,
            sdesc: sdesc,
            ldesc: ldesc,
            submit: submit

        });
    }); 
});

function follow_space(space_name,sid){
    $("#follow_space_info").load("includes/follow_space.php",{
        space_name: space_name,
        sid: sid
    });
}


</script>

    
    
    
    
    
    </body>
</html>