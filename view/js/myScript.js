
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
var user_name_control ="";
function login(){
	var loginUsername = $("#username").val();
	user_name_control += $("#username").val();
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
			window.location.href="display.php";
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
	user_name_control = $("#userName").val();
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
	if($('#type').text() == 'sign up' || $('#type').text() == 'display_my'){
		$.ajax({
			type: "POST",
			url: "../../src/controllerMyProfile.php",
			dataType: "json",
			data: {user: user_name},
			success: function(data){
				data = data[0];
				if(data['adopter'] == 1){
					$('#role').text('adopter');
				}
				else{
					$('#role').text('sender');
				}
				$('#name').text(data['first_name'] + ' ' + data['last_name']);
				$('#contact').val(data['email']);

				var role = $('#role').text();
				if(role == "adopter"){
					$('#Favorite-block').css('display', 'block');
					myProfileAutoLoadFavorite();
				}
				else{
					$('#Pet-block').css('display', 'block');
					myProfileAutoLoadPet();
				}
			}
		});
		updateMyProfile();
	}
	else{
		$.ajax({
			type: "POST",
			url:"../../src/controllerMyProfile.php",
			dataType: "json",
			data: {user_name: user_name},
			success: function(data){
				//Roles
				data = data[0];

				$('#role').text(data['role']);

				//name
				var name = data['first'] + ' ' +  data['last'];
				$("#name").text(name);

				//email
				$("#contact").val(data['email']);

				//location
				$("#cur_location").text('Location: ' + data['location']);

				//info
				$("#person_intro").val(data['info']);

				//age
				$('#age').val(data['age']);
				var role = $('#role').text();
				if(role == "adopter"){
					$('#Favorite-block').css('display', 'block');
					myProfileAutoLoadFavorite();
				}
				else{
					$('#Pet-block').css('display', 'block');
					myProfileAutoLoadPet();
				}
	 		}
		});
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
		$('#add_image').addClass("d-none");
		store_person_myProfile();
		if($('#role').text() == 'sender'){
			submit_pet_profile();
		}
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
		$('#add_image').removeClass("d-none");
	}

}

