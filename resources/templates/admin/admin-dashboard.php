<?php
session_start();

if(isset($_POST['submit'])){
	if(empty($_POST['username']) || empty($_POST['password'])){
		header("location: /admin");
	}
}else{
	//include dashbourd admin
	include 'nav.php';

	//connect to database
	$db = new db(DSN,DB_U_NAME,DB_PASS);

	/*
	 get the user name and password from login page
	 protect MySQL injection for Security purpose quote.php's functions
	*/
	$username = $_POST['username'];
	$password = $_POST['password'];
  
  //create bind array from user input for select query 
	$bind = array(
		":user" => "%$username"
	);
	$result = $db->select("users", "username LIKE :user", $bind);
	
	//if user name and password is in database 
	$get_password = regenrat_crypt($result[0]['password']);
	if(password_verify($password, $get_password)) {
	  echo "password is correct! <br/>";


		$_SESSION['login_user'] = $username;
		echo $_SESSION['login_user'];
		echo "<br/>";
		echo "You Login Success!<br/>";
		//create a list of user name and password from database
		$userlist = $db->select("users");




		// test for developing
		if(empty($result)){
			echo "result is empty: <br><pre>".print_r($result, true)."</pre>";
		}else{
			echo "result is NOT empty: <br><pre>".print_r($result, true)."</pre>";
		}
		echo $username . " " . $password . "<br><br> ";

		?>
		<div class="sub-container">
		<div class="left side-nav">
			<div>
				<ul>
					<li><a href="">User List</a></li>
					<li><a href="">Add User</a></li>
					<li><a href="">User Group</a></li>
					<li><a href="">Add Group</a></li>
					<li><a href="">User Activity</a></li>
				</ul>
			</div>
			
		</div>
		<?php if(isset($userlist)){ ?>
		<div id="tablelist" class="right side-content"> 
			<table id="users">
				<tr>
					<th class="">User Name</th>
					<th class="">User Email</th>
					<th class="">User is Active</th>
					<th class="">User Group</th>
					<th class="">Last Visit</th>
					<th class="">#</th>
				</tr>
				<?php foreach ($userlist as $rows => $row) { ?>
				<tr>
					<td class="username" ><?php echo $row['username']; ?></td>
					<td class="useremail"><?php echo $row['email']; ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="userid"><?php echo $row['id']; ?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
		</div>
		<div class="clear"></div>
		<?php 
		}
	} else {
		header("location: /admin");
	} 
}


?>