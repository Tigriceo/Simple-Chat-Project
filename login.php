<?php 
SESSION_START();
include('header.php');
$loginError = '';
if (!empty($_POST['username']) && !empty($_POST['pwd'])) {
	include('Chat.php');
	$chat = new Chat();
	$user = $chat->loginUsers($_POST['username'], $_POST['pwd']);	
	if(!empty($user)) {
		$_SESSION['username'] = $user[0]['username'];
		$_SESSION['userid'] = $user[0]['userid'];
		$chat->updateUserOnline($user[0]['userid'], 1);
		$lastInsertId = $chat->insertUserLoginDetails($user[0]['userid']);
		$_SESSION['login_details_id'] = $lastInsertId;
		header("Location:index.php");
	} else {
		$loginError = "Invalid username or password!";
	}
}

?>
<title>Simple Chat Test Project</title>
<div class="container">		
	<h1>Simple Chat Project</h1>
	<div class="row">
		<div class="col-sm-4">
			<h4>Регистрация:</h4>
			<form method="post">
				<div class="form-group">
				<?php if ($loginError ) { ?>
					<div class="alert alert-warning"><?php echo $loginError; ?></div>
				<?php } ?>
				</div>
				<div class="form-group">
					<label for="username">User:</label>
					<input type="username" class="form-control" name="username" required>
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" name="pwd" required>
				</div>  
				<button type="submit" name="login" class="btn btn-info">Login</button>
			</form>
			<br>
            <h4>Пробные аккаунты</h4>
			<p><b>User</b> : Petro<br><b>Password</b> : 1234</p>
			<p><b>User</b> : Ivan <br><b>Password</b> : 1234</p>
			<p><b>User</b> : Vasya<br><b>Password</b>: 1234</p>
		</div>

	</div>
</div>	
<?php ?>






