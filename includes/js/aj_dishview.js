// ADD ISSUE  Functions


function fillM(list) {
	updateDishList(list.options[list.selectedIndex].value);
}



function updateDishList(dish_code) {
	var oXMLHttp = createXMLHttp();
	oXMLHttp.open("get","ajax_wrapper.php?aj_file=dish_view&dish_code="+dish_code,true);
	
	oXMLHttp.onreadystatechange = function() {
		if(oXMLHttp.readyState == 4) {
			document.getElementById("dish_view_list").innerHTML = oXMLHttp.responseText;	
		}
	}
	oXMLHttp.send(null);
}