//Store all the information into the database.
function store_person_myProfile(){
	var role = $('#role').text();
	var userName = $('#user_name').text();
	var firstName = $('#name').text().split(' ')[0];
	var lastName = $('#name').text().split(' ')[1];
	var age = $('#age').val();
	var location = $('#cur_location').text().substring(10);
	var contact = $('#contact').val();
	var person_intro = $('#person_intro').val();
	$.ajax({
		type: "POST",
		url: "../../src/controllerStorePerson.php",
		dataType: "json",
		data:{role: role, userName: userName, firstName: firstName, lastName: lastName, age: age, location: location, contact: contact, person_intro: person_intro},
		success: function(){}
	});
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


function display_pets(){
	var user = $('#user_name').text();
	$.ajax({
		type:"POST",
		url:"../../src/controllerPetInfo.php",
		dataType: "json",
		data: {user: user},
		success: function(data){
			
			if (data === undefined || data.length == 0) {
				document.body.innerHTML = "<h1>Sorry, We currently have no pets ready</h1>"
			}
			else
			{
				var tab = $("#display-block");
				var html = '';
				var size = data[0].length;
				for(i = 0;i < size;i++){
					element = data[0];
					
					str = '';
					str += '<div class="mt-2 pet-block container"><div class="row mt-2"><div class="col-3"><img onclick="to_myProfile(this, \'other\')" width="56" height="56" src="'
					str += data[1][i][0]["image"] 
					str += '"></img><div class="d-none">'+element[i]["owner"]
					var flag = true;
					for(j = 0;j < data[2].length;j++){
						if(element[i]["owner"] == data[2][j]["owner"]){
							flag = false;
						}
					}
					if(flag == true){
						str +='</div><div onclick="favorite(this)" class="mt-2" style="font-size: 2rem">♡</div></div><div class="col-9 pl-0">';
					}
					else{
						str +='</div><div onclick="favorite(this)" class="mt-2" style="font-size: 2rem">❤</div></div><div class="col-9 pl-0">';
					}
					str += '<div class="mb-2"><span>' + element[i]["name"] + '</span><hr/></div>';
					str += '<div class="mb-2"><span class="myProfile-font">' + element[i]["age"] + '</span><hr/></div>';
					str += '<div class="mb-2"><span class="myProfile-font">' + element[i]["breed"] + '    ' + element[i]["type"] + '</span><hr/></div>';
					str += '<div class="mb-2"><span class="myProfile-font">' + element[i]["gender"] + '</span><hr/></div>';
					
					if(element[i]["info"] == ''){
						str += '<div class="mb-2"><span class="myProfile-font pet-description">"My master is busy to write something here."</span></div>';
					}
					else{
						str += '<div class="mb-2"><span class="myProfile-font pet-description">' + element[i]["info"] + '</span></div>';
					}
					str += '</div></div></div>';
					
					html += str;
				}
				tab.html(html);
			}
		}
	});
}

// merged conflict here
function submit_pet_profile(){
	var petName = $("#pet-name").val();
	var petType = $("#pet-type").val();
	var petBreed = $("#pet-breed").val();
	var petAge = $("#pet-age").val();
	var petGender = $("#pet-gender").val();
	var petInfo = $("#self-introduction").text();
	var petImage = JSON.stringify(image64);
	var petOwner = $('#user_name').text();
	if(petInfo == "You will know my features when you know me"){
		petInfo = '';
	}
	$.ajax({
		type:"POST",
		url:"../../src/controllerPetSubmitProfile.php",
		dataType: "json",
		data: {petName: petName, petType: petType, petBreed: petBreed,
				petAge:petAge, petGender: petGender, petInfo: petInfo,
			   petImage: petImage, petOwner: petOwner},
		success: function(data){
		}
	});
	
	//document.getElementById("pet_form").reset();
}

function myProfileAutoLoadPet(){
	var role = $('#role').text();
	if(role == 'sender'){
		var user = $('#user_name').text();
		$.ajax({
			type:"POST",
			url:"../../src/controllerMyProfilePetLoad.php",
			dataType: "json",
			data: {user: user},
			success: function(data){
				var tab = $("#pet-images");
				var html = tab.html();
				var str = '';
				image64 = [];
				if(data[0].length != 0){
					$("#pet-name").val(data[0][0]['name']);
					$("#pet-breed").val(data[0][0]['breed']);
					$("#pet-age").val(data[0][0]['age']);
					$('#pet-type').val(data[0][0]['type']);
					$('#pet-gender').val(data[0][0]['gender']);
					if(data[0][0]['info'] != ''){
						$('#self-introduction').text(data[0][0]['info']);
					}
					for (var i = 0; i <data[0].length; i++){
						// get pet image	
						for (var j = 0; j < data[1][i].length; j++){ 
							str += '<div onmouseover="show_delete(this)" onmouseleave="hide_delete(this)" class="list-inline-item m-1 image_out" style="position:relative"><img width="56" height="56" src="' +data[1][i][j]["image"] +'"><a onclick="remove_image(this)" class="in-block-delete" align="center">--</div></img></a>';
							image64.push(data[1][i][j]["image"]);
						}

					}
					html = str + html;
					tab.html(html);	
				}
			}
		});
	}
}

function myProfileAutoLoadFavorite(){
	var role = $('#role').text();
	if(role == 'adopter'){
		var user = $('#user_name').text();
		$.ajax({
			type: 'POST',
			url: '../../src/contorllerMyProfileFavoriteLoad.php',
			dataType: 'json',
			data: {user: user},
			success: function(data){
				var user_info = data[0];
				var favorite_info = data[1]
				var tab = $('#favorite-container');
				var html = '';
				for(var i = 0;i < favorite_info.length;i++){
					html += '<div class="col-4" onclick="favorite_to_myProfile(\''+ user_info[i]["owner"] +'\')"><div class="img-thumbnail"><img style="margin:0 10px" width="56" height="56" src="' + favorite_info[i][0]["image"] + '"></img></div></div>';
				}
				tab.html(html);
			}
		});
	}
}


function upload_image(e) {
	var imgSrc = new Array();
	var fileList = e.files;
	convert_binary(e);
	
	for(var i = 0; i < fileList.length; i++) {
		var imgSize = fileList[i].size;  //b
		if(imgSize>1024*1024*1){//1M
			return alert("The size of the image cannot be larger than 1M");
		}
		if(fileList[i].type != 'image/png' && fileList[i].type != 'image/jpeg' && fileList[i].type != 'image/gif'){
			return alert("The format of the image is not correct");
		}
		imgSrc.push(getObjectURL(fileList[i]));
	}
	var tab = $('#pet-images');
	var html = tab.html();
	var s = '';
	imgSrc.forEach(e => {
		s += '<div onmouseover="show_delete(this)" onmouseleave="hide_delete(this)" class="list-inline-item m-1 image_out" style="position:relative"><img width="56" height="56" src="' + e +'"><a onclick="remove_image(this)" class="in-block-delete" align="center">--</div></img></a>';
	});
	html = s + html;
	tab.html(html);
	
}

var image64 = [];
function convert_binary(inputElement){
	var file = inputElement.files[0];
	  var reader = new FileReader();	
	  reader.onload = function() {
		image64.push(reader.result);
		
	  }
	reader.readAsDataURL(file);

}


function getObjectURL(file) {
	var url = null ;
	if (window.createObjectURL!=undefined) { // basic
		url = window.createObjectURL(file) ;
	} else if (window.URL!=undefined) { // mozilla(firefox)
		url = window.URL.createObjectURL(file) ;
	} else if (window.webkitURL!=undefined) { // webkit or chrome
		url = window.webkitURL.createObjectURL(file) ;
		 	}
	return url ;
}

function show_delete(e){
	$(e).find('.in-block-delete').attr('style', 'display: block');
}

function hide_delete(e){
	$(e).find('.in-block-delete').attr('style', 'display: none');
}

function remove_image(e){
	$(e).parent().remove();
}

function to_myProfile(e, flag){
	var username;
	if(flag == 'other'){
		username = $(e).next().text();
	}
	else{
		username = $('#user_name').text();
	}

	$.ajax({
		type:"POST",
		url:"../../src/controllerChangeSession.php",
		dataType: "json",
		data: {user: username},
		success: function(data){}
	});
	window.location.href="myProfile.php";
}

function favorite_to_myProfile(username){
	$.ajax({
		type: "POST",
		url: "../../src/controllerChangeSession.php",
		dataType: "json",
		data: {user: username},
		success: function(data){}
	});
	window.location.href="myProfile.php";
}

function favorite(e){
	var username = $('#user_name').text();
	var owner = $(e).prev().text();
	var text = $(e).text();
	if(text == '♡'){
		$(e).text('❤');
		$.ajax({
			type: "POST",
			url: "../../src/controllerFavorite.php",
			dataType: "json",
			data: {username: username, owner: owner},
			success: function(data){}
		});
	}
	else{
		$(e).text('♡');
		$.ajax({
			type: "POST",
			url: "../../src/controllerFavorite.php",
			dataType: "json",
			data: {user: username, owner: owner},
			success: function(data){}
		});
	}
}


function checkUserType(from_user){
	$.ajax({
		type:"POST",
		url:"../../src/controllerUserType.php",
		dataType: "json",
		data: { from_user : from_user },
		success: function(data){
			
			if(data[0]['adopter'] = 1){
				console.log("adopter");
				return "adopter";
			}
			else
			{
				console.log("sender");
				return "sender";
			}

		}
	});
}


function new_post(tab){
	var message = $(tab).prev().val();
	var to_user = $('#user_name').text();
	if(message != ''){
		$.ajax({
			type: 'POST',
			url: '../../src/controllerStoreChat.php',
			dataType: 'json',
			data: {to_user: to_user, message: message, parent_ID: -1},
			success: function(data){
				var ID = data[0][0]['MAX(id)'];
				var from_user = data[0][0]['from_user'];
				$(tab).prev().val('');
				var chat_tab = $('#chat_block');
				var html = chat_tab.html();
				html = '<div class="row" id="'+ from_user + ' ' + ID +'">' +
						'<div class="col-2"><img style="margin:0 10px" width="32" height="32" src="../source/2.jpg"></img></div>' + 
						'<div class="col-10"><span class="myProfile-font message">' + message 
						+ '</span><span class="myProfile-font message"> (by ' + data[1] + ' ' + data[0][0]['date'] +')</span></div></div><div class="row ml-3">'
						+ '<div class="ml-5 mr-3 w-100"><input type="text" placeholder="Say something here..." class="myProfile-font-small adjust search pl-1" style="width: 70%"></input>'
						+ '<span onclick="reply_chat(this)" class="myProfile-font-small mr-3" style="color: green;float: right;">Reply</span></div></div>'
						+'<div class="m-2"><hr/></div>'
						+ html;
				chat_tab.html(html);
			}
		});
	}
}

function reply_chat(tab){
	var message = $(tab).prev().val();
	var temp = $(tab).parent().parent().prev().attr('id').split(' ');
	var parent_ID = parseInt(temp[1]);
	var to_user = temp[0];
	if(message != ''){
		$.ajax({
			type: 'POST',
			url: '../../src/controllerStoreChat.php',
			dataType: 'json',
			data: {to_user: to_user, message: message, parent_ID: parent_ID},
			success: function(data){
				var ID = data[0][0]['MAX(id)'];
				var from_user = data[0][0]['from_user'];
				$(tab).prev().val('');
				var html = '<div class="row ml-3" id = "' + from_user + ' ' + ID + '">';
				html += '<div class="col-2"><img style="margin:0 10px" width="24" height="24" src="../source/1.jpeg"></img></div>';
				html += '<div class="col-10 pl-0"><span class="myProfile-font-small message">' + message + '</span><span class="myProfile-font message"> (by ' + data[1] + ' ' + data[0][0]['date'] +')</span>';
				html += '</div></div>';
				
				$(tab).parent().parent().before(html);			
			}
		});
	}
}


function chatLoad(){
	var username = $('#user_name').text();
	$.ajax({
		type: 'POST',
		url: '../../src/controllerLoadChat.php',
		dataType: 'json',
		data: {username: username},
		success: function(data){
			parents = retrieveParent(data);
			parents.reverse();
			var chat_tab = $('#chat_block');
			var html = chat_tab.html();
			var str = '';
			parents.forEach(e=>{
				str += '<div class="row" id="'+ e['from_user'] + ' ' + e['id'] +'">' +
						'<div class="col-2"><img style="margin:0 10px" width="32" height="32" src="../source/2.jpg"></img></div>' + 
						'<div class="col-10"><span class="myProfile-font message">' + e['message'] 
						+ '</span><span class="myProfile-font message"> (by ' + e['from_user'] + ' ' + e['date'] +')</span></div></div>';
				childrens = retrieveChildren(data, e['id']);
				children_str = '';
				childrens.forEach(e=>{
					children_str += '<div class="row ml-3" id = "' + e['from_user'] + ' ' + e['id'] + '">';
					children_str += '<div class="col-2"><img style="margin:0 10px" width="24" height="24" src="../source/1.jpeg"></img></div>';
					children_str += '<div class="col-10 pl-0"><span class="myProfile-font-small message">' + e['message'] + '</span><span class="myProfile-font message"> (by ' + e['from_user'] + ' ' + e['date'] +')</span>';
					children_str += '</div></div>';
				});

				str += children_str;

				str +=	'<div class="row ml-3"><div class="ml-5 mr-3 w-100"><input type="text" placeholder="Say something here..." class="myProfile-font-small adjust search pl-1" style="width: 70%"></input>'
						+ '<span onclick="reply_chat(this)" class="myProfile-font-small mr-3" style="color: green;float: right;">Reply</span></div></div>'
						+'<div class="m-2"><hr/></div>';
			});
			chat_tab.html(str + html);
			
		}
	});
}

function retrieveParent(data){
	var result = [];
	data.forEach(e =>{
		if(e['parent_ID'] == -1){
			result.push(e);
		}
	});
	return result;
}

function retrieveChildren(data, root_id){
	var result = [];
	var parent_id = root_id;
	while(true){
		var flag = true;
		data.forEach(e=>{
			if(e['parent_ID'] == parent_id){
				flag = false;
				parent_id = e['id'];
				result.push(e);
			}
		});
		if(flag == true){
			break;
		}
	}
	return result;
	
}


/*
function checkPasswordMatch() {
    var pwd = $("#pwd");
    var confirmPwd = $("#Rpwd");

    if (pwd.val() != confirmPwd.val()){
        pwdMatch = false;
		console.log("no");
	}
    else{
        pwdMatch = true;
		console.log("yes");
	}
}
$(document).ready(function () {
   $("#Rpwd").keyup(checkPasswordMatch);
});
*/