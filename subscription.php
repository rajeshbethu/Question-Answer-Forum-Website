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
        <link rel="stylesheet" href="css/subscription.css">
        <link rel="stylesheet" href="fontawesome-free-5.15.2-web/css/all.css">
        <title>Home Page</title>
    </head>
    <body>
<?php include 'nav.php' ?>
        <main>
            <div class="left-sidebar">
                
               <div>
                    <h3 style="margin: 0; font-size: 1em;padding: 5px;">Spaces you follow</h3>
                </div>
                <?php
                    $space = new SpacesOfUser();
                    echo $space->getSpaces();
                ?>
                
            </div>
            <div class="main-container">
                <div>
                    <?php
                        $qtns = new Qtns();
                        echo $qtns->getsubqtns();
                    ?>
                </div>
            </div>
<!--
            <div class="right-sidebar">
                <a href="#home"><i class="fa fa-fw fa-home"></i> Groups</a>
                
                
            </div>
-->
            <div id="qtn_likes_info">
                
            </div>
        </main>
        <script>
            function qtnlikes(qid,action){
                var qid = qid;
                var action = action;
                $("#qtn_likes_info").load("includes/likes.php",{
                    qid: qid,
                    action: action
                });
            }
        </script>
    </body> 
</html>