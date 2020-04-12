
//const app = new Vue({
//	el: '#app',
//	data: {
//		product: 'Boots'
//	}
//});

//function show_data(){
//	substr = document.getElementById("substr").value
//	
//	
//	$.ajax({
//		type:"GET",
//		url: "../src/controller.php?"+"value"+"="+substr,
//		dataType: "json",
//		success: function(data){
//			str = "";
//			str += "<tr><td>";
//			str += data[0]["value"];
//			str += "</td></tr>";
//			document.getElementById("chg").innerHTML = "<h3>" +"Result"+ "</h3><table>" + str + "</td></table>" ;
//			
//			if (data[0]["value"] == ""){
//				document.getElementById("chg").innerHTML = "No matches for '"+substr +"'";
//			}
//		}
//	});
//}
var pwdMatch = false;
var folderName;

function login(){
	var loginUsername = $("#username").val();
	folderName = loginUsername;
	var loginPwd = $("#pwd").val();
	//ToDo user input check
	$.ajax({
		type:"POST",
		url:"../../src/controllerLogin.php",
		dataType: "json",
		data: {loginUsername: loginUsername, loginPwd: loginPwd},
		success: function(data){

		if (data === undefined || data.length == 0) {
				$('#alert').text('Account or password is wrong!');
		}
		else
		{
			window.location.href="myProfile.php";
			// pass data to createProfile.html page here
		}

		}
	});
}

function signup(){
	window.location.href="createProfile.php";
}

function submit_profile(){
	
	var correctPassword = false;
	var usernameNotExist = false;
	var firstName = $("#Fname").val();
	var lastName = $("#Lname").val();
	var email = $("#email").val();
	var phone = $("#phone").val();
	var userName = $("#userName").val();
	folderName = userName;
	var pwd = $("#pwd").val();
	var rpwd = $("#Rpwd").val();
	var adopter = 0;
	var sender = 0;
	if($('#Wpet').is(':checked') )
	{
		adopter = 1;
	}
	if($('#Hpet').is(':checked') )
	{
		sender = 1;
	}

	
	if(pwd != rpwd) {
		 $("#Rpwd")[0].setCustomValidity("Passwords Don't Match");
	  }
	  
	     //Hard code for now.

	$.ajax({
		type:"POST",
		url:"../../src/controllerSignUp.php",
		dataType: "json",
		data: {firstName: firstName, lastName: lastName, email: email, phone: phone, userName: userName,
			   pwd: pwd, adopter: adopter, sender: sender},
		success: function(data){
			var message ="";
			if (data.includes(1))
			{
				message += "Username already exist \n";
			}
			if (data.includes(2))
			{
				message +="Email already in use \n";
			}
			if (data.includes(3))
			{
				message +="Phone already in use \n";
			}
			if (!data.includes(0))
			{
				// print message here
				$('#alert1').innerHTML = message;
				console.log(message);
			}
			else
			{
				window.location.href = "myProfile.php";	
			}
			//window.location.href = "myProfile.php";	
		}
	});
	
	
}

function myProfileDataLoad(){
	var user_name = $('#user_name').text();
	$.ajax({
		type: "POST",
		url:"../../src/controllerMyProfile.php",
		dataType: "json",
		data: {user_name: user_name},
		success: function(data){
			//Roles
			data = data[0];
			if (data['adopter'] == '1' && data['sender'] == '1'){
				$('option[value="Adopter & Owner"]').attr('selected', true);
			}
			else if (data['adopter'] == '1' && data['sender'] == '0'){
				$('option[value="Adopter"]').attr('selected', true);
			}
			else{
				$('option[value="Owner"]').attr('selected', true);
			}

			//name
			var name = data['first_name'] + data['last_name'];
			$("#name").val(name);

			//email
			$("#contact").val(data['email']);
 		}
	});
	if($('#type').text() == 'sign up'){
		updateMyProfile();
	
	}
	else{
		
	}
}

function myProfile(){
	var obj = $("#age");
	for(var i = 1;i < 100;i++){
		obj.append(new Option(i, i));
	}

	var petAge = $("#pet-age");
	for (var i = 1;i < 11;i++){
		petAge.append(new Option(i + " years old", i));
	}
}

