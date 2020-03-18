<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css"/>
<link href="../css/myStyle.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<div class= "main_center bottom-profile">
		<span class="pet-location" onclick="toLocation()">Location: Tucson</span>
		<div class="mt-3"  onclick="normal()">
			<div class="mt-2 pet-block container">
				<div class="row mt-2">
					<div class="col-3"><img width="56" height="56" src="../source/a.jpg"></img></div>
					<div class="col-9 pl-0">
						<div class="mb-2"><span>Alice</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">2 years old</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">Teddy</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">male</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font pet-description">“Are you looking for a friend? Well so am I! Someone to walk on the beach with? Me too! How about a cuddle on the couch and someone who will listen and not judge you? So am I! We have so much in common I’m sure we could even be BFF! I’m not looking for just anyone. Someone who will appreciate my protective nature (no door bells needed!)! I’m not only a little cutie with my curled tail and big brown eyes, I have substance and intelligence! I have learned the basics like sit, down and would love to continue learning new things.</span></div>
					</div>
				</div>
			</div>

			<div class="mt-2 pet-block container">
				<div class="row mt-2">
					<div class="col-3"><img width="56" height="56" src="../source/b.jpg"></img></div>
					<div class="col-9 pl-0">
						<div class="mb-2"><span>Ted</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">1 years old</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">Teddy</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">female</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font pet-description">"My master is busy to write something here."</span></div>
					</div>
				</div>
			</div>

			<div class="mt-2 pet-block container">
				<div class="row mt-2">
					<div class="col-3"><img width="56" height="56" src="../source/c.jpg"></img></div>
					<div class="col-9 pl-0">
						<div class="mb-2"><span>Jetty</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">1 years old</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">Bull/Mix</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font">female</span><hr/></div>
						<div class="mb-2"><span class="myProfile-font pet-description">"My master is busy to write something here."</span></div>
					</div>
				</div>
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

<script src="../js/jquery-latest.js"></script>
<script src="../js/vue.js"></script>
<script src="../js/myScript.js"></script>
<script>Vue.config.productionTip=false</script>
<script type="text/javascript">
	$(document).ready(function(){
		myLocation();
		display();
	});
</script>
</body>
</html>