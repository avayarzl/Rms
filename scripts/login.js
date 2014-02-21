// Login Scripts
// @author Prasham

$(document).ready(function() {
	$('#btn_login').click(function() {
		this.style.backgroundPosition = 'bottom';
		this.disabled = true;
		var conn = new oXMLHttpConn();
		var username = document.getElementById('username').value;
		var password = document.getElementById('password').value;
		conn.url = 'ajax.php';
		conn.method = "POST";
		conn.vars = 'f=login&username=' + username + '&password=' + password;
		conn.connect(fnLoginCheck);
		return false;
	});
	$('#btn_login').mouseover(function() {
		this.style.backgroundPosition = 'center';
	});	
	$('#btn_login').mouseout(function() {
		this.style.backgroundPosition = 'top';
	});	
});
	
var fnLoginCheck = function(oXML) {
	var xmlResponse = oXML.responseXML;
	var xmlRoot = xmlResponse.documentElement;
	var error = xmlRoot.getElementsByTagName('error');
	if(error.length > 0) {
		$('#error_panel').show();
		$('#error_panel').html('<p>' + error[0].childNodes[0].nodeValue + '</p>');
		setTimeout(function() {
		document.getElementById('btn_login').disabled = false;
		$('#btn_login').css('background-position','top'); },300);
		return;
	}
		
	var txt = xmlRoot.getElementsByTagName('text');
	$('#error_panel').show();
	$('#error_panel').css('background-color','#5fd559').css('color','#034400').css('border','1px solid #44bb3e');
	$('#error_panel').html('<p>' + txt[0].childNodes[0].nodeValue + '</p>');	
	setTimeout(function () {window.location = document.getElementById('redirect').value ;},1000);
};