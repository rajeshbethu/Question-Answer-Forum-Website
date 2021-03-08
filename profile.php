<?php
    include "checklogin.php";
    if (isset($_GET["id"])) {
        $profile_user = $_GET["id"];
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/script.js" defer></script>
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="fontawesome-free-5.15.2-web/css/all.css">
        <title>Profile Page</title>
    </head>
    <body>
        <?php include 'nav.php'; ?>
        <?php 
            $profile = new Users();
            
            if(isset($profile_user)){
                if($profile_user == $user_info['uid']){
                    unset($profile_user);
                }
            }
            if(isset($profile_user)){
                $other_info = $profile->getOtherUserInfo($profile_user);
                $profile_uname = $other_info["uname"];
            }else{
                $profile_info = $profile->getProfileInfo();    
            }
        ?>
        <div class="profile-main">
            <div class="profile-main-container">
                <div class="profile-top">
                    <div class="profile-pic">
                        <img class="profile-pic-img" src="mypic.jpg" height="120px" width="120px">
                        <a class="removedp"><i class="far fa-trash-alt"></i></a>
                    </div>
                    <div class="profile-name-desc">
                        <?php   
                            if(isset($profile_user)){
                                $new_obj = new FollowingOfUser();
                                $isfollowing =  $new_obj->isfollowing($profile_uname);
                                if($isfollowing){
                                    echo "<div id='profile-name-desc-header'>
                                    <h1>".$other_info['fname']."</h1>
                                    <span class='edit' id='other_follow'>Following</span>    
                                    </div>
                                    <p class='profile-bio'>".$other_info['bio']."</p>";
                                }else{
                                    echo "<div id='profile-name-desc-header'>
                                    <h1>".$other_info['fname']."</h1>
                                    <span class='edit' id='other_follow' onclick='follow_user($profile_user,\"$profile_uname\")'>Follow</span>
                                    </div>
                                    <p class='profile-bio'>".$other_info['bio']."</p>";
                                }
                            }else{
                                echo "<div id='profile-name-desc-header'>
                                <h1>".$user_info['name']."</h1>
                                <span class='edit' id='edit'>edit profile</span>    
                                </div>
                                <p class='profile-bio'>".$profile_info['bio']."</p>";
                            }
                        ?>
                    </div>
                </div>
                <div class="tab-list">
                    <button class="tablinks active" onclick="opentabcontent(event, 'answers')">Answers</button>
                    <button class="tablinks" onclick="opentabcontent(event, 'qtns')">Questions</button>
                    <button class="tablinks" onclick="opentabcontent(event, 'followers')">Followers</button>
                    <button class="tablinks" onclick="opentabcontent(event, 'following')">Following</button>
                </div>
                
                <!-- Tab content -->
                
                <div id="answers" class="tabcontent default-tab">
                    <?php
                        $answers = new Answers();
                        if(isset($profile_user)){
                            echo $answers->get($profile_user);
                        }else{
                            echo $answers->get(0);
                        }
                    ?>
                </div>

                <div id="qtns" class="tabcontent">
                    <?php
                        $qtns = new Qtns();
                        if(isset($profile_user)){
                            echo $qtns->get($profile_user);
                        }else{
                            echo $qtns->get(0);
                        }
                    ?>
                </div>

                <div id="followers" class="tabcontent">
                    <?php
                        $followers = new FollowersOfUser();
                        if(isset($profile_user)){
                            echo $followers->get($profile_user);
                        }else{
                            echo $followers->get(0);
                        }
                        
                    ?>
                    <div id="followers_info">
                        
                    </div>

                </div>
                
                <div id="following" class="tabcontent">
                    <?php
                        $followings = new FollowingOfUser();
                        if(isset($profile_user)){
                            echo $followings->get($profile_user);
                        }else{
                            echo $followings->get(0);
                        }

                    ?>
                    <div id="followings_info">
                        
                    </div>
                </div>
            </div>
            <div class="profile-right-sidebar">
                <div class="profile-info">
                    <?php 
                        if(isset($profile_user)){
                            echo "<h3><span>Profile details</span></h3>
                            <div id='toshow'>
                                <p id='toshow_edu'>".$other_info['education']."</p>
                                <p id='toshow_emp'>".$other_info['profession']."</p>
                                <p id='toshow_place'>".$other_info['place']."</p>
                            </div>";
                        }else{
                            echo "<h3><span>Profile details</span><button class='ricon' id='edit-creds'><i class='fas fa-pencil-alt'></i></button></h3>
                            <div id='toshow'>
                                <p id='toshow_edu'>".$profile_info['education']."</p>
                                <p id='toshow_emp'>".$profile_info['profession']."</p>
                                <p id='toshow_place'>".$profile_info['place']."</p>
                            </div>
                            <div id='toedit'>
                                <input type='text' placeholder='Education' id='edu' class='creds' value=".$profile_info['education']." disabled >
                                <input type='text' placeholder='Profession' id='emp' class='creds' value=".$profile_info['profession']." disabled>
                                <input type='text' placeholder='Place' id='place' class='creds' value=".$profile_info['place']." disabled>                        
                            </div>
                            <button id='save-profile' class='save'>save</button>
                            <div id='update_info'>
                                
                            </div>";
                        }
                    ?>
                </div>
                <!-- <div class="your-spaces">
                    <h3><span>Following spaces</span></h3>

                    <?php
                        // $spaces = new SpacesOfUser();
                        // echo $spaces->get();
                    ?>

                    <div id="unfollow_info"></div>
                </div> -->
                
                <?php
                    if(!isset($profile_user)){
                        echo "<div class='know-about'>
                    <h3><span>Topics You know</span></h3>
                    <div class='addtyk' style='display:flex;align-items:center'>
                        <input type='text' class='new_topic_name' id='add_topic' value='' placeholder='Add new topic'>
                    </div>
                    <div id='topic_sug_container'>
                        <div id='topic_suggestions'>
                            
                            
                        </div>
                    </div>
                    <div id='topics_list'>";
                        
                            $topics = new TopicsOfUser();
                            echo $topics->get();
                        
                    echo "</div>
                        <div id='topics_info'>
                            
                        </div>                
                    </div>";
                    }
                ?>
            </div>
        </div>
        
        <!--Edit modal-->
<script type="text/javascript">

    $(document).ready(function(){
        $("#add_topic").keyup( function(){
            var topic_typed = $("#add_topic").val();
            $("#topic_suggestions").load("includes/suggest_topic.php",{
                topic_typed: topic_typed
            });
        });
    });

    function add_topic(topic,tid){
        $("#topics_list").load("includes/add_topic.php",{
            topic:topic,
            tid:tid
        });
    }

    function follow(username,frid){
        $("#followers_info").load("includes/follow.php",{
            username:username,
            frid:frid
        });
    }
    function follow_user(profile_user,profile_uname){
        var profile_uid = profile_user;
        $("#follow_profile_info").load("includes/follow_profile.php",{
            profile_uid: profile_uid,
            profile_uname: profile_uname
        });

    }
    function unfollow_person(following,fgid,curr_uid){
        $("#following").load("includes/unfollow_person.php",{
            following:following,
            fgid:fgid,
            curr_uid: curr_uid
        });
    }

</script>
<div id="follow_profile_info">
    
</div>
        
        
<div id="editmodal" class="editmodal">
  <!-- Modal content -->
  <div class="edit-modal-content">
    <div class="edit-modal-top">
        <span>
            Change profile details
        </span>
        <span class="edit-close-icon">
            &times;
        </span>
    </div>
    <div class="edit-modal-body">    
        <input type="text" placeholder="Name..." class="edit-name" id="edit_name">
        <textarea type="password" placeholder="Describe yourself..." class="bio" id="edit_bio"></textarea>
        <span>Upload profile pic:</span><input type="file" class="file">
        <input type="button" class="edit-submit" id="submit_bio" value="submit">
    </div>
    <div id="edit_bio_info">
        
    </div>
  </div>

</div>

<script>
    
var rem_dp = document.getElementsByClassName("removedp")[0];
rem_dp.onclick = function(){
    alert("Profile photo has been removed");
}
    
// Get the modal
var edit_modal = document.getElementById("editmodal");

// Get the button that opens the modal
var edit_btn = document.getElementById("edit");

// Get the <span> element that closes the modal
var close_modal = document.getElementsByClassName("edit-close-icon")[0];

// When the user clicks the button, open the modal 
edit_btn.onclick = function() {
  edit_modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
close_modal.onclick = function() {
  edit_modal.style.display = "none";
}
</script>
            
<!--Edit modal ends--->
        
        
        
        
        
        
<script>
    $(document).ready(function(){
        $("#edit-creds").click(function(){
            $("#toshow").css("display","none");
            $("#toedit").css("display","block");
            $("#edu").removeAttr("disabled");
            $("#place").removeAttr("disabled");
            $("#emp").removeAttr("disabled");
            $("#save-profile").css("display","block");
            $("#edu").focus();
        });
        $("#save-profile").click(function(){
            var edu = $("#edu").val();
            var place = $("#place").val();
            var emp = $("#emp").val();
            var save = $("#save-profile").val();
            $("#update_info").load("includes/editprofile.php",{
                education: edu,
                profession: emp,
                place: place,
                save: save
            });           
        });
        $("#submit_bio").click(function(){
            
            var edit_name = $("#edit_name").val();
            var edit_bio = $("#edit_bio").val();
            var submit_bio = $("#submit_bio").val();
            $("#edit_bio_info").load("includes/update.php",{
                edit_name: edit_name,
                edit_bio: edit_bio,
                submit_bio: submit_bio
            });
        });
    });        
    function unfollow(fid){
        $("#unfollow_info").load("includes/unfollow.php",{
            space_id:fid
        });
    }
    function rem_topic(tid){
        $("#topics_info").load("includes/rem_topic.php",{
            topic_id:tid
        });
    }

     
            
        </script>
    </body>
</html>