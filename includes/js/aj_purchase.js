// ADD PUrchase  Functions

function getMeasurementCode(item_id) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=item&getMeasurement=true&item_id="+item_id,true);
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			document.forms[0].scale.value = oXMLHttp.responseText;
		} 
	}
	
	oXMLHttp.send(null);
}

function fillM(list) {
	getMeasurementCode(list.options[list.selectedIndex].value);
}

function addNew() {
	var oForm = document.forms[0];
	var sBody = getRequestBody(oForm);
	if(validate(oForm)) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("post","ajax_wrapper.php?aj_file=purchase&mode=add",true);
	oXMLHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			//if(oXMLHttp.responseText) {
				updateIssueList(oForm.pur_code.value);
			//}
			//else {
		//		alert("There was error while adding the new issue code!");
		//	}
		}	
	}
	
	oXMLHttp.send(sBody);
	}
} 

function deleteItem(pur_code,item_code) {
	var oForm = document.forms[0];
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=purchase&mode=delete&pur_code="+pur_code+"&item_code="+item_code,true);
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
				updateIssueList(oForm.pur_code.value);
		}	
	}
	
	oXMLHttp.send(null);
} 

function updateIssueList(pur_code) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=purchase&mode=list&pur_code="+pur_code,true);
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			document.getElementById("purchase_list").innerHTML = oXMLHttp.responseText;	
		}
	}
	oXMLHttp.send(null);
}

function validate(oForm) {
	if(oForm.quantity.value == "") {
		alert("You must enter a value in quantity");
		return false;
	}
	else if(oForm.quantity.value != parseInt(oForm.quantity.value, 10)) {
		alert("You can only enter Numeric Values ");
		return false;
	} 
	else if(oForm.rate.value == "") {
		alert("You must enter a value in quantity");
		return false;
	}
	else if(oForm.rate.value != parseInt(oForm.rate.value, 10)) {
		alert("You can only enter Numeric Values ");
		return false;
	}
	return true;
}