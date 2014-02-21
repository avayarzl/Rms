<?php
require_once("global.php");	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add New Purchase</h3>';

ob_start();
?>
<P ALIGN=right><A HREF="addpurchase.php" CLASS="issue">Add Another New Purchase</A></P><BR>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="87%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD COLSPAN="2">Purchase Code 
        <INPUT NAME="pur_code" TYPE="text" ID="pur_code" DISABLED="disabled" VALUE="<?php $newid = PurchaseItem::getNewId(); echo $newid ?>" SIZE="7"></TD>
      <TD COLSPAN="4">Date <STRONG> 
        <?php 
			print date('d/m/y');
		?>
        </STRONG> </TD>
    </TR>
    <TR> 
      <TD WIDTH="20%">Item Name 
        <SELECT NAME="item_name" ID="item_name" onChange="fillM(this)">
          <?php 
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'item_list.php');	
		?>
        </SELECT> <BR> </TD>
      <TD WIDTH="13%">Scale 
        <INPUT NAME="scale" TYPE="text" ID="scale2" SIZE="5"> <BR> </TD>
      <TD WIDTH="17%">Quantity 
        <INPUT NAME="quantity" TYPE="text" ID="quantity2" SIZE="8"> <BR> </TD>
      <TD WIDTH="12%">Rate 
        <INPUT NAME="rate" TYPE="text" ID="rate" SIZE="8"> </TD>
      <TD WIDTH="16%"> &nbsp;</TD>
      <TD WIDTH="22%"><A HREF="#" onClick="addNew();return false;"><IMG SRC="templates/images/add.gif"></A></TD>
    </TR>
    <TR> 
      <TD COLSPAN="6"> <DIV ID="purchase_list"> </DIV></TD>
    </TR>
     </TABLE>
</FORM>

<?php

$form = ob_get_clean();
$GLOBALS['TEMPLATE']['extra_head'] .= '<SCRIPT language="javascript" src="includes/js/aj_purchase.js" type="text/javascript"></SCRIPT>';

$GLOBALS['TEMPLATE']['content'] .= $form;


require_once(TEMPLATE_PATH . 'page.php');
?>


 