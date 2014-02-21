// ajax xmlhttp object creation - oXMLConn
// @author Prasham

function oXMLHttpConn() {
	var xmlhttp;
	var processComplete = false;
	try { 
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
	} catch (e) { 
		try {xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 	
		} catch (e) { 
			try {xmlhttp = new XMLHttpRequest(); }
			catch (e) { xmlhttp = false; }
		}
	}
	if(!xmlhttp) return null;
	this.method = '';
	this.url = '';
	this.vars = '';
	this.connect = function(fnCallBack) {
		if(!xmlhttp) return false;
		if(this.url == '') return false;
		processComplete = false;
		this.method = this.method.toUpperCase();
		try {
			if(this.method == "GET") {
				xmlhttp.open(this.method, this.url+"?"+this.vars,true);		
				this.vars = '';
			} else {
				xmlhttp.open(this.method,this.url,true);
				xmlhttp.setRequestHeader("Method","POST " + this.url+" HTTP/1.1");
				xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			}
			
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && !processComplete) {
					processComplete = true;
					fnCallBack(xmlhttp);	
				}
			};
			xmlhttp.send(this.vars);	
		} catch(e2) { return false; }
		return true;
	};
	return this;
}