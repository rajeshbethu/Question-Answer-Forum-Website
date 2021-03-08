<?php
include "checklogin.php";
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/myspace.js" defer></script>
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/myspace.css">
        <link rel="stylesheet" href="fontawesome-free-5.15.2-web/css/all.css">
        <title>Home Page</title>
    </head>
    <body>
        
        <?php
            include 'nav.php';
            $sid = $_GET["id"];
            $space_info = new Spaces();
            $space_info->getSpaceProfile();
        ?>

        <div class="main-body">
            <div class="main-container">
                <div class="cover-pic">
                    <img src="a.jpg" width="100%" height="150px" alt="">
                    <div class="mod_cover">
                        <a class="ch_cover" onclick="ch_cover()"><i class="fas fa-pencil-alt"></i></a>
                        <a class="del_cover" onclick="del_cover()"><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
                <div class="space-info">
                    <div class="space-pic">
                        <img src="mypic.jpg" width="120px" height="120px" alt="">
                        <div class="mod_dp">
                        <a class="ch_dp" onclick="ch_dp()"><i class="fas fa-pencil-alt"></i></a>
                        <a class="del_dp" onclick="del_dp()"><i class="far fa-trash-alt"></i></a>
                    </div>
                    </div>
                    <div class="space-details">
                        <div class="space-name"><span>Space Name</span></div>
                        <div class="space-desc"><span>Short description</span></div>
                        <div class="flw-count"><span>100 Followers</span></div>
                    </div>
                </div>
                <div class="space-follow">
                    <button id="space-follow" class="space-part-3">Follow</button>
                    <button id="space-more" class="space-part-3"><i class="fa fa-ellipsis-h"></i></button>
                    <button id="space-share" class="space-part-3"><i class="fa fa-share"></i></button>
                </div>
                
                
                
                <div class="tab-list">
                    <button class="tablinks active" onclick="openspacetab(event, 'qtns')">Questions</button>
                    <button class="tablinks" onclick="openspacetab(event, 'followers')">Followers</button>
                </div>
                
                <!-- Tab content -->
                
                <div id="qtns" class="tabcontent default-tab">
                    <div class="tab-count">2 Questions</div>
                    <div class="tab-top">
                        <span class="tab-qtn">Do successful candidates in the SSC CGL get a salary during their training period?</span>
                        <span class="tab-date">january 3,2020</span>
                    </div>
                    <p class="tab-answer">Be it any Central Government service, you are paid right from Day 1 of your training.

                            Talking about the salary that would be given:-

                            Basic Pay for ASO in CSS is 44,900/-
                            DA at 7% = 3143/-
                            HRA (yes it will be paid during training) at 24% = 10,776/-
                            TA = 3600
                            DA on TA = 252

                            Your total Salary = 1+2+3+4+5 = 62671.

                            Deductions:-

                            CGHS :- 650
                            CGEGIS = 60
                            NPS = 4490
                            TAX = Around 2000–3000

                            Total Deductions :- 7200

                            Net In Hand Salary = 55471/-

                            Now during training you are required to pay for your

                            Hostel Charges
                            Food
                            Bed Tea + Breakfast

                            Kindly look for the charges in the picture below (this is for Chandigarh training)
                                                            Be it any Central Government service, you are paid right from Day 1 of your training.

                            Talking about the salary that would be given:-

                            Basic Pay for ASO in CSS is 44,900/-
                            DA at 7% = 3143/-
                            HRA (yes it will be paid during training) at 24% = 10,776/-
                            TA = 3600
                            DA on TA = 252

                            Your total Salary = 1+2+3+4+5 = 62671.

                            Deductions:-

                            CGHS :- 650
                            CGEGIS = 60
                            NPS = 4490
                            TAX = Around 2000–3000

                            Total Deductions :- 7200

                            Net In Hand Salary = 55471/-

                            Now during training you are required to pay for your

                            Hostel Charges
                            Food
                            Bed Tea + Breakfast

                            Kindly look for the charges in the picture below (this is for Chandigarh training)
                        </p>
                    <ul class="footer-list">
                        <a class="footer-link" href="#"><i class="fa fa-share"></i></a>
                        <a class="footer-link" href="#"><i class="fas fa-share-alt"></i></a>
                        <a class="footer-link right" href="#" style="float: right;"><i class="fa fa-ellipsis-h"></i></a>

                    </ul>
                    <div class="tab-top">
                        <span class="tab-qtn">Do successful candidates in the SSC CGL get a salary during their training period?</span>
                        <span class="tab-date">january 3,2020</span>
                    </div>
                    <p class="tab-answer">Be it any Central Government service, you are paid right from Day 1 of your training.

                            Talking about the salary that would be given:-

                            Basic Pay for ASO in CSS is 44,900/-
                            DA at 7% = 3143/-
                            HRA (yes it will be paid during training) at 24% = 10,776/-
                            TA = 3600
                            DA on TA = 252

                            Your total Salary = 1+2+3+4+5 = 62671.

                            Deductions:-

                            CGHS :- 650
                            CGEGIS = 60
                            NPS = 4490
                            TAX = Around 2000–3000

                            Total Deductions :- 7200

                            Net In Hand Salary = 55471/-

                            Now during training you are required to pay for your

                            Hostel Charges
                            Food
                            Bed Tea + Breakfast

                            Kindly look for the charges in the picture below (this is for Chandigarh training)
                                                            Be it any Central Government service, you are paid right from Day 1 of your training.

                            Talking about the salary that would be given:-

                            Basic Pay for ASO in CSS is 44,900/-
                            DA at 7% = 3143/-
                            HRA (yes it will be paid during training) at 24% = 10,776/-
                            TA = 3600
                            DA on TA = 252

                            Your total Salary = 1+2+3+4+5 = 62671.

                            Deductions:-

                            CGHS :- 650
                            CGEGIS = 60
                            NPS = 4490
                            TAX = Around 2000–3000

                            Total Deductions :- 7200

                            Net In Hand Salary = 55471/-

                            Now during training you are required to pay for your

                            Hostel Charges
                            Food
                            Bed Tea + Breakfast

                            Kindly look for the charges in the picture below (this is for Chandigarh training)
                        </p>
                    <ul class="footer-list">
                        <a class="footer-link" href="#"><i class="fa fa-share"></i></a>
                        <a class="footer-link" href="#"><i class="fas fa-share-alt"></i></a>
                        <a class="footer-link right" href="#" style="float: right;"><i class="fa fa-ellipsis-h"></i></a>

                    </ul>
                    <div class="tab-top">
                        <span class="tab-qtn">Do successful candidates in the SSC CGL get a salary during their training period?</span>
                        <span class="tab-date">january 3,2020</span>
                    </div>
                    <p class="tab-answer">Be it any Central Government service, you are paid right from Day 1 of your training.

                            Talking about the salary that would be given:-

                            Basic Pay for ASO in CSS is 44,900/-
                            DA at 7% = 3143/-
                            HRA (yes it will be paid during training) at 24% = 10,776/-
                            TA = 3600
                            DA on TA = 252

                            Your total Salary = 1+2+3+4+5 = 62671.

                            Deductions:-

                            CGHS :- 650
                            CGEGIS = 60
                            NPS = 4490
                            TAX = Around 2000–3000

                            Total Deductions :- 7200

                            Net In Hand Salary = 55471/-

                            Now during training you are required to pay for your

                            Hostel Charges
                            Food
                            Bed Tea + Breakfast

                            Kindly look for the charges in the picture below (this is for Chandigarh training)
                                                            Be it any Central Government service, you are paid right from Day 1 of your training.

                            Talking about the salary that would be given:-

                            Basic Pay for ASO in CSS is 44,900/-
                            DA at 7% = 3143/-
                            HRA (yes it will be paid during training) at 24% = 10,776/-
                            TA = 3600
                            DA on TA = 252

                            Your total Salary = 1+2+3+4+5 = 62671.

                            Deductions:-

                            CGHS :- 650
                            CGEGIS = 60
                            NPS = 4490
                            TAX = Around 2000–3000

                            Total Deductions :- 7200

                            Net In Hand Salary = 55471/-

                            Now during training you are required to pay for your

                            Hostel Charges
                            Food
                            Bed Tea + Breakfast

                            Kindly look for the charges in the picture below (this is for Chandigarh training)
                        </p>
                    <ul class="footer-list">
                        <a class="footer-link" href="#"><i class="fa fa-share"></i></a>
                        <a class="footer-link" href="#"><i class="fas fa-share-alt"></i></a>
                        <a class="footer-link right" href="#" style="float: right;"><i class="fa fa-ellipsis-h"></i></a>

                    </ul>
                </div>
                
                <div id="followers" class="tabcontent">
                    <div class="tab-count">2 Followers</div>
                    <div class="tab-top follow-list">
                        <span class="tab-fimg"><img src="mypic.jpg" height="40px" width="40px" alt=""></span>
                        <span class="tab-fname">FullName,</span>
                        <span class="tab-fprof">profession profession</span>
                        <input class="flwbtn" type="button" value="Follow">
                    </div>
                    <div class="tab-top follow-list">
                        <span class="tab-fimg"><img src="mypic.jpg" height="40px" width="40px" alt=""></span>
                        <span class="tab-fname">FullName,</span>
                        <span class="tab-fprof">profession profession</span>
                        <input class="flwbtn" type="button" value="Follow">
                    </div>
                    <div class="tab-top follow-list">
                        <span class="tab-fimg"><img src="mypic.jpg" height="40px" width="40px" alt=""></span>
                        <span class="tab-fname">FullName,</span>
                        <span class="tab-fprof">profession profession</span>
                        <input class="flwbtn" type="button" value="Follow">
                    </div>
                </div>                
                
                
                
                
            </div>
            <div class="right-sidebar">
                <div class="details">
                    <h3>Details<span id="edit_space_details" onclick="edit_space_details()"><i class="fas fa-pencil-alt"></i></span></h3>
                    <p class="details-content">
                        hjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcd hjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcdhjdhjd jdhjhj djhjd jh djh jdh hjd dcddcdcd
                    </p>
                </div>
            </div>
        </div>
        
        <div id="esd" class="esd">
            <!-- Modal content -->
            <div class="esd_modal_content">
            <div class="esd_modal_top">
                <span>
                Please Login...
                </span>
                <span class="esd_close_icon">
                &times;
                </span>
            </div>
            <div class="esd_modal_body">
                <form>
                    <textarea class="esd_text" placeholder="Update the space details"></textarea>
                    <input type="submit" class="esd_submit" value="submit">
                </form>
            </div>
        </div>

</div>

        
        
    </body>
</html>