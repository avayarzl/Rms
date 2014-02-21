// ADD ISSUE  Functions

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
	oXMLHttp.open("post","ajax_wrapper.php?aj_file=dish&mode=add",true);
	oXMLHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			//if(oXMLHttp.responseText) {
				updateDishList(oForm.dish_code.value);
			//}
			//else {
		//		alert("There was error while adding the new issue code!");
		//	}
		}	
	}
	
	oXMLHttp.send(sBody);
	}
} 

function deleteIngredient(dish_code,item_code) {
	//var oForm = document.forms[0];
	//var sBody = getRequestBody(oForm);
	
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=dish&mode=delete&dish_code="+dish_code+"&item_code="+item_code,true);
	//oXMLHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			updateDishList(dish_code);
		}
	}
	oXMLHttp.send(null)
}

function updateDishList(dish_code) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=dish&mode=list&dish_code="+dish_code,true);
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			document.getElementById("dish_list").innerHTML = oXMLHttp.responseText;	
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
	if(oForm.quantity.value == "") {
		alert("You must enter a value in quantity");
		return false;
	}
	else if(oForm.quantity.value != parseInt(oForm.quantity.value, 10)) {
		alert("You can only enter Numeric Values in Quantity ");
		return false;
	} 
	else if(oForm.cost.value == "") {
		alert("You must enter a value in Cost");
		return false;
	}
	else if(oForm.cost.value != parseInt(oForm.cost.value, 10)) {
		alert("You can only enter Numeric Values in Cost");
		return false;
	}
	return true;
}

