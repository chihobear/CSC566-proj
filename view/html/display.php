<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css"/>
<link href="../css/myStyle.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<div class= "main_center bottom-profile"   onclick="normal()">
		<span id="cur_location" class="pet-location" onclick="toLocation(event)">Location: </span>
		<span onclick="to_myProfile(this, 'mine')" class="float-right" style="font-size: 2rem">웃</span>
		<div class="mt-3" id = 'display-block'>
			
		</div>
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

	<div class="d-none" id="user_name"><?php echo $_SESSION['user_name']; ?></div>

<script src="../js/jquery-latest.js"></script>
<script src="../js/vue.js"></script>
<script src="../js/myScript.js"></script>
<script>Vue.config.productionTip=false</script>
<script type="text/javascript">
	$(document).ready(function(){
		myLocation();
		display_pets();
	});
</script>
</body>
</html>