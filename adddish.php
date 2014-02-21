<?php
require_once('global.php');	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add New Dish Record</h3>';
ob_start();
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="82%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD COLSPAN="2">Dish Name 
        <INPUT NAME="dish_name" TYPE="text" ID="dish_name" SIZE="20"></TD>
      <TD COLSPAN="3">No. of servings per unit 
        <INPUT NAME="servings" TYPE="text" ID="servings" SIZE="10"></TD>
    </TR>
    <TR> 
      <TD COLSPAN="2">Dish Code 
        <INPUT NAME="dish_code" TYPE="text" DISABLED="disabled" ID="dish_code" VALUE="<?php $newid=Dish::getNewId();echo $newid; ?>" SIZE="10"></TD>
      <TD COLSPAN="3">Department Name 
        <SELECT NAME="dept_name" ID="dept_name">
          <?php
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'dept_list.php');
		?>
        </SELECT> </TD>
    </TR>
    <TR BGCOLOR="#66CC99"> 
      <TD COLSPAN="5"><STRONG>Ingredients &amp; Price</STRONG></TD>
    </TR>
    <TR VALIGN="TOP"> 
      <TD WIDTH="25%">Item Name 
        <SELECT NAME="item_name" ID="item_name" onChange="fillM(this)">
          <?php 
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'item_list.php');	
		?>
        </SELECT> </TD>
      <TD WIDTH="15%">Scale <INPUT NAME="scale" TYPE="text" ID="scale" SIZE="4"> 
      </TD>
      <TD WIDTH="22%">Quantity 
        <INPUT NAME="quantity" TYPE="text" ID="quantity" SIZE="7"> 
      </TD>
      <TD WIDTH="21%"> 
        Cost 
          
        <INPUT NAME="cost" TYPE="text" ID="cost" SIZE="7">
</TD>
      <TD WIDTH="17%"><A HREF="adddish.php" onClick="addNew();return false;"><IMG SRC="templates/images/add.gif"></A></TD>
    </TR>
    <TR> 
      <TD COLSPAN="5"> <DIV ID="dish_list"> </DIV></TD>
    </TR>
    <TR> 
      <TD COLSPAN="2"> Total Cost Price 
        <INPUT NAME="total_cost" TYPE="text" ID="total_cost" SIZE="15" MAXLENGTH="11"></TD>
      <TD COLSPAN="3">Estimate Sell Price 
        <INPUT NAME="sell_price" TYPE="text" ID="sell_price" SIZE="15" MAXLENGTH="11"></TD>
    </TR>
  </TABLE>
</FORM>

<?php

$form = ob_get_clean();

$GLOBALS['TEMPLATE']['extra_head'] .= '<SCRIPT language="javascript" src="includes/js/aj_dish.js" type="text/javascript"></SCRIPT>';
$GLOBALS['TEMPLATE']['content'] .= $form;

require_once(TEMPLATE_PATH . 'page.php');
?>

 