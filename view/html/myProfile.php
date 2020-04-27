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
	<div class="d-none" id="type"><?php if($_SESSION['cur_user_name'] == $_SESSION['user_name'] && $_SESSION['profile_type'] == 'display'){$_SESSION['profile_type'] = 'displayMy';} echo $_SESSION['profile_type']; ?></div>
	<div class="d-none" id="user_name"><?php echo $_SESSION['cur_user_name']; ?></div>
	<div class= "main_center bottom-profile" onclick='normal()'>
		<div>
			<div class="float-left"><img class="rounded-circle" width="56" height="56" src="../source/1.jpeg"></img></div>
			<div class="float-left ml-2">
				<span class="myProfile-font strong">Hi I am <?php echo $_SESSION['user_name']?>!</span>
				<table class="myProfile-font mt-2">
					<tr>
						<td>
							<div>Role: 
								<span id="role"></span><hr/>
							</div>
						</td>
					</tr>
					<tr>
						<td><div>Name: <span id="name"></span><hr/></div></td>
					</tr>
					<tr>
						<td><div>Age: 
							<select id="age" class="not-clicked input-label">
								<option value="0" selected="true">**</option>
							</select><hr/>
						</div></td>
					</tr>
					<tr>
						<td><div> 
							<span id="cur_location" class="not-clicked" onclick="toLocation(event)">Location: </span><hr/>
						</div></td>
					</tr>
					<tr>
						<td><div>Contact: <input class="not-clicked input-label" id="contact"></input><hr/></div></td>
					</tr>
				</table>
			</div>
			<div class="float-right" style="font-size: 2rem" onclick="window.location.href = 'display.php'">→</div>
			<div class="clearfix"></div>
		</div>
		<div>
			<div class="float-left image-size">Who am I?</div>
			<div class="float-left ml-2">
				<textarea id="person_intro" class="myProfile-font not-clicked input-label" style="border:1px solid #8E8C8A; width:255px; height: 50px" placeholder="Information is stolen by aliens"></textarea>
			</div>
			<div class="clearfix"></div>
		</div>
		<!-- display pet on profile -->
		<div id="Pet-block-display"> 
		</div>
		
		<div id="Pet-block">
			<div class="mt-2 pet-block">
					<p class="mt-1 ml-1">I have a pet</p>
					<div class = "row myProfile-font ml-3 mr-3">
						<div class="col-6">Name: <input class="bg-white input-label not-clicked" type="text" id="pet-name"" style="width:50px"></input></div>
						<div class="col-6">Breed: <input class="bg-white input-label not-clicked" type="text" id="pet-breed" style="width:50px"></input></div>
						<div class="col-6">Age: 
							<select id="pet-age" style="width: 100px" class="bg-white input-label not-clicked" type="text" style="width:80px">
								<option value="0" selected="true">**</option>
							</select>
						</div>
						<div class="col-6">Type: <input class="bg-white input-label not-clicked" type="text" id="pet-type" style="width:50px"></input></div>
						<div class="col-6">Gender: 
							<select class="bg-white input-label not-clicked"  style="width:50px" id="pet-gender">
								<option value="male" selected="true">male</option>
								<option value="female">female</option>
							</select>
						</div>
					</div>
				<div class="col-6">Info: <input class="bg-white input-label" id="pet-info" type="text" style="width:100px"></input></div>
				<div class="p-2 slide" id = 'pet-images'>
					<div id="add_image" class="list-inline-item m-1 image_out d-none" style="position:relative;"><img width="56" height="56" src="../source/plus.jpeg"><input onchange="upload_image(this)" type="file" id="file" accept="image/*" id="upload"/></img></div>
				</div>
				<div class="p-2">
					<div class="textarea-adjust myProfile-font" id="self-introduction">You will know my features when you know me</div>
				</div>
			
			</div>
		</div>
		
		<div class="mt-2 favorite-block my-favorite">
			<p class="mt-1 ml-1">What is my favorite?</p>
			<div class="row p-2">
				<div class="col-4"><div class="img-thumbnail"><img style="margin:0 10px" width="56" height="56" src="../source/a.jpg"></img><div class="myProfile-font-small adjust mt-2">I have an apple that I bought yesterday</div></div></div>
				<div class="col-4"><div class="img-thumbnail"><img style="margin:0 10px" width="56" height="56" src="../source/b.jpg"></img><div class="myProfile-font-small adjust mt-2">Hello world!</div></div></div>
				<div class="col-4"><div class="img-thumbnail"><img style="margin:0 10px" width="56" height="56" src="../source/c.jpg"></img><div class="myProfile-font-small adjust mt-2">a</div></div></div>
			</div>
		</div>
		
		<!-- Owner's chat block 
		<div class="mt-2 message-block" style="display:none">
			<p class="mt-1 ml-1">You have messages here</p>
			
			<div class="row">
				<div class="col-2"><img style="margin:0 10px" width="32" height="32" src="../source/2.jpg"></img></div>
				<div class="col-10"><span class="myProfile-font message">It is cute. Can I see more pictures of your pets? When can I meet with you?</span></div>
			</div>
			<div class="ml-2"><input type="text" placeholder="Say something here..." class="myProfile-font adjust search pl-1" style="width: 70%"/><span class="myProfile-font mr-3" style="color: green;float: right">Reply</span></div>
			<div class="m-2"><hr/></div>

			<div class="row">
				<div class="col-2"><img style="margin:0 10px" width="32" height="32" src="../source/3.jpg"></img></div>
				<div class="col-10"><span class="myProfile-font message">It is cute. Can I see more pictures of your pets? When can I meet with you?</span></div>
			</div>
			<div class="ml-2"><input type="text" placeholder="Say something here..." class="myProfile-font adjust search pl-1" style="width: 70%"/><span class="myProfile-font mr-3" style="color: green;float: right">Reply</span></div>
			<div class="m-2"><hr/></div>

			<div class="row">
				<div class="col-2"><img style="margin:0 10px" width="32" height="32" src="../source/4.jpg"></img></div>
				<div class="col-10"><span class="myProfile-font message">It is cute. Can I see more pictures of your pets? When can I meet with you?</span></div>
			</div>
			<div class="ml-2"><input type="text" placeholder="Say something here..." class="myProfile-font adjust search pl-1" style="width: 70%"/><span class="myProfile-font mr-3" style="color: green;float: right">Reply</span></div>
			<div class="m-2"><hr/></div>

			<div class="row">
				<div class="col-2"><img style="margin:0 10px" width="32" height="32" src="../source/4.jpg"></img></div>
				<div class="col-10"><span class="myProfile-font message">It is cute. Can I see more pictures of your pets? When can I meet with you?</span></div>
			</div>
			<div class="ml-2"><input type="text" placeholder="Say something here..." class="myProfile-font adjust search pl-1" style="width: 70%"/><span class="myProfile-font mr-3" style="color: green;float: right">Reply</span></div>
			<div class="m-2"><hr/></div>
		</div>
		-->
		<!-- visitor's chat block 
		<div class="mt-2 message-block" id="chat_block">
			<p class="mt-1 ml-1">Leave your message</p>

			<div class="row">
				<div class="col-2"><img style="margin:0 10px" width="32" height="32" src="../source/2.jpg"></img></div>
				<div class="col-10"><span class="myProfile-font message">It is cute. Can I see more pictures of your pets? When can I meet with you?</span></div>
			</div>
			<div class="row ml-3">
				<div class="col-2"><img style="margin:0 10px" width="24" height="24" src="../source/1.jpeg"></img></div>
				<div class="col-10 pl-0"><span class="myProfile-font-small message">It is cute. Can I see more pictures of your pets? When can I meet with you?</span></div>
				<div class="ml-5 mr-3 w-100"><input type="text" placeholder="Say something here..." class="myProfile-font-small adjust search pl-1" style="width: 70%"/><span class="myProfile-font-small mr-3" style="color: green;float: right;">Reply</span></div>
			</div>
			<div class="m-2"><hr/></div>


			<div class="row">
				<div class="col-2"><img style="margin:0 10px" width="32" height="32" src="../source/2.jpg"></img></div>
				<div class="col-10"><span class="myProfile-font message">It is cute. Can I see more pictures of your pets? When can I meet with you?</span></div>
			</div>
			<div class="row ml-3">
				<div class="ml-5 mr-3 w-100"><input type="text" placeholder="Say something here..." class="myProfile-font-small adjust search pl-1" style="width: 70%"/><span class="myProfile-font-small mr-3" style="color: green;float: right;">Reply</span></div>
			</div>
			<div class="m-2"><hr/></div>


			<div class="ml-2"><input type="text" placeholder="Say something here..." class="myProfile-font adjust search pl-1" style="width: 70%"/><span class="myProfile-font mr-3" style="color: green;float: right">New Post</span></div>
			<div class="m-2"><hr/></div>

		</div>
		-->
		<div class="mt-2 message-block" id="chat_block">
		
		</div>
		
		<?php 
			if ($_SESSION['profile_type'] != 'display'){
		?>
		<div class="mt-3 myProfile-font">
			<div class="float-left pt-3">
				<input type="checkbox" name="terms">I agree with the terms.</input>
			</div>
			<div class="float-right">
				<button class="btn btn-success btn-sm" onclick="updateMyProfile()">Update</button>
			</div>
		</div>
		<?php } ?>



	</div>

	<div class="top-location w-100">
		<div class="pl-3" style="margin-top: 10px;display: inline-block;width: 70%"><input type="text" placeholder="City" class="adjust search pl-1" id="search_input"></input></div>
		<button style="display: inline-block" class="ml-2 search-btn" onclick="search()">Search</button>
		<div class="container" style="height: 420px">
			<div class="row h-100">
				<select id = "states" class="input-label mt-2 ml-3 search">
					<option value='' selected >All States</option>  
				</select>
				<div class="col-10 h-100 overflow-y-auto" id="location-container">
					
				</div>
				<div class="col-2 h-100 overflow-y-auto">
					<table class="h-100" id="letters">

					</table>
				</div>
			</div> 
		</div>
	</div>

<script src="../js/jquery-latest.js"></script>
<script src="../js/vue.js"></script>
<script src="../js/myScript.js"></script>
<script>Vue.config.productionTip=false</script>
<script type="text/javascript">
	$(document).ready(function(){
		myProfileDataLoad();
		myProfileAutoLoadPet();
		myProfile();
		myLocation();
		displayStartChat();
		displayChat();
		//document.getElementById("chat_block").style.display = "none";
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