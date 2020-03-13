<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css"/>
<link href="../css/myStyle.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<div class= "main_center">
		<div class="pl-3"><input type="text" placeholder="City" class="adjust search pl-1" style="width: 70%"></input></div>
		<div class="container">
			<div class="row">
				<div class="col-10">
					<div class="mt-3">
						<div>Tucson, AZ</div>
						<div>Phoenix, AZ</div>
					</div>
				</div>
				<div class="col-2 mh-100">
					<table id="letters">

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
	});
</script>
</body>
</html>