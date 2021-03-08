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
        <link rel="stylesheet" href="css/qtn.css">
        <link rel="stylesheet" href="fontawesome-free-5.15.2-web/css/all.css">
        <title>Home Page</title>
    </head>
    <body>
        <?php include 'nav.php' ?>
    <main>
            <div class="main-container">
                <div>
                    <div class="qbox">
                        <div class="qtop"><!--  part 1        -->
                            <p class='top-text'>All answers</p>
                        </div>
                        <?php
                            $qid = $_GET["id"];
                            $allans = new Qtns();
                            echo $allans->getAllAns($qid);
                        ?>
                    </div>
                </div>
            </div>
            <div class="right-sidebar">
                <h3>Related Questions</h3>
                <a class="relatedqtns" href="#home">Do successful candidates in the SSC CGL get a salary during their training period?</a>
                <a class="relatedqtns" href="#home">Do successful candidates in the SSC CGL get a salary during their training period?</a>
                <a class="relatedqtns" href="#home">Do successful candidates in the SSC CGL get a salary during their training period?</a>
                <a class="relatedqtns" href="#home">Do successful candidates in the SSC CGL get a salary during their training period?</a>
                <a class="relatedqtns" href="#home">Do successful candidates in the SSC CGL get a salary during their training period?</a>
                <a class="relatedqtns" href="#home">Do successful candidates in the SSC CGL get a salary during their training period?</a>
                <a class="relatedqtns" href="#home">Do successful candidates in the SSC CGL get a salary during their training period?</a>
            </div>
        </main>
    <!--For requesting answers-->
<div id="a-modal" class="a-modal">
  <!-- Modal content -->
  <div class="a-modal-content">
    <div class="a-modal-top">
        <span>
            Please type your answer...
        </span>
        <span class="a-close-icon">
            &times;
        </span>
    </div>
    <div class="a-modal-body">
        
            <textarea class="answer-text" id="answer-text" placeholder="Please type your answer..."></textarea>
            <p id="answer-empty-error" style="color: red;">Please enter your answer...</p>
            <button class="a-submit" id="a-submit">submit</button>
            <span id="ans_success_info"></span>
        
    </div>
  </div>

</div>
<div id="a_info">
    
</div>
<div id="ans_notify_info">
    
</div>
<div id="ans_likes_info">
    
</div>

<script>
    $(document).ready(function(){
        $("#a-submit").click(function(){
            $("#answer-empty-error").css("display","none");
            var answer_text = $(".answer-text").val();
            var submit = $("#a-submit").val();
            var qid = <?php echo $qid; ?>;
            $("#a_info").load("includes/answer.php",{
                answer_text: answer_text,
                qid: qid,
                submit: submit
            });
            $("#ans_notify_info").load("includes/send_notifications.php",{
                link: qid,
                type: 2,
                to: 0
            });
        });
    });
    function anslikes(aid,action,btn){
        
        var aid = aid;
        var action = action;
        var btn = btn;
        $("#ans_likes_info").load("includes/ans_likes.php",{
            aid: aid,
            action: action,
            btn: btn
        });
    }
</script>


<script>
var amodal = document.getElementById("a-modal");

var abtn = document.getElementById("answer-btn");

var aspan = document.getElementsByClassName("a-close-icon")[0];

abtn.onclick = function() {
    amodal.style.display = "block";
}

aspan.onclick = function() {
  amodal.style.display = "none";
}
</script>









<script>
    var btn = document.getElementsByClassName("cmnt-btn")[0];
        btn.onclick = function(){
            document.getElementsByClassName("comments")[0].style.display = "block";
            document.getElementsByClassName("level_1_input")[0].style.display = "block";
        }
        var sub_1 = document.getElementsByClassName("submit_1")[0];
        sub_1.onclick = function(){
            var value = document.getElementsByClassName("input_1")[0].value;
            if (value == "") {
                alert("Comment field is empty");
                return;
            }else{
                let div1 = document.createElement("DIV");
                div1.classList.add("after_submit");
                var level_1 = document.getElementsByClassName("level_1_output")[0];
                level_1.insertBefore(div1, level_1.childNodes[0]);
                
                
                
                let input = document.createElement("INPUT");
                input.classList.add("cmnt-text");
                input.disabled = "true";
                document.getElementsByClassName("after_submit")[0].appendChild(input);
                
                
                let div2 = document.createElement("DIV");
                div2.classList.add("below-level-1");
                document.getElementsByClassName("after_submit")[0].appendChild(div2);
                
                div2.innerHTML = "<a class='level_1_tools'>reply</a><a class='level_1_tools'>123<i class='far fa-thumbs-up'></i></a><a class='level_1_tools'>54<i class='far fa-thumbs-down'></i></a>";
                
                
                input.value = value;
                document.getElementsByClassName("after_submit")[0].style.display = "block";
                document.getElementsByClassName("input_1")[0].value = "";
                
                
            }
        }
        </script>
    </body>
</html>