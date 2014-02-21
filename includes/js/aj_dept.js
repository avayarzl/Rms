// AJAX DEPARTMENT Functions

function getDeptList() {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=dept_list",true);
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			document.getElementById("dept_list").innerHTML = oXMLHttp.responseText;
		} 
	}
	
	oXMLHttp.send(null);
}