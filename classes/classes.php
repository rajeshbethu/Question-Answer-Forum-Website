<?php

	class Database{
		private $servername = "localhost";
		private $username = "root";
		private $password = "qadbpwd";
		private $dbname = "qa";
		
		public function connect(){
			$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			return $conn;
		}
	}
	class Users extends Database{

		function editProfileInfo($education,$profession,$place){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uname = $info["uname"];
			$sql = "UPDATE users SET education='$education', profession='$profession',place='$place' WHERE uname='$uname'";
			if ($conn->query($sql) === TRUE) {
				$conn->close();
				return "<script>$('#toshow').css('display','block');$('#toedit').css('display','none');$('#save-profile').css('display','none');$('#toshow_edu').html('$education');
	            $('#toshow_emp').html('$profession');
	            $('#toshow_place').html('$place');
	            </script>";
			} else {
				$conn->close();
				return false;
			}
		}
		function editBio($fname,$bio){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "UPDATE users SET fname='$fname', bio='$bio' WHERE uid='$uid'";
			if ($conn->query($sql) === TRUE) {
				$conn->close();
				return "<p style='color:green'>Profile Updated</p><script> setTimeout(function () {location.reload(true);}, 300);</script>";
			} else {
				$conn->close();
				return false;
			}
		}
		function update_email($email){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "UPDATE users SET email='$email' WHERE uid='$uid'";
			if ($conn->query($sql) === TRUE) {
				$conn->close();
				return "<script>document.getElementById('save1').style.display = 'none';
	                document.getElementById('ch_email').style.display = 'block';
	                document.getElementById('email_field').disabled = true;</script>";
			} else {
				$conn->close();
				return false;
			}
		}
		function update_pwd($pwd){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "UPDATE users SET pwd='$pwd' WHERE uid='$uid'";
			if ($conn->query($sql) === TRUE) {
				$conn->close();
				return "<script>document.getElementById('save2').style.display = 'none';
	            document.getElementById('change_pwd').style.display = 'block';
	            document.getElementById('ch_pwd').style.display = 'none';</script>";
			} else {
				$conn->close();
				return false;
			}
		}
		function login($email,$pwd){
			$conn = $this->connect();
			$sql = "select * from users";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$db_email = $row["email"];
					$db_pwd = $row["pwd"];
					if(strcmp($email,$db_email)==0 && strcmp($pwd,$db_pwd)==0){
						$uname = $row["uname"];
						setcookie("login_info", $uname, time()+60*60*24*30, "/");
						$conn->close();
						return "<script>$('#login-info').css('color','green');$('#login-info').html('login success');setTimeout(function () {location.reload(true);}, 200);  </script>";
					}
				}
				$conn->close();
				return "<script>$('#login-info').html('email or password is incorrect');</script>";
			}
			$conn->close();
		}
		function set($name, $uname, $email, $pwd){
			$sql = "INSERT INTO `users` (`fname`, `uname`, `email`, `pwd`) VALUES ('$name', '$uname', '$email', '$pwd');";
			$conn = $this->connect();
			if ($conn->query($sql) === TRUE) {
				$last_uid = $conn->insert_id;
				
				$sqlnots = "CREATE TABLE notifications_of_".$last_uid."(nid int NOT NULL AUTO_INCREMENT, who_sent int(255), type int(255), link  int(255), marked_read int(1), PRIMARY KEY(nid))";
				$sqlflwr = "CREATE TABLE followers_of_".$last_uid."(frid int NOT NULL AUTO_INCREMENT, followers varchar(50), PRIMARY KEY(frid))";
				$sqlflng = "CREATE TABLE followings_of_".$last_uid."(fgid int NOT NULL AUTO_INCREMENT, people_following varchar(50), PRIMARY KEY(fgid))";
				$sqlspcs = "CREATE TABLE spaces_of_".$last_uid."(sid int NOT NULL AUTO_INCREMENT, spaces_following varchar(50), PRIMARY KEY(sid))";
				$sqltpcs = "CREATE TABLE topics_of_".$last_uid."(tid int NOT NULL AUTO_INCREMENT, topics varchar(50), PRIMARY KEY(tid))";
				$sqlsettings = "INSERT INTO `settings` (`uid`, `oncomment`, `onanswer`, `onfollowing`, `onrequest`, `follow_approve`, `indexing`, `discover`) VALUES ('$last_uid', '1', '1', '1', '1', '1', '1', '1');";
				if ($conn->query($sqlnots) === TRUE && $conn->query($sqlflwr) === TRUE && $conn->query($sqlflng) === TRUE && $conn->query($sqlspcs) === TRUE && $conn->query($sqltpcs) === TRUE && $conn->query($sqlsettings) === TRUE){
					setcookie("login_info", $uname, time()+60*60*24*30, "/");
					$conn->close();
					return "<script>$('#signup-info').html('Account has been created successfully');  setTimeout(function () {location.reload(true);}, 300);  </script>";
				}
			} else {
				$conn->close();
				return "Error: " . $sqlins . "<br>" . $conn->error;
			}
		}
		function getUserInfo(){
			$current_user = $_COOKIE["login_info"];
			$conn = $this->connect();
			$sql = "select uid,uname,fname,email from users where uname='$current_user'";
			$result = $conn->query($sql);
			if($result->num_rows==1){
				while($row = $result->fetch_assoc()){
					$name = $row["fname"];
					$uname = $row["uname"];
					$uid = $row["uid"];
					$email = $row["email"];
					$info_array = array("name"=>$name,"email"=>$email,"uname"=>$uname,"uid"=>$uid);
					return $info_array;
					$conn->close();
				}
			}
			$conn->close();
		}
		function getProfileInfo(){
			$current_user = $_COOKIE["login_info"];
			$conn = $this->connect();
			$sql = "select education,profession,place,bio from users where uname='$current_user'";
			$result = $conn->query($sql);
			if($result->num_rows==1){
				while($row = $result->fetch_assoc()){
					$education = $row["education"];
					$profession = $row["profession"];
					$place = $row["place"];
					$bio = $row["bio"];
					$profile_info = array("education"=>$education,"profession"=>$profession,"place"=>$place,"bio"=>$bio);
					return $profile_info;
					$conn->close();
				}
			}
			$conn->close();
		}
		function getOtherUserInfo($uid){
			$current_user = $uid;
			$conn = $this->connect();
			$sql = "select uid,uname,fname,email,education,profession,place,bio from users where uid=$current_user";
			$result = $conn->query($sql);
			if($result){
				$row = $result->fetch_assoc();
				$uid = $row["uid"];
				$fname = $row["fname"];
				$uname = $row["uname"];
				$email = $row["email"];
				$education = $row["education"];
				$profession = $row["profession"];
				$place = $row["place"];
				$bio = $row["bio"];
				$info_array = array("uid"=>$uid,"fname"=>$fname,"uname"=>$uname,"email"=>$email,"education"=>$education,"profession"=>$profession,"place"=>$place,"bio"=>$bio);
				return $info_array;
				$conn->close();
			}
			$conn->close();
		}
		function isUnameExists($uname){
			$sql = "select uname from users";
			$conn = $this->connect();
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$myname = $row['uname'];
					if(strcmp($myname,$uname)==0){
						$conn->close();
						return "<script> $('#uname-exists-error').css('display','block'); </script>";
					}
				}
			}
			$conn->close();
		}
		function isEmailExists($email){
			$sql = "select email from users";
			$conn = $this->connect();
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$myemail = $row['email'];
					if(strcmp($myemail,$email)==0){
						$conn->close();
						return "<script> $('#email-exists-error').css('display','block'); </script>";
					}
				}
			}
			$conn->close();
		}
	}
	class Spaces extends Database{
		function set($sname, $sdesc, $ldesc){
			$sql = "INSERT INTO `spaces` (`sname`, `sdesc`, `ldesc`) VALUES ('$sname', '$sdesc', '$ldesc');";
			$conn = $this->connect();
			if ($conn->query($sql) === TRUE) {
				$last_sid = $conn->insert_id;
				$table_name = "followers_of_spc_".$last_sid;
				$sql2 = "CREATE TABLE $table_name(fid int NOT NULL AUTO_INCREMENT, uid int(255), PRIMARY KEY(fid))";
				if ($conn->query($sql2) === TRUE) {
					return "<script>$('#create-space').css('display','none');window.location.href = 'http://localhost/qa/home.php';</script>";
				}else{
					return "failed here";
				}
			}else{
				return "failed here 2";
			}
		}
		function isFollowing($sname){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "spaces_of_".$uid;
			$sql = "select * from $table";
			$result = $conn->query($sql);
			$check = false;
			
			while($row = $result->fetch_assoc()){
				$space = $row['spaces_following'];
				if(strcmp($space, $sname) == 0){
					$check = true;
					return $check;
				}
			}
			return $check;
		}
		function get(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select * from spaces";
			$result = $conn->query($sql);
	        if($result->num_rows>0){
	        	$return_content = "";
	        	while($row = $result->fetch_assoc()){
	        		$sid = $row['sid'];
	                $sname = $row['sname'];
	                $sdesc = $row['sdesc'];
	                $return_content .= "<div class='card-main'>
	                   <div class='cover-pic'>
	                       <img src='a.jpg' alt='' width='100%' height='100%'>
	                   </div>
	                   <div class='profile-pic'>
	                       <img src='mypic.jpg' alt=''>
	                   </div>
	                   <div class='space-name'>
	                       <a href='space.php'>$sname</a>
	                   </div>
	                   <div class='space-desc'><span>$sdesc</span></div>";
	                if($this->isFollowing($sname)){
	                	$return_content .= "<div class='folow-box'><button class='follow-btn following_sp' id ='follow_btn_$sid'>Following</button></div>
			                </div>";
	                }else{
				    	$return_content .= "<div class='folow-box'><button class='follow-btn' id ='follow_btn_$sid' onclick=\"follow_space('$sname',$sid)\">Follow</button></div>
			                </div>";
	                }
	                
	                
	            }
	            $conn->close();
	            return $return_content;
	        }
	        $conn->close();
		}
		function isSpaceExists($sname){
			$sql = "select sname from spaces";
			$conn = $this->connect();
			$result = $conn->query($sql);
			if($result){
				while($row = $result->fetch_assoc()){
					$dbsname = $row['sname'];
					if(strcmp($dbsname,$sname)==0){
						$conn->close();
						return "<script> $('#sname-exists-error').css('display','block'); </script>";
					}
				}
			}
			$conn->close();
			
		}
		function getSpaceProfile(){

		}
	}
	class SpacesOfUser extends Database{

		function set($sname,$sid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$spaces_of_user = "spaces_of_".$uid;
			$followers_of_space = "followers_of_spc_".$sid;
			$return_content = "";
			$sql = "INSERT INTO `$spaces_of_user` (`spaces_following`) VALUES ('$sname');";
			$sql2 = "INSERT INTO `$followers_of_space` (`uid`) VALUES ('$uid');";
			if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
				return "<script>$('#follow_btn_$sid').html('Following');$('#follow_btn_$sid').removeAttr('onclick');</script>";
			}else{
				
			}
		}

		function get(){
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select * from spaces_of_$uid";
			$conn = $this->connect();
	        $result = $conn->query($sql);
	        if($result->num_rows>0){
	        	$spaces = "";
	        	while($row = $result->fetch_assoc()){
	        		$sid = $row['sid'];
	                $space = $row['spaces_following'];
	                $spaces = $spaces."<div class='rsp' id = 'rsp_$sid'>
	                    <a href='space.php?id=$sid' class='following_space'>$space</a>
	                    <button class = 'unfollow' onclick = 'unfollow($sid)'>Unfollow</button>
	                </div>";
	            }
	            $conn->close();
	            return $spaces;
	        }
	        $conn->close();
		}

		function getSpaces(){
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select * from spaces_of_$uid";
			$conn = $this->connect();
	        $result = $conn->query($sql);
	        if($result->num_rows>0){
	        	$spaces = "";
	        	while($row = $result->fetch_assoc()){
	        		$sid = $row['sid'];
	                $space = $row['spaces_following'];
	                $spaces = $spaces."<a href='space.php?id=$sid&name=$space'>$space</a>";
	            }
	            $conn->close();
	            return $spaces;
	        }
	        $conn->close();
		}

		function remove($sid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "DELETE FROM spaces_of_$uid WHERE sid=$sid";
			if ($conn->query($sql) === TRUE) {
				$conn->close();
				return "<script>$('#rsp_$sid').css('display','none');</script>";
			} else {
				$conn->close();
				return "Error deleting record: " . $conn->error;
			}
			$conn->close();
		}
	}
	class TopicsOfUser extends Database{

		function isexists($topic){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "topics_of_$uid";
			$sql = "select * from $table";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					if(strcmp($topic, $row["topics"])==0){
						return true;
					}
				}
			}
		}

		function set($topic,$tid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "topics_of_$uid";
			$sql = "INSERT INTO `$table` (`topics`) VALUES ('$topic');";
			if ($conn->query($sql) === TRUE) {
				echo "<script>$('#topic_$tid').html('added');$('#topic_$tid').removeAttr('onclick');</script>";
				return $this->get();
			}
		}
		function get(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select * from topics_of_$uid";
			$result = $conn->query($sql);
	        if($result->num_rows>0){
	        	$topics_list = "";
	        	while($row = $result->fetch_assoc()){
	        		$tid = $row['tid'];
	                $topics = $row['topics'];
	                $topics_list = $topics_list."<div class='tyk' id = 'tyk_$tid'>
	                    <a class='topics'>$topics</a>
	                    <button class = 'rem_topic' onclick = 'rem_topic($tid)'>Remove</button>
	                </div>";
	            }
	            $conn->close();
	            return $topics_list;
	        }
	        $conn->close();
		}
		function getTopicsOfUser(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select * from topics_of_$uid";
			$result = $conn->query($sql);
			$topics = array();
			
			if($result){
				while($row = $result->fetch_assoc()){
					// $tid = $row['tid'];
	                $next_topic = $row['topics'];
	                array_push($topics,$next_topic);
				}
				return $topics;
			}
			return false;
		}
		function remove($tid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "DELETE FROM topics_of_$uid WHERE tid=$tid";
			if ($conn->query($sql) === TRUE) {
				$conn->close();
				return "<script>$('#tyk_$tid').css('display','none');</script>";
			} else {
				$conn->close();
				return "Error deleting record: " . $conn->error;
			}
			$conn->close();
		}
	}
	class FollowersOfUser extends Database{
		function isfollowingback($followers){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select * from followings_of_$uid";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$db_followers = $row["people_following"];
					if(strcmp($followers, $db_followers)==0){
						return true;
					}
				}
			}
		}
		function set(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
		}
		function get($curr_uid){
			$conn = $this->connect();
			if($curr_uid == 0){
				$user = new Users();
				$info = $user->getUserInfo();
				$uid = $info["uid"];
			}else{
				$uid = $curr_uid;
			}			
			$sql = "select * from followers_of_$uid";
			$result = $conn->query($sql);
	        $return_content = "";
	        if($result->num_rows > 0){
	        	while($row = $result->fetch_assoc()){
	        		$followers = $row["followers"];
	        		$frid = $row["frid"];
	        		$sql2 = "select uid,uname,fname, profession from users where uname='$followers'";
	        		$result2 = $conn->query($sql2);
	        		$obj = new FollowersOfUser();
	        		$isfollowingback = $obj->isfollowingback($followers);
	        		$row2 = $result2->fetch_assoc();
	        		$this_uid = $row2["uid"];
	        		$uname = $row2["uname"];
	    			$fname = $row2["fname"];
	    			$profession = $row2["profession"];
	    			$return_content .= "<div class='tab-top follow-list' id='follower_$frid'>
		                <span class='tab-fimg'><img src='mypic.jpg' height='25px' width='25px' alt=''></span>
		                <span class='tab-fname'><a href='profile.php?id=$this_uid' class='proflie_page_link'>$fname</a>,</span>
		                <span class='tab-fprof'>$profession</span>";
	        		if($curr_uid == 0){
	        			if($isfollowingback){
		        			$return_content .= "<input class='flwbtn' id ='flwbtn_$frid' type='button' value='Following'>";
		        		}else{
		        			$return_content .= "<input class='flwbtn' id ='flwbtn_$frid' type='button' value='Follow back' onclick=\"follow('$uname',$frid)\">";
		        		}
	        		}
		        		
	    			$return_content .= "</div>";
	            }
	            $conn->close();
	            return "<div class='tab-count'>$result->num_rows Followers</div>".$return_content;
	        }
	        $conn->close();
		}
	}
	class FollowingOfUser extends Database{

		function set($uname,$frid){ //this person is being followed, When you follow someone through tabs in profile page.
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];//uid is following uname
			$table = "followings_of_$uid";
			$sql2 = "select uid,uname from users where uname='$uname'";
			$result = $conn->query($sql2);
			$row = $result->fetch_assoc();
			$uid2 = $row2["uid"];
			$uname2 = $row2["uname"];
			$table2 = "followers_of_$uid2";
			$sql = "INSERT INTO `$table` (`people_following`) VALUES ('$uname');";
			$sql3 = "INSERT INTO `$table2` (`followers`) VALUES ('$uname2');";
			if ($conn->query($sql) === TRUE && $conn->query($sql3) === TRUE) {
				return "<script>$('#flwbtn_$frid').val('Following');$('#flwbtn_$frid').removeAttr('onclick');</script>";
			}
		}
		function addFollowing($profile_uid,$profile_uname){ //called when you start following someone from their profile page
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$uname = $info["uname"];
			$table1 = "followings_of_$uid";
			$table2 = "followers_of_$profile_uid";
			$sql1 = "INSERT INTO `$table1` (`people_following`) VALUES ('$profile_uname');";
			$sql2 = "INSERT INTO `$table2` (`followers`) VALUES ('$uname');";
			if($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE){
				return "<script>$('#other_follow').html('Following');$('#other_follow').removeAttr('onclick');</script>";
			}
		}
		function isfollowing($profile_uname){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$uname = $info["uname"];
			$sql = "select * from followings_of_$uid";
			$result = $conn->query($sql);

			while ($row = $result->fetch_assoc()) {
				$following = $row["people_following"];
				if(strcmp($following, $profile_uname) == 0){
					return true;
				}				
			}
			return false;
		}
		function get($curr_uid){
			$conn = $this->connect();
			if($curr_uid == 0){
				$user = new Users();
				$info = $user->getUserInfo();
				$uid = $info["uid"];
			}else{
				$uid = $curr_uid;
			}			
			$sql = "select * from followings_of_$uid";
			$result = $conn->query($sql);
	        $return_content = "";
	        if($result->num_rows>0){
	        	while($row = $result->fetch_assoc()){
	        		$following = $row["people_following"];
	        		$fgid = $row["fgid"];
	        		$sql2 = "select uid, fname, profession from users where uname='$following'";
	        		$result2 = $conn->query($sql2);
					$row2 = $result2->fetch_assoc();
	    			$this_uid = $row2["uid"];
	    			$fname = $row2["fname"];
	    			$profession = $row2["profession"];
	    			$return_content .= "<div class='tab-top follow-list' id='follow-list_$fgid'>
	                    <span class='tab-fimg'><img src='mypic.jpg' height='25px' width='25px' alt=''></span>
	                    <span class='tab-fname'><a href='profile.php?id=$this_uid' class='proflie_page_link'>$fname</a>,</span>
	                    <span class='tab-fprof'>$profession</span>";
	                if($curr_uid == 0){
	                	$return_content .= "<input class='flgbtn' type='button' value='Unfollow' onclick=\"unfollow_person('$following',$fgid,$this_uid)\">";
	                }
	                $return_content .= "</div>";
	            }
	            $conn->close();
	            return "<div class='tab-count'>Following $result->num_rows persons</div>".$return_content;
	        }
	        $conn->close();
		}
		function unfollow($following,$fgid,$curr_uid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$uname = $info["uname"];
			$return_content = "";
			$sql = "DELETE FROM followings_of_$uid WHERE fgid=$fgid";
			$sql2 = "DELETE FROM followers_of_$curr_uid WHERE followers='$uname'";
			if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
				$return_content = "<script>$('#follow-list_$fgid').css('display','none');</script>";
			} else {
				return "Error deleting record: " . $conn->error;
			}
			return $return_content.$this->get($curr_uid);
		}
	}
	class NotificationsOfUser extends Database{

		function set($to,$type,$link){

			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$from = $info["uid"];
			$table_name = "notifications_of_".$to;
			$sql = "INSERT INTO `$table_name` (`who_sent`, `type`, `link`,`marked_read`) VALUES ('$from','$type','$link',0);";
			if ($conn->query($sql) === true){
				$conn->close();
				return "<script> document.getElementById('icon_$to').classList.remove('fa-plus-circle');document.getElementById('icon_$to').classList.add('fa-check-circle');</script>";

			}
		}
		function get(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$curr_uid = $info["uid"];
			$table_name = "notifications_of_".$curr_uid;
			$sql = "select * from $table_name";
			$result = $conn->query($sql);
			$return_content = "";
			if($result){
				while($row = $result->fetch_assoc()){
					$from_uid = $row["who_sent"];
					$nid = $row["nid"];
					$type = $row["type"];
					$link_id = $row["link"];
					$marked_read = $row["marked_read"];
					$sql2 = "select fname from users where uid=$from_uid";
					$result2 = $conn->query($sql2);
					$row2 = $result2->fetch_assoc();
					$from_fname = $row2["fname"];
					if($type == 1){
						$title = "$from_fname Requested you to answer his Question";
						$link = "qtn.php?id=$link_id";
						$link_text = "click here to visit the page";
						if($marked_read == 1){
							$return_content .= "<div class='note-item' id='u_note_$nid' style='background:#fff'>
						                    <p class='note-title'>$title<span class='markas'></span></p>
						                    <p class='note-link'><a href='$link'>$link_text</a></p>
						                </div>";
						}else{
							$return_content .= "<div class='note-item' id='u_note_$nid'>
						                    <p class='note-title'>$title<span class='markas'><a onclick='markread($nid);' id='markas_$nid'>mark as read</a></span></p>
						                    <p class='note-link'><a href='$link'>$link_text</a></p>
						                </div>";
						}
					}elseif ($type == 2) {
						$title = "$from_fname Answered your Question";
						$link = "qtn.php?id=$link_id";
						$link_text = "click here to visit the page";
						if($marked_read == 1){
							$return_content .= "<div class='note-item' id='u_note_$nid' style='background:#fff'>
						                    <p class='note-title'>$title<span class='markas'></span></p>
						                    <p class='note-link'><a href='$link'>$link_text</a></p>
						                </div>";
						}else{
							$return_content .= "<div class='note-item' id='u_note_$nid'>
						                    <p class='note-title'>$title<span class='markas'><a onclick='markread($nid);' id='markas_$nid'>mark as read</a></span></p>
						                    <p class='note-link'><a href='$link'>$link_text</a></p>
						                </div>";
						}
					}
				}
				return $return_content;
			}
		}
		function markAsRead($nid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$curr_uid = $info["uid"];
			$table_name = "notifications_of_".$curr_uid;
			$sql = "update $table_name set marked_read='1' where nid=$nid";
			$result = $conn->query($sql);
			if ($result) {
				return "<script>$('#u_note_$nid').css('background','#fff');
                $('#markas_$nid').css('display','none');</script>";
			}
		}	
	}
	class Qtns extends Database{

		function countOfQtns(){
			$conn = $this->connect();
			$sql = "SELECT max(qid) AS total_qtns FROM qtns;";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$total_qtns = $row["total_qtns"];
			return $total_qtns;
		}
		function ask($qtn_text,$date,$qtn_topics){
			
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$q_topics = explode("," , $qtn_topics);
			$t_length = count($q_topics);
			
			$sql = "INSERT INTO `qtns` (`uid`, `qtn_text`, `date`) VALUES ('$uid', '$qtn_text', '$date');";
			if ($conn->query($sql) === true) {
				$last_qid = $conn->insert_id;
				
				$sql3 = "CREATE TABLE topics_qtnid_".$last_qid."(tid int NOT NULL AUTO_INCREMENT, topics varchar(50), PRIMARY KEY (tid))";
				$sql4 = "create table likes_of_qtn_".$last_qid."(lid int not null AUTO_INCREMENT, users_liked varchar(50),PRIMARY KEY (lid));";
					$topics_table = "topics_qtnid_".$last_qid;
					if ($conn->query($sql3) === true && $conn->query($sql4)){
						for( $i=0; $i<$t_length; $i++){
							
							$sql4 = "INSERT INTO `$topics_table` (`topics`) VALUES ('$q_topics[$i]');";
							$conn->query($sql4);
							
							if ($i == $t_length-1){
								$conn->close();
								return "<script>modal3.style.display = 'none'; modal4.style.display = 'block';document.getElementById('input_suggest').value = '';var link_id=$last_qid;</script>";
							}
						}
					}
				// }
			}
			$conn->close();
		}
		function get($curr_uid){
			$conn = $this->connect();
			if($curr_uid == 0){
				$user = new Users();
				$info = $user->getUserInfo();
				$uid = $info["uid"];
			}else{
				$uid = $curr_uid;
			}
			$sql = "select * from qtns where uid=$uid";
			$return_content = "";
			$result = $conn->query($sql);
	        if($result->num_rows>0){
	        	while($row = $result->fetch_assoc()){
	        		$qtn_text = $row['qtn_text'];
	        		$date = $row['date'];
	        		$qid = $row['qid'];
	                $return_content .= "
	                    <div class='tab-top'>
	                        <span class='tab-qtn'><a href='qtn.php?id=$qid' class='qtn_text_link'>$qtn_text</a></span>
	                        <span class='tab-date'>$date</span>
	                    </div>
	                    <ul class='footer-list'>
	                        <a class='footer-link' href='#'><i class='fa fa-share'></i></a>
	                        
	                    </ul>";//<a class='footer-link' href='#'><i class='fas fa-share-alt'></i></a>
	                        //<a class='footer-link' href='#' style='float: right;'><i class='fa fa-ellipsis-h'></i></a>
	            }
	            $qtn_count = $result->num_rows;
	            $conn->close();
	            return "<div class='tab-count'>$qtn_count Questions</div>".$return_content;
	        }
		}
		function getqtns(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$curr_uid = $info["uid"];
			$sql = "select * from qtns";
			$return_content = "";
			$result = $conn->query($sql);
	        if($result){
	        	while($row = $result->fetch_assoc()){
	        		$checklikes = new Qtn_Likes();
	                $uid = $row["uid"];
	        		$qid = $row["qid"];
	        		$qtn_text = $row['qtn_text'];
	        		$date = $row['date'];
	        		$likes = $checklikes->countLikes($qid);
	        		$ans_text = "";
	        		$sql2 = "select uid,fname,profession from users where uid=$uid";
	        		$result2 = $conn->query($sql2);
	        		if($result2->num_rows==1){
	        			$row2 = $result2->fetch_assoc();
	        			$qtn_uid = $row2["uid"];
	        			$fname = $row2["fname"];
	        			$profession = $row2["profession"];
	        		}else{
	        			$fname = "Anonnymous";
	        			$profession = "Not known";
	        		}
	        		$sql3 = "select ans_text from answers where qid=$qid limit 1";
	        		$result3 = $conn->query($sql3);
	        		if($result3->num_rows == 1){
	        			$row3 = $result3->fetch_assoc();
	        			$ans_text = $row3["ans_text"];
	        		}

	                $return_content .= "<div class='qbox' id='qbox_$qid'>
	                        <div class='qtop'><!--  part 1        -->
	                            <p class='top-text'>Recommended</p>
	                            <button class='qclose' onclick='close_qtn($qid)'><i class='fa fa-times'></i></button>
	                        </div>
	                        <div class='qauther'><!--  part 2        -->
	                            <img class='auther-img' src='mypic.jpg' height='40px' width='40px'>
	                            <div class='prf'>
	                                <p><a href='profile.php?id=$qtn_uid' class ='proflie_link'><span class='prf-name'>$fname</span></a>&nbsp;<span class='date'>$date</span></p>
	                                <p class='prf-prof'>
	                                    $profession
	                                </p>
	                            </div>
	                        </div>
	                        <div class='qbody'> <!--  part 3        -->
	                            <h4><a href='qtn.php?id=$qid' style='padding:0px;color:inherit'>$qtn_text</a></h4>
	                            <p>$ans_text</p>
	                        </div>
	                        <div class='qfooter'><!-- part 4        -->
	                            <ul class='footer-list'>";
	                            if($checklikes->isliked($qid)){
	                               	$return_content .= "<a class='footer-link liked' id='like_btn_$qid' onclick='qtnlikes($qid,0)'><i class='far fa-thumbs-up'></i>$likes</a>";
	                            }else{
	                               	$return_content .= "<a class='footer-link' id='like_btn_$qid' onclick=qtnlikes($qid,1)><i class='far fa-thumbs-up'></i>$likes</a>";
	                            }
	                $return_content .= "<a class='footer-link' href='#' onclick='shareqtn($qid)' ><i class='fa fa-share'></i></a>
	                                
	                            </ul>
	                        </div>
	                    </div>";//<a class='footer-link' href='#'><i class='fas fa-share-alt'></i></a>
	            }
	            $conn->close();
	            return $return_content;
	        }
		}
		function getsubqtns(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$curr_uid = $info["uid"];
			$user_qtns = $this->getsubqids();
			$count_user_qtns = count($user_qtns);
			$return_content = "";
			for($i = 0; $i < $count_user_qtns; $i++){
				$user_qid = $user_qtns[$i];
				$sql = "select * from qtns where qid=$user_qid";
				$result = $conn->query($sql);
		        if($result){
		        	while($row = $result->fetch_assoc()){
		        		$checklikes = new Qtn_Likes();
		                $uid = $row["uid"];
		        		$qid = $row["qid"];
		        		$qtn_text = $row['qtn_text'];
		        		$date = $row['date'];
		        		$likes = $checklikes->countLikes($qid);
		        		$ans_text = "";
		        		$sql2 = "select uid,fname,profession from users where uid=$uid";
		        		$result2 = $conn->query($sql2);
		        		if($result2->num_rows==1){
		        			$row2 = $result2->fetch_assoc();
		        			$qtn_uid = $row2["uid"];
		        			$fname = $row2["fname"];
		        			$profession = $row2["profession"];
		        		}else{
		        			$fname = "Anonnymous";
		        			$profession = "Not known";
		        		}
		        		$sql3 = "select ans_text from answers where qid=$qid limit 1";
		        		$result3 = $conn->query($sql3);
		        		if($result3->num_rows == 1){
		        			$row3 = $result3->fetch_assoc();
		        			$ans_text = $row3["ans_text"];
		        		}

		                $return_content .= "<div class='qbox' id='qbox_$qid'>
		                        <div class='qtop'><!--  part 1        -->
		                            <p class='top-text'>Recommended</p>
		                            <button class='qclose' onclick='close_qtn($qid)'><i class='fa fa-times'></i></button>
		                        </div>
		                        <div class='qauther'><!--  part 2        -->
		                            <img class='auther-img' src='mypic.jpg' height='40px' width='40px'>
		                            <div class='prf'>
		                                <p><a href='profile.php?id=$qtn_uid' class ='proflie_link'><span class='prf-name'>$fname</span></a>&nbsp;<span class='date'>$date</span></p>
		                                <p class='prf-prof'>
		                                    $profession
		                                </p>
		                            </div>
		                        </div>
		                        <div class='qbody'> <!--  part 3        -->
		                            <h4><a href='qtn.php?id=$qid' style='padding:0px;color:inherit'>$qtn_text</a></h4>
		                            <p>$ans_text</p>
		                        </div>
		                        <div class='qfooter'><!-- part 4        -->
		                            <ul class='footer-list'>";
		                            if($checklikes->isliked($qid)){
		                               	$return_content .= "<a class='footer-link liked' id='like_btn_$qid' onclick='qtnlikes($qid,0)'><i class='far fa-thumbs-up'></i>$likes</a>";
		                            }else{
		                               	$return_content .= "<a class='footer-link' id='like_btn_$qid' onclick=qtnlikes($qid,1)><i class='far fa-thumbs-up'></i>$likes</a>";
		                            }
		                $return_content .= "<a class='footer-link' href='#'><i class='fa fa-share'></i></a>
		                                
		                            </ul>
		                        </div>
		                    </div>";//<a class='footer-link' href='#'><i class='fas fa-share-alt'></i></a>
		            }
		        }
			}
			$conn->close();
            return $return_content;
		}
		function getsubqids(){
			$conn = $this->connect();
			$user = new Users();
			$user_info = $user->getUserInfo();
			$uid = $user_info["uid"];
			$topics_obj = new TopicsOfUser();
			$user_topics_list = $topics_obj->getTopicsOfUser();
			$user_topics_length = count($user_topics_list);
			$qtns_count = $this->countOfQtns();
			$i=0;
			$final_qtns = array();
			while($i<$user_topics_length){
				$user_topic = $user_topics_list[$i];
				for($j = 1; $j <= $qtns_count; $j++){
					$table = "topics_qtnid_$j";
					$sql = "select * from $table";
					$result = $conn->query($sql);
					if($result){
						while($row = $result->fetch_assoc()){
							$qtn_topic = $row["topics"];
							if(strcmp($qtn_topic, $user_topic)==0){
								array_push($final_qtns, $j);
							}
						}
					}
				}
				$i++;
			}
			return $final_qtns;
		}
		function getAllAns($qid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select * from qtns where qid=$qid";
			$return_content = "";
			$result = $conn->query($sql);
	        if($result->num_rows == 1){
	        	$row = $result->fetch_assoc();
	        	$qtn_text = $row["qtn_text"];
	        	$quid = $row["uid"];
	        	$qdate = $row["date"];
	        	$sql2 = "select fname, profession from users where uid=$quid";
	        	$result2 = $conn->query($sql2);
	        	$row2 = $result2->fetch_assoc();
	        	$qfname = $row2["fname"];
	        	$qprof = $row2["profession"];
	        	$return_content .= "<div class='qauther'><!--  part 2        -->
	                            <img class='auther-img' src='mypic.jpg' height='40px' width='40px'>
	                            <div class='prf'>
	                                <p><span class='prf-name'><a href='profile.php?id=$quid' class='proflie_link'>$qfname</a></span>&nbsp;<span class='date'>$qdate</span></p>
	                                <p class='prf-prof'>$qprof</p>
	                            </div>
	                        </div>
	                        <div class='qbody'> <!--  part 3        -->
	                            <h4>$qtn_text</h4>
	                            <div class='qfooter-list'>
	                                <a id='answer-btn' class='qfooter-link' href='#''><span>Answer</span></a>
	                                <a class='qfooter-link' href='#''><span>Share</span></a>
	                            </div>";

	        	$sql3 = "select * from answers where qid=$qid";
	        	$result3 = $conn->query($sql3);
	        	while($row3 = $result3->fetch_assoc()){
	        		$aid = $row3["aid"];
	        		$ans_text = $row3["ans_text"];
	        		$auid = $row3["uid"];
	        		$adate = $row3["date"];
	        		$checklikes = new Ans_Likes();
	        		$likes = $checklikes->countLikes($aid);
		        	$dislikes = $checklikes->countDisLikes($aid);
	        		$sql4 = "select fname, profession from users where uid=$auid";
		        	$result4 = $conn->query($sql4);
		        	$row4 = $result4->fetch_assoc();
		        	$afname = $row4["fname"];
		        	$aprof = $row4["profession"];
		        	
		        	$return_content .= "<div class='abody'>
	                                <div class='a-auther'><!--  part 2        -->
	                                    <img class='a-auther-img' src='mypic.jpg' height='30px' width='30px'>
	                                    <div class='a-prf'>
	                                        <p><span class='a-prf-name'><a href='profile.php?id=$auid' class='proflie_link'>$afname</a></span>&nbsp;<span class='a-date'>$adate</span></p>
	                                        <p class='a-prf-prof'>$aprof</p>
	                                    </div>
	                                </div>
	                               <p>$ans_text</p>
	                                <div class='afooter'><!-- part 4        -->
	                                    <ul class='afooter-list'>";
	                                    if($checklikes->isliked($aid)){
	                                    	$return_content .= "<a class='afooter-link liked' id='like_btn_$aid' onclick='anslikes($aid,0,1)'><i class='far fa-thumbs-up'></i>$likes</a>";
	                                    }else{
	                                    	$return_content .= "<a class='afooter-link' id='like_btn_$aid' onclick='anslikes($aid,1,1)'><i class='far fa-thumbs-up'></i>$likes</a>";
	                                    }
	                                    if($checklikes->isdisliked($aid)){
	                                    	$return_content .= "<a class='afooter-link disliked' id='dislike_btn_$aid' onclick='anslikes($aid,0,0)'><i class='far fa-thumbs-down'></i>$dislikes</a>";
	                                    }else{
	                                    	$return_content .= "<a class='afooter-link' id='dislike_btn_$aid' onclick='anslikes($aid,1,0)'><i class='far fa-thumbs-down'></i>$dislikes</a>";
	                                    }
	                                        
	                                        
	                $return_content .= "<a class='afooter-link'><i class='fa fa-share'></i></a>
	                                        <a class='afooter-link cmnt-btn'><i class='far fa-comment-alt'></i></a>
	                                    </ul>
	                                </div>
	                                <div class='comments'>
	                                    <div class='level_1_input'>
	                                        <input type='text' class='input_1' value='' placeholder='Type your comment..'>
	                                        <button class='submit_1'>Submit</button>
	                                    </div>
	                                    <div class='level_1_output'>
	                                        
	                                    </div>
	                                </div>
	                            </div>";
	        	}
	            $conn->close();
	            return $return_content."</div>";
	        }
		}
	}
	class TopicsOfQtn extends Database{

		function set(){

		}
		function get(){
			
		}
	}
	class Answers extends Database{

		function set($answer_text,$qid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$date = date("j, F Y");
			$sql = "INSERT INTO `answers` (`qid`, `uid`, `ans_text`, `date`) VALUES ('$qid', '$uid', '$answer_text', '$date');";
			if ($conn->query($sql) === TRUE) {
				$last_aid = $conn->insert_id;
				$sqllikes = "CREATE TABLE likes_of_".$last_aid."(lid int NOT NULL AUTO_INCREMENT, uid int(255), PRIMARY KEY(lid))";
				$sqldislikes = "CREATE TABLE dislikes_of_".$last_aid."(did int NOT NULL AUTO_INCREMENT, uid int(255), PRIMARY KEY(did))";
				if ($conn->query($sqllikes) === TRUE && $conn->query($sqldislikes) === TRUE){
					$conn->close();
					return "<script>$('#ans_success_info').css('color','green');$('#ans_success_info').html('Your Answer submitted successfully');setTimeout(function () {location.reload(true);}, 200);</script>";

				}
			}
		}

		function get($curr_uid){
			$conn = $this->connect();
			if($curr_uid == 0){
				$user = new Users();
				$info = $user->getUserInfo();
				$uid = $info["uid"];
			}else{
				$uid = $curr_uid;
			}
			$sql = "select * from answers where uid=$uid";
			$return_content = "";
			$result = $conn->query($sql);
	        if($result->num_rows>0){
	        	while($row = $result->fetch_assoc()){
	        		
	        		$aid = $row['aid'];
	        		$qid = $row['qid'];
					$uid = $row['uid'];
					$ans_text = $row['ans_text'];
					$date =$row['date'];
	                $sqlqtn = "select qid,qtn_text from qtns where qid=$qid";
	                $resultqtn = $conn->query($sqlqtn);
	                if($resultqtn->num_rows == 1){
	                	$rowqtn = $resultqtn->fetch_assoc();
		                $this_qid = $rowqtn["qid"];
		                $qtn_text = $rowqtn["qtn_text"];
	                	$return_content .= "<div class='tab-top'>
	                        <span class='tab-qtn'><a href='qtn.php?id=$this_qid' class='qtn_text_link'>$qtn_text</a></span>
	                        <span class='tab-date'>$date</span>
	                    </div>
	                    <p class='tab-answer'>$ans_text</p>
	                    <ul class='footer-list'>
	                        <a class='footer-link' href='#'><i class='fa fa-share'></i></a>
	                        
	                    </ul>";//<a class='footer-link' href='#'><i class='fas fa-share-alt'></i></a>
	                        //<a class='footer-link right' href='#' style='float: right;'><i class='fa fa-ellipsis-h'></i></a>
	                }else{
		       	     	echo "wrong here";
		            }

	            }
	            $ans_count = $result->num_rows;
	            $conn->close();
	            return "<div class='tab-count'>$ans_count Answers</div>".$return_content;
	        }
		}
	}
	class AllTopics extends Database{

		function set(){
			
		}
		function get(){

		}
	}
	class Settings extends Database{
		function getPrivacy(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select follow_approve, indexing, discover from settings where uid=$uid";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			return $row;
		}
		function updatePrivacy($key,$val){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			if($key == 1){
				$column = "follow_approve";
			}
			if($key == 2) {
				$column = "indexing";
			}
			if($key == 3){
				$column = "discover";
			}
			$sql = "UPDATE settings SET $column='$val' WHERE uid='$uid'";
			if ($conn->query($sql) === TRUE){
				$conn->close();
				return "<p style='color:green' id='changes_saved_info'>Changes saved</p><script> setTimeout(function () {\$('#changes_saved_info').css('display', 'none');}, 1000);</script>";
			}
		}
		function getNotify(){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$sql = "select oncomment, onanswer, onfollowing, onrequest from settings where uid=$uid";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			return $row;
		}
		function updateNotify($key,$val){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			if($key == 4){
				$column = "oncomment";
			}
			if($key == 5) {
				$column = "onanswer";
			}
			if($key == 6){
				$column = "onfollowing";
			}
			if($key == 7){
				$column = "onrequest";
			}
			$sql = "UPDATE settings SET $column='$val' WHERE uid='$uid'";
			if ($conn->query($sql) === TRUE){
				$conn->close();
				return "<p style='color:green' id='changes_saved_info2'>Changes saved</p><script> setTimeout(function () {\$('#changes_saved_info2').css('display', 'none');}, 1000);</script>";
			}
		}
	}
	class Qtn_Likes extends Database{
		function countLikes($qid){
			$conn = $this->connect();
			$sql = "SELECT COUNT(users_liked) AS likes FROM likes_of_qtn_$qid;";
			$result = $conn->query($sql);
			if($result){
				$row = $result->fetch_assoc();
				$count = $row["likes"];
				return $count;
			}
			
		}
		function addLike($qid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "likes_of_qtn_".$qid;
			$sql = "INSERT INTO `$table` (`users_liked`) VALUES ('$uid');";
			
			if($conn->query($sql)===TRUE){
				$new_count = $this->countLikes($qid);
				return "<script> $('#like_btn_$qid').addClass('liked');
				$('#like_btn_$qid').attr('onclick','qtnlikes($qid,0)');
				$('#like_btn_$qid').html('<i class=\'far fa-thumbs-up\'></i>$new_count');</script>";
			}
		}
		function removeLike($qid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "likes_of_qtn_".$qid;
			$sql = "delete from $table where users_liked=$uid";
			if($conn->query($sql)===TRUE){
				$new_count = $this->countLikes($qid);
				return "<script> $('#like_btn_$qid').removeClass('liked');
				$('#like_btn_$qid').attr('onclick','qtnlikes($qid,1)');
				$('#like_btn_$qid').html('<i class=\'far fa-thumbs-up\'></i>$new_count');</script>";
			}
		}
		function isliked($qid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$curr_uid = $info["uid"];
			$sql = "select * from likes_of_qtn_".$qid;
			$result = $conn->query($sql);
			if($result){
				while($row = $result->fetch_assoc()){
					$uid = $row["users_liked"];
					if($uid == $curr_uid){
						return true;
					}
				}
			}		
			return false;
		}
	}
	class Ans_Likes extends Database{
		function countLikes($aid){
			$conn = $this->connect();
			$sql = "SELECT COUNT(uid) AS likes FROM likes_of_$aid;";
			$result = $conn->query($sql);
			if($result){
				$row = $result->fetch_assoc();
				$count = $row["likes"];
				return $count;
			}
			
		}
		function countDisLikes($aid){
			$conn = $this->connect();
			$sql = "SELECT COUNT(uid) AS dislikes FROM dislikes_of_$aid;";
			$result = $conn->query($sql);
			if($result){
				$row = $result->fetch_assoc();
				$count = $row["dislikes"];
				return $count;
			}
		}
		function addLike($aid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "likes_of_".$aid;
			$sql = "INSERT INTO `$table` (`uid`) VALUES ('$uid');";
			if($conn->query($sql)===TRUE){
				$new_count = $this->countLikes($aid);
				return "<script>$('#like_btn_$aid').addClass('liked');
				$('#like_btn_$aid').attr('onclick','anslikes($aid,0,1)');
				$('#like_btn_$aid').html('<i class=\'far fa-thumbs-up\'></i>$new_count');</script>";
			}
		}
		function removeLike($aid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "likes_of_".$aid;
			$sql = "delete from $table where uid=$uid";
			if($conn->query($sql)===TRUE){
				$new_count = $this->countLikes($aid);
				return "<script> $('#like_btn_$aid').removeClass('liked');
				$('#like_btn_$aid').attr('onclick','anslikes($aid,1,1)');
				$('#like_btn_$aid').html('<i class=\'far fa-thumbs-up\'></i>$new_count');</script>";
			}
		}
		function addDislike($aid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "dislikes_of_".$aid;
			$sql = "INSERT INTO `$table` (`uid`) VALUES ('$uid');";
			if($conn->query($sql)===TRUE){
				$new_count = $this->countDisLikes($aid);
				return "<script>$('#dislike_btn_$aid').addClass('disliked');
				$('#dislike_btn_$aid').attr('onclick','anslikes($aid,0,0)');
				$('#dislike_btn_$aid').html('<i class=\'far fa-thumbs-down\'></i>$new_count');</script>";
			}
		}
		function removeDislike($aid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$uid = $info["uid"];
			$table = "dislikes_of_".$aid;
			$sql = "delete from $table where uid=$uid";
			if($conn->query($sql)===TRUE){
				$new_count = $this->countLikes($aid);
				return "<script> $('#dislike_btn_$aid').removeClass('disliked');
				$('#dislike_btn_$aid').attr('onclick','anslikes($aid,1,0)');
				$('#dislike_btn_$aid').html('<i class=\'far fa-thumbs-down\'></i>$new_count');</script>";
			}
		}
		function isliked($aid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$curr_uid = $info["uid"];
			$sql = "select * from likes_of_".$aid;
			$result = $conn->query($sql);
			if($result){
				while($row = $result->fetch_assoc()){
					$uid = $row["uid"];
					if($uid == $curr_uid){
						return true;
					}
				}
			}
			return false;
		}
		function isdisliked($aid){
			$conn = $this->connect();
			$user = new Users();
			$info = $user->getUserInfo();
			$curr_uid = $info["uid"];
			$sql = "select * from dislikes_of_".$aid;
			$result = $conn->query($sql);
			if($result){
				while($row = $result->fetch_assoc()){
					$uid = $row["uid"];
					if($uid == $curr_uid){
						return true;
					}
				}
			}
			return false;
		}
	}

?>