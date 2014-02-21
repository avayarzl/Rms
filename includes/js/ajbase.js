// AJAX Base Functions

/* createXMLHttp
 * @author Prasham
 * Creates an instance of XMLHttp object
 */
function createXMLHttp() {
	if(typeof XMLHttpRequest != "undefined") {
		return new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		var aVersions = ["MSXML2.XMLHttp.5.0",
						 "MSXML2.XMLHttp.4.0",
						 "MSXML2.XMLHttp.3.0",
						 "MSXML2.XMLHttp",
						 "Microsoft.XMLHttp"];
		for(var i=0;i<aVersions.length;i++) {
			try {
				var oXMLHttp = new ActiveXObject(aVersions[i]);
				return oXMLHttp;
			} 
			catch (oError) {
				
			}
		}
		throw new Error("XMLHTTP object not supported!");
	}	
}

function getRequestBody(oForm) { 
	var aParams = new Array(); 
	for (var i=0 ; i < oForm.elements.length; i++) 
	{ 
		var sParam = encodeURIComponent(oForm.elements[i].name); 
		sParam += "="; 
		sParam += encodeURIComponent(oForm.elements[i].value); aParams.push(sParam); 
	} 
	return aParams.join("&"); 
}

sfHover = function() {     var sfEls = document.getElementById("menu_rms").getElementsByTagName("LI");     for (var i=0; i<sfEls.length; i++) {        
		 		sfEls[i].onmouseover=function() {             
					this.className+=" over";         
				}         
				sfEls[i].onmouseout=function() {             
					this.className=this.className.replace(new RegExp(" over\\b"), "");        
				 }     
			} 
		} 
		if (window.attachEvent) window.attachEvent("onload", sfHover); 