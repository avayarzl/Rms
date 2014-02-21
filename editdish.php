<?php
require_once('global.php');	

$GLOBALS['TEMPLATE']['content'] .= '<h3>Modify Dish Record</h3>';
if(isset($_POST['dishId'])) 
	$dish_id = $_POST['dishId'];
else if(isset($_GET['dishId'])) 
	$dish_id = $_GET['dishId'];
else 
	$dish_id = 0;
	
if($dish_id != 0)
	$dish = Dish::getDishInfo($dish_id);


ob_start();
?>
<FORM METHOD="get" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<P>Select Dish Name: <SELECT NAME="dishId"> <?php 
require_once('ajax'.DS.'dish_list.php');
?></SELECT> <INPUT TYPE="submit" NAME="iSubmit" VALUE="Go"></P>
</FORM>
<?php 
if($dish_id != 0) {
		if(!isset($_POST['secondpage'])) {
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
    <TR> 
      <TD> <LABEL>Dish Code</LABEL></TD>
      <TD> <INPUT NAME="dish_code" TYPE="text" DISABLED="DISABLED" ID="dish_code" VALUE="<?php echo $dish->dish_code ?>" SIZE="20" />
	  <INPUT TYPE="hidden" NAME="item_code" VALUE="<?php echo $dish->dish_code ?>"></TD>
    </TR>
    <TR> 
      <TD> <LABEL>Dish Name</LABEL> </TD>
      <TD> <INPUT TYPE="text" ID="dish_name" NAME="dish_name" SIZE="20" VALUE="<?php echo $dish->dish_name ?>"> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>No. of servings</LABEL></TD>
      <TD><INPUT NAME="serving" TYPE="text" ID="serving" SIZE="20" VALUE="<?php echo $dish->dish_serving ?>"></TD>
    </TR>
    <TR> 
      <TD> <LABEL>Department</LABEL></TD>
      <TD><SELECT NAME="dept_code" ID="dept_code">
	  <?php 
$_GET['option_data'] = true;
require_once('ajax'.DS.'dept_list.php');
?>
        </SELECT></TD>
    </TR>
    <TR ALIGN="CENTER"> 
      <TD COLSPAN=2> 
	  	<INPUT TYPE="hidden" NAME="secondpage" VALUE="true">
        <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Update &amp; Go to Dish Details"> 
        <INPUT NAME="delete" TYPE="submit" ID="delete" VALUE="Delete Record"> 
        <INPUT TYPE="hidden" NAME="dishId" VALUE="<?php echo $dish->dish_code; ?>"> 
      </TD>
    </TR>
  </TABLE>
</FORM>

<?php
	}	
}
$form = ob_get_clean();


if(!isset($_POST['submit']) and !isset($_POST['delete'])) {
	$GLOBALS['TEMPLATE']['content'] .= $form;
}
else {
	$dish_name = $_POST['dish_name'];
	$serving = $_POST['serving'];
	$dept_code = $_POST['dept_code'];

	$dish = new Dish();
	$dish->dish_code = $dish_id;
	$dish->dish_name = $dish_name;
	$dish->dish_serving = $serving;
	$dish->dept_code = $dept_code;
	if(!isset($_POST['delete'])) {
		if($dish->update()) {
			$GLOBALS['TEMPLATE']['content'] .= '<p>The Dish Item was successfully modified. Click on Modify Ingredients to modify the ingredients</p>';
			if(isset($_POST['secondpage'])) {
				$html =  '<form action=editdishingre.php method=post>';
				$html .= "<input type=hidden name='dishId' value='$dish_id'>";
				$html .= "<input type=submit name=submit value='Modify Ingredients'>";
				$html .= '</form>'; 
				$GLOBALS['TEMPLATE']['content'] .= $html;
			}
		}
		else {
			$html = '<p>There was some error while inserting the records.</p>';
			$html .= 'MySQL ERROR: ' . mysql_error(DB);
			$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
			$GLOBALS['TEMPLATE']['content'] .= $html;
		}
	}
	else {
		if(Dish::deleteDish($dish_id)) {
			$html = "<p>The Dish Record of $dish_name was deleted.</p>";
			$GLOBALS['TEMPLATE']['content'] .= $html;
		}
		else {
			$html = '<p>There was some error while inserting the records.</p>';
			$html .= 'MySQL ERROR: ' . mysql_error(DB);
			$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
			$GLOBALS['TEMPLATE']['content'] .= $html;
		}
	}	
		
}

require_once(TEMPLATE_PATH . 'page.php');
?>

 