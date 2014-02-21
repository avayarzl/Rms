<?php
require_once("global.php");	

ob_start();
?>
<P ALIGN=right><A HREF="addissue.php" CLASS="issue">Add Another New Issue</A></P><BR>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="70%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD COLSPAN="2">Issue Code 
        <INPUT NAME="issue_code" TYPE="text" DISABLED="disabled" ID="issue_code" VALUE="<?php $newid = IssueItem::getNewId(); echo $newid ?>" SIZE="7"></TD>
      <TD COLSPAN="3">Date <STRONG> 
        <?php 
			print date('d/m/y');
		?>
        </STRONG> </TD>
    </TR>
    <TR> 
      <TD WIDTH="21%" VALIGN="TOP">Department Name<BR> <SELECT NAME="dept_name" ID="dept_name">
          <?php
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'dept_list.php');
		?>
        </SELECT> <BR> </TD>
      <TD WIDTH="17%" VALIGN="TOP">Item Name<BR> <SELECT NAME="item_name" ID="item_name" onChange="fillM(this)">
          <?php 
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'item_list.php');	
		?>
        </SELECT> <BR> </TD>
      <TD WIDTH="12%" VALIGN="TOP">Scale<BR>
        <INPUT NAME="scale" TYPE="text" ID="scale" SIZE="5" MAXLENGTH="10"> <BR> </TD>
      <TD WIDTH="28%" VALIGN="TOP">Quantity<BR> 
        <INPUT NAME="quantity" TYPE="text" ID="quantity" SIZE="10" MAXLENGTH="11"> 
        <BR> </TD>
      <TD WIDTH="22%"><A HREF="addissue.php" onClick="addNew();return false;"><IMG SRC="templates/images/add.gif" /></A></TD>
    </TR>
    <TR> 
      <TD COLSPAN="5"> <DIV ID="issue_list"> </DIV></TD>
    </TR>
  </TABLE>
</FORM>


<?php

$form = ob_get_clean();
$GLOBALS['TEMPLATE']['extra_head'] .= '<SCRIPT language="javascript" src="includes/js/aj_issue.js" type="text/javascript"></SCRIPT>';

$GLOBALS['TEMPLATE']['content'] .= '<h3>Add New Issue Record</h3>';
$GLOBALS['TEMPLATE']['content'] .= $form;


require_once(TEMPLATE_PATH . 'page.php');
?>


 