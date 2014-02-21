
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

function addNewItem() {
	var oForm = document.forms[0];
	var sBody = getRequestBody(oForm);
	
	if(validate(oForm)) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("post","ajax_wrapper.php?aj_file=consumption&mode=add&cat=item",true);
	oXMLHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			//if(oXMLHttp.responseText) {
				updateItemConsumptionList(oForm.elements[1].options[oForm.elements[1].selectedIndex].value);
			//}
			//else {
		//		alert("There was error while adding the new issue code!");
		//	}
		}	
	}
	
	oXMLHttp.send(sBody);
	}
} 

function addNewDish() {
	var oForm = document.forms[0];
	var sBody = getRequestBody(oForm);
	
	if(validateDish(oForm)) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("post","ajax_wrapper.php?aj_file=consumption&mode=add&cat=dish",true);
	oXMLHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			//if(oXMLHttp.responseText) {
				updateDishConsumptionList(oForm.elements[1].options[oForm.elements[1].selectedIndex].value);
			//}
			//else {
		//		alert("There was error while adding the new issue code!");
		//	}
		}	
	}
	
	oXMLHttp.send(sBody);
	}
} 



function updateItemConsumptionList(dept_name) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=consumption&mode=list&cat=item&dept="+dept_name,true);
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			document.getElementById("item_consumption_list").innerHTML = oXMLHttp.responseText;	
		}
	}
	oXMLHttp.send(null);
}

function updateDishConsumptionList(dept_name) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=consumption&mode=list&cat=dish&dept="+dept_name,true);
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			document.getElementById("dish_consumption_list").innerHTML = oXMLHttp.responseText;	
		}
	}
	oXMLHttp.send(null);
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

function validate(oForm) {
	if(oForm.consumption.value == "") {
		alert("You must enter a value in consumption");
		return false;
	}
	else if(oForm.consumption.value != parseInt(oForm.consumption.value, 10)) {
		alert("You can only enter Numeric Values in Consumption ");
		return false;
	} 
	else if(oForm.wastage.value == "") {
		alert("You must enter a value in wastage");
		return false;
	}
	else if(oForm.wastage.value != parseInt(oForm.wastage.value, 10)) {
		alert("You can only enter Numeric Values in Wastage");
		return false;
	} else if(oForm.wastage_description.value="") {
		alert("You must enter a value in wastage description");
		return false;
	}
	return true;
}

function validateDish(oForm) {
	if(oForm.prepared.value == "") {
		alert("You must enter a value in Prepared");
		return false;
	}
	else if(oForm.prepared.value != parseInt(oForm.prepared.value, 10)) {
		alert("You can only enter Numeric Values in Prepared ");
		return false;
	} 
	else if(oForm.wastage.value == "") {
		alert("You must enter a value in wastage");
		return false;
	}
	else if(oForm.wastage.value != parseInt(oForm.wastage.value, 10)) {
		alert("You can only enter Numeric Values in Wastage");
		return false;
	} else if(oForm.wastage_description.value="") {
		alert("You must enter a value in wastage description");
		return false;
	}
	return true;
}

