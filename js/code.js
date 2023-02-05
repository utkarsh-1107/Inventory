function _(elem){
	return document.querySelector(elem);
}
function _all(elem){
	return document.querySelectorAll(elem);
}
function ajax({url, type, callback, error, data}){
	let obj = new XMLHttpRequest();
	obj.open(type, url, true);
	if(type == "GET"){
		obj.send();
	} else if(type == "POST"){
		if(data){
			let formdata = new FormData();
			let keys = Object.keys(data);
			for(let i=0;i<keys.length;i++){
				formdata.append(keys[i], data[keys[i]]);
			}
			obj.send(formdata);
		} else {
			obj.send();
		}
	}
	loadingScreen("block");
	obj.onreadystatechange = function(){
		loadingScreen("none");
		if(obj.readyState == 4) {
			if(obj.status == 200) {
				callback(obj.responseText);
			} else {
				handleError();
				error();
			}
		}
	}
}

function handleError(){
	alert("Something went wrong");
}
function loadingScreen(status){
	//_("#global-loading-screen").style.display = status;
}
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
window.alert = function(msg){
	console.log(msg);
	swal(msg);
}