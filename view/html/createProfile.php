<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css"/>
<link href="../css/myStyle.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<div class="banner">Welcome to Pet Adoption</div>
	<form  onsubmit = "submit_profile(); return false">
   	<div style="padding: 60px 10% 10% 10%" align="center">
   		<table>
	   	<tbody>
	   		<tr class="bg-white">
	   			<td>
	   				<div class="second_layer_title">Sign up now</div>
	   				<div class="third_layer_title">Fill in the form below to get instant access.</div>
				</td>
	   		</tr>
	   		<tr class="background_gray">
	   			<td>
				
	   				<div class="form_row"><input type="text" id="Fname" class="border-0 pl-1 w-100 h-100"  placeholder="First name" pattern = "[A-Z a-z]*" required ></input></div>
	   				<div class="form_row"><input type="text" id="Lname" class="border-0 pl-1 w-100 h-100" placeholder="Last name" pattern = "[A-Z a-z]*" required ></input></div>
	   				<div class="form_row"><input type="text" id="email" class="border-0 pl-1 w-100 h-100" placeholder="Email" "[A-Z a-z]*"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required ></input></div>
	   				<div class="form_row"><input type="text" id="phone" class="border-0 pl-1 w-100 h-100" placeholder="Phone (optional)" pattern = "^(\+0?1\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$" ></input></div>
	   				<div class="form_row"><input type="text" id="userName" class="border-0 pl-1 w-100 h-100" placeholder="Username" required ></input></div>
	   				<div class="form_row"><input type="password" id="pwd" class="border-0 pl-1 w-100 h-100" placeholder="Password" required ></input></div>
	   				<div class="form_row my-2"><input type="password" id="Rpwd"class="border-0 pl-1 w-100 h-100" placeholder="Retype your password"></input></div>
					<div class="myProfile-font-small" style="color: red" id ="alert"></div>
					<!--
					<div class="form_row"><input type="text" id="Fname" class="border-0 pl-1 w-100 h-100"  placeholder="First name"  ></input></div>
	   				<div class="form_row"><input type="text" id="Lname" class="border-0 pl-1 w-100 h-100" placeholder="Last name" ></input></div>
	   				<div class="form_row"><input type="text" id="email" class="border-0 pl-1 w-100 h-100" placeholder="Email" "[A-Z a-z]*"  ></input></div>
	   				<div class="form_row"><input type="text" id="phone" class="border-0 pl-1 w-100 h-100" placeholder="Phone (optional)" " ></input></div>
	   				<div class="form_row"><input type="text" id="userName" class="border-0 pl-1 w-100 h-100" placeholder="Username"  ></input></div>
	   				<div class="form_row"><input type="password" id="pwd" class="border-0 pl-1 w-100 h-100" placeholder="Password"  ></input></div>
	   				<div class="form_row my-2"><input type="password" id="Rpwd"class="border-0 pl-1 w-100 h-100" placeholder="Retype your password"></input></div>
					-->
	   			</td>
	   		</tr>
	   		<tr>
	   			<td>
	   				<div class="myProfile-font mt-2">I'm Interested in:</div>
	   				<div class="myProfile-font">
	   					<input type="checkbox" name="Wpet" id="Wpet">
	   					<label>Adopting a pet</label>
	   					<input class="ml-5" type="checkbox" name="Hpet" id="Hpet">
	   					<label>Rehoming a pet</label>
	   				</div>
	   				
	   				<!-- <div class="float-left">
	   					<button id="Hpet" class="btn btn-primary">I have a pet</button>
	   				</div>
	   				<div class="float-right">
	   					<button id="Wpet" class="btn btn-primary">I want a pet</button>
	   				</div> -->
	   			</td>
	   		</tr>
	   		<tr>
	   			<td>
	   				<div><p class="myProfile-font mb-0">By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p></div>
	   				<div><input class="btn btn-primary float-right btn-sm" type = "submit"><div class="clearfix"></div></div>
	   			</td>
	   		</tr>
	   	</tbody>
	   	</table>
   	</div>
	</form>
<script src="../js/jquery-latest.js"></script>
<script src="../js/vue.js"></script>
<script src="../js/myScript.js"></script>
<script>Vue.config.productionTip=false</script>

</body>
</html>
