<?php
require_once('global.php');	

$page_mode = isset($_GET['page']) ? $_GET['page'] : "consumption";

ob_start();

if($page_mode == "consumption") {
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add Consumption Record (Item)</h3>';
?>
<P ALIGN=center STYLE="margin-left:190px;"><A HREF="consumption.php?page=consumption" CLASS="consumption_active">Item Consumption Details</A>
<A HREF="consumption.php?page=dishconsumption" CLASS="consumption">Dish Preparation And Wastage Details</A></P>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="92%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD COLSPAN="2">Date <STRONG> 
        <?php 
			print date('d/m/y');
		?>
        </STRONG> </TD>
      <TD COLSPAN="4">Department Name: 
        <SELECT NAME="dept_name" ID="dept_name">
          <?php
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'dept_list.php');
		?>
        </SELECT></TD>
    </TR>
    <TR> 
      <TD WIDTH="10%">Item Name<BR> <SELECT NAME="item_name" ID="item_name" onChange="fillM(this)">
          <?php 
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'item_list.php');	
		?>
        </SELECT> </TD>
      <TD WIDTH="15%">Scale <BR> <INPUT NAME="scale" TYPE="text" ID="scale" SIZE="5"> 
      </TD>
      <TD WIDTH="19%">Consumption<BR> <INPUT NAME="consumption" TYPE="text" ID="consumption" SIZE="10"> 
      </TD>
      <TD WIDTH="16%"><P>Wastage<BR>
          <INPUT NAME="wastage" TYPE="text" ID="wastage" SIZE="10">
        </P></TD>
      <TD WIDTH="29%">Wastage Description<BR> <INPUT NAME="wastage_description" TYPE="text" ID="wastage_description" SIZE="20"> 
      </TD>
      <TD WIDTH="11%"><A HREF="consumption.php" onClick="addNewItem();return false;"><IMG SRC="templates/images/add.gif"></A></TD>
    </TR>
    <TR> 
      <TD COLSPAN="6"> <DIV ID="item_consumption_list"> </DIV></TD>
    </TR>
  </TABLE>
</FORM>

<?php
} 
else {
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add Consumption Record (Dish)</h3>';
?>
<P ALIGN=center STYLE="margin-left:190px;"><A HREF="consumption.php?page=consumption" CLASS="consumption">Item Consumption Details</A>
<A HREF="consumption.php?page=dishconsumption" CLASS="consumption_active">Dish Preparation And Wastage Details</A></P>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="92%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD COLSPAN="2">Date <STRONG> 
        <?php 
			print date('d/m/y');
		?>
        </STRONG></TD>
      <TD COLSPAN="3">Department Name: 
        <SELECT NAME="dept_name" ID="dept_name">
          <?php
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'dept_list.php');
		?>
        </SELECT></TD>
    </TR>
    <TR> 
      <TD WIDTH="13%">Dish Name<BR> <SELECT NAME="dish_name" ID="select2" onChange="fillM(this)">
          <?php 
			//$_GET['option_data'] = true;
			require_once('ajax'.DS.'dish_list.php');	
		?>
        </SELECT> </TD>
      <TD WIDTH="19%">Prepared<BR> <INPUT NAME="prepared" TYPE="text" ID="prepared" SIZE="10"> 
      </TD>
      <TD WIDTH="21%">Wastage<BR> <INPUT NAME="wastage" TYPE="text" ID="wastage" SIZE="10"> 
      </TD>
      <TD WIDTH="32%">Wastage Description<BR> <INPUT NAME="wastage_description" TYPE="text" ID="wastage_description" SIZE="20"> 
      </TD>
      <TD WIDTH="15%"><A HREF="consumption.php" onClick="addNewDish();return false;"><IMG SRC="templates/images/add.gif"></A></TD>
    </TR>
    <TR> 
      <TD COLSPAN="5"> <DIV ID="dish_consumption_list"> </DIV></TD>
    </TR>
  </TABLE>
</FORM>

<?php 
}

$form = ob_get_clean();

$GLOBALS['TEMPLATE']['extra_head'] .= '<SCRIPT language="javascript" src="includes/js/aj_consumption.js" type="text/javascript"></SCRIPT>';
$GLOBALS['TEMPLATE']['content'] .= $form;

require_once(TEMPLATE_PATH . 'page.php');
?>

 