function updateMyProfile(){
	var btn = $(".btn-success");
	//submit
	if (btn.size() == 0){
		//Make all input label not editable
		$(".input-label").each(function(){
	    	$(this).addClass("not-clicked");
		});
		//Make the textarea block not editable
		$(".favorite-block .myProfile-font-small").each(function(){
			$(this).attr("contenteditable", "false");
		});
		$("#self-introduction").attr("contenteditable", "false");
		//Change the button
		btn = $(".btn-primary");
		btn.removeClass("btn-primary");
		btn.addClass("btn-success");
		btn.text("Update");
	}
	else{
		//Make all input label editable
		$(".not-clicked").each(function(){
	    	$(this).removeClass("not-clicked");
		});
		//Make the textarea block editable
		$(".favorite-block .myProfile-font-small").each(function(){
			$(this).attr("contenteditable", "true");
		});
		$("#self-introduction").attr("contenteditable", "true");
		//Change the button
		btn.removeClass("btn-success");
		btn.addClass("btn-primary");
		btn.text("Submit");
	}

}

function myLocation(){
	var str = '';
	var letters = $("#letters");
	for(var i = 0;i < 26;i++){
		var letter = String.fromCharCode(i + 'A'.charCodeAt());
		str += '<tr height="25px"><td onclick="search_location($(this).text())">' + letter + '</td></tr>';
	}
	letters.html(str);

	str = '';
	var states = $("#states");
	$.ajax({
		type: "POST",
		url: "../../src/controllerMyProfile.php",
		dataType: "json",
		data: {states: str},
		success: function(data){
			html_str = states.html();
			data.forEach(e =>{
				html_str += '<option value="' + e['stateName'] + '">' + e['stateName'] + '</option>';
			});
			states.html(html_str);
		}
	});
}

function search_location(str){
	var state = $("#states").val();
	$.ajax({
		type: "POST",
		url:"../../src/controllerMyProfile.php",
		dataType: "json",
		data: {location_str: str, state: state},
		success: function(data){
			console.log('hi');
			//Roles
			html_str = '';
			data.forEach(e =>{
				html_str += '<div class="mt-3" onclick="select_location_display($(this).text())">' + e['cityName'] + ', ' + e['stateName'] + '</div>';
			});
			var container = $("#location-container");
			container.html(html_str);
 		}
	});
}

function select_location_display(val){
	var bar = $("#cur_location");
	bar.text('Location: ' + val);
	normal();
}

function search(){
	var ele = $("#search_input");
	var value = ele.val();
	if(value != ('')){
		search_location(value);
	}
}

function toLocation(e){
	var location = $(".top-location");
	location.css({'display':'block'});
	var body = $("body");
//	body.css({'background-color': '#f5f5f5'});
	var profile = $(".bottom-profile");
	profile.addClass("blur-notClicked");
	e.cancelBubble = true;
}

function removeAlert(){
	$('#alert').text('');
}

function normal(){
	var location = $(".top-location");
	if(location.css('display') == 'block'){
		location.css({'display':'none'});
		var profile = $(".bottom-profile");
		profile.removeClass("blur-notClicked");
	}
}

function display(){
	$(".display").on("click",function(){
    alert("成功");
});
}

function display_pets(){
	$.ajax({
		type:"POST",
		url:"../../src/controllerPetInfo.php",
		dataType: "json",
		data: {},
		success: function(data){
			if (data === undefined || data.length == 0) {
				document.body.innerHTML = "<h1>Sorry, We currently have no pets ready</h1>"
			}
			else
			{
				document.body.innerHTML = "<div class=\"banner\">Here are All Pets ready for their new home!</div>"
				for(var key in data){
					element = data[key];
					document.body.innerHTML += "<div>";
					for(var key2 in element){
						if(key2.length<4){
							continue;
						}
						document.body.innerHTML += "<p>" + key2 + ": " + data[key][key2] + "</p>";
					}
					document.body.innerHTML += "</div>";
				}
			}
		}
	});
}

function submit_pet_profile(){
	
	console.log($("#myImage").val());
	/*
	var petName = $("#petname").val();
	var petType = $("#pettype").val();
	var petBreed = $("#breed").val();
	var petGender = $("#gender").val();
	var petInfo = $("#petinfo").val();
	var petImage ;
	var petOwner = folderName; // name of owner

	$.ajax({
		type:"POST",
		url:"../../src/controllerPetSubmitProfile.php",
		dataType: "json",
		data: {petName: petName, petType: petType, petBreed: petBreed, petGender: petGender, petInfo: petInfo,
			   petImage: petImage, petOwner: petOwner},
		success: function(data){
			console.log(data);
		}
	});
	*/
	
}

var value;
function uploadFile(inputElement) {

	var temp = document.getElementById('Pet-block-test');
  var file = inputElement.files[0];
  var reader = new FileReader();	
  reader.readAsDataURL(file);
  reader.onload = function() {
    //console.log('Encoded Base 64 File String:', reader.result);
	console.log(reader.result);
	
	//console.log(value);
	// var image1 = new Image();
	//image1.src = reader.result;
	//temp.appendChild(image1);
  }

  console.log(value);
}



function toggleUpload() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
