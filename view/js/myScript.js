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

function login(){
	var loginUsername = $("#username").val();
	var loginPwd = $("#pwd").val();
	//ToDo user input check
	console.log("log");
	$.ajax({
		type:"GET",
		url:"../../src/controller.php",
		dataType: "json",
		data: {loginUsername: loginUsername, loginPwd: loginPwd},
		success: function(data){
			console.log("login success");
			console.log(data);
		}
	});
}

function signup(){
	window.location.href="createProfile.html";
}

function submit_profile(){

	var firstName = $("#Fname").val();
	var lastName = $("#Lname").val();
	var email = $("#email").val();
	var phone = $("#phone").val();
	var userName = $("#userName").val();
	var pwd = $("#pwd").val();
	var rpwd = $("#Rpwd").val();
	
	alert("a");
	if(pwd != rpwd) {
		 $("#Rpwd")[0].setCustomValidity("Passwords Don't Match");
	  }
	  console.log(firstName,lastName);
	  
	     //Hard code for now.
	
	$.ajax({
		type:"POST",
		url:"../../src/controller.php",
		dataType: "json",
		data: {firstName: firstName, lastName: lastName, email: email, phone: phone, userName: userName,
			   pwd: pwd},
		success: function(data){
			//ToDo
			console.log("profile success");
		}
	});
	
	
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