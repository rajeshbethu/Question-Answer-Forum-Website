<?php
include "checklogin.php";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/notifications.css">
        <link rel="stylesheet" href="fontawesome-free-5.15.2-web/css/all.css">
        <title>Home Page</title>
    </head>
    <body>
        <?php include 'nav.php' ?>
        <main class="body-container">
            <div class="main-container">
                <?php 
                    $notifications = new NotificationsOfUser();
                    echo $notifications->get();
                ?>
            </div>
            <div id="markas_info">
                
            </div>
        </main>
        <script>
            function markread(nid){
                var div_id = "u_note_"+nid;
                $("#markas_info").load("includes/markasread.php",{
                    nid: nid
                });
            }
        </script>
    </body>
</html>