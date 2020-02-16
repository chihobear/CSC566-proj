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

function login(){
	var account = $("#account").val();
	var pwd = $("#pwd").val();
	//ToDo user input check
	
	$.ajax({
		type:"POST",
		url:"",
		dataType: "json",
		data: {account: account, pwd: pwd},
		success: function(data){
			//ToDo
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
	var position = "Tucson";        //Hard code for now.
	
	$.ajax({
		type:"POST",
		url:"",
		dataType: "json",
		data: {firstName: firstName, lastName: lastName, email: email, phone: phone, userName: userName,
			   pwd: pwd, position: position},
		success: function(data){
			//ToDo
		}
	});
}
