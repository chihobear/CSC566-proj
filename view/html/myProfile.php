<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css"/>
<link href="../css/myStyle.css" type="text/css" rel="stylesheet"/>
</head>
<body class="m-0">
	<?php 
		if (isset($_SESSION['user_name'])){

	?>
	<div class= "main_center bottom-profile">
		<div>
			<div class="float-left"><img class="rounded-circle" width="56" height="56" src="../source/user.jpg"></img></div>
			<div class="float-left ml-2">
				<span class="myProfile-font strong">Hi I am <?php echo $_SESSION['user_name']?>!</span>
				<table class="myProfile-font mt-2">
					<tr>
						<td>
							<div>Role: 
								<select id="role" class="not-clicked input-label">
									<option value="Adopter">Adopter</option>
									<option value="Owner">Owner</option>
									<option value="Adopter & Owner">Adopter & Owner</option>
								</select><hr/>
							</div>
						</td>
					</tr>
					<tr>
						<td><div>Name: <input class="not-clicked input-label" id="name"></input><hr/></div></td>
					</tr>
					<tr>
						<td><div>Age: 
							<select id="age" class="not-clicked input-label">
								<option value="0" selected="true">**</option>
							</select><hr/>
						</div></td>
					</tr>
					<tr>
						<td><div>Location: 
							<span class="not-clicked" onclick="toLocation()">Tucson, AZ</span><hr/>
						</div></td>
					</tr>
					<tr>
						<td><div>Contact: <input class="not-clicked input-label" id="contact"></input><hr/></div></td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>
		</div>
		<div>
			<div class="float-left image-size">Who am I?</div>
			<div class="float-left ml-2">
				<textarea class="myProfile-font not-clicked input-label" style="border:1px solid #8E8C8A; width:255px; height: 50px" placeholder="Information is stolen by aliens"></textarea>
			</div>
			<div class="clearfix"></div>
		</div>
		
		<div id="Pet-block">
			<div class="mt-2 pet-block">
				<p class="mt-1 ml-1">I have a pet</p>
				<div class = "row myProfile-font ml-3 mr-3">
					<div class="col-6">Name: <input class="not-clicked bg-white input-label" value="Alice" style="width:50px"></input></div>
					<div class="col-6">Age: 
						<select id="pet-age" class="not-clicked bg-white input-label" style="width:80px">
							<option value="0" selected="true">**</option>
						</select>
					</div>
					<div class="col-6">Type: <input class="not-clicked bg-white input-label" value="Teddy" style="width:50px"></input></div>
					<div class="col-6">Gender: 
						<select class="not-clicked bg-white input-label" style="width:50px" id="pet-gender">
							<option value="male" selected="true">male</option>
							<option value="female">female</option>
						</select>
					</div>
				</div>
				<div class="p-2 row">
					<div class="col-4"><img width="56" height="56" src="../source/user.jpg"></img></div>
					<div class="col-4"><img width="56" height="56" src="../source/user.jpg"></img></div>
					<div class="col-4"><img width="56" height="56" src="../source/user.jpg"></img></div>
					<div class="clearfix"></div>
				</div>
				<div class="p-2">
					<div class="textarea-adjust myProfile-font" id="self-introduction">You will know my features when you know me</div>
				</div>
			</div>
		</div>
		
		<div class="mt-2 favorite-block my-favorite">
			<p class="mt-1 ml-1">What is my favorite?</p>
			<div class="row p-2">
				<div class="col-4"><div class="img-thumbnail"><img style="margin:0 10px" width="56" height="56" src="../source/user.jpg"></img><div class="myProfile-font-small adjust mt-2">I have an apple that I bought yesterday</div></div></div>
				<div class="col-4"><div class="img-thumbnail"><img style="margin:0 10px" width="56" height="56" src="../source/user.jpg"></img><div class="myProfile-font-small adjust mt-2">Hello world!</div></div></div>
				<div class="col-4"><div class="img-thumbnail"><img style="margin:0 10px" width="56" height="56" src="../source/user.jpg"></img><div class="myProfile-font-small adjust mt-2">a</div></div></div>
			</div>
		</div>

		<div class="mt-2 message-block">
			<p class="mt-1 ml-1">You have messages here</p>
			

		</div>

		
		<div class="mt-3 myProfile-font">
			<div class="float-left pt-3">
				<input type="checkbox" name="terms">I agree with the terms.</input>
			</div>
			<div class="float-right">
				<button class="btn btn-success btn-sm" onclick="updateMyProfile()">Update</button>
			</div>
		</div>

	</div>

	<div class="top-location w-100">
		<div class="pl-3" style="margin-top: 10px"><input type="text" placeholder="City" class="adjust search pl-1" style="width: 70%"></input></div>
		<div class="container" style="height: 420px">
			<div class="row h-100">
				<div class="col-10 h-100 overflow-y-auto">
					<div class="mt-3">Tucson, AZ</div>
					<div class="mt-3">Phoenix, AZ</div>
					<div class="mt-3">Tempe, AZ</div>
					<div class="mt-3">Taylor, AZ</div>
					<div class="mt-3">Surprise, AZ</div>
					<div class="mt-3">Tusayan, AZ</div>
					<div class="mt-3">Star Valley, AZ</div>
					<div class="mt-3">Tombstone, AZ</div>
					<div class="mt-3">Tusayan, AZ</div>
					<div class="mt-3">Welton, AZ</div>
					<div class="mt-3">Wickenburg, AZ</div>
					<div class="mt-3">Willcox, AZ</div>
					<div class="mt-3">Williams, AZ</div>
					<div class="mt-3">Winkelman, AZ</div>
					<div class="mt-3">Winslow, AZ</div>
					<div class="mt-3">Yuma, AZ</div>
				</div>
				<div class="col-2 h-100 overflow-y-auto">
					<table class="h-100" id="letters">

					</table>
				</div>
			</div> 
		</div>
	</div>


<div class="d-none" id="type"><?php echo $_SESSION['profile_type']; ?></div>
<div class="d-none" id="user_name"><?php echo $_SESSION['user_name']; ?></div>

<script src="../js/jquery-latest.js"></script>
<script src="../js/vue.js"></script>
<script src="../js/myScript.js"></script>
<script>Vue.config.productionTip=false</script>
<script type="text/javascript">
	$(document).ready(function(){
		myProfileDataLoad();
		myProfile();
		myLocation();
	});
</script>
<?php }
		else{
			?>
			<div>Invalid Access</div>
			<?php
		}
	?>
</body>
</html>