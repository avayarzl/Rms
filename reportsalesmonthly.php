<?php
require_once('global.php');	

ob_start();
?>
<H3>Monthly Sales Report</H3>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="92%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD WIDTH="27%">Select Date: 
        <SELECT NAME="month">
          <OPTION VALUE="01">January</OPTION>
          <OPTION VALUE="02">February</OPTION>
          <OPTION VALUE="03">March</OPTION>
          <OPTION VALUE="04">April</OPTION>
          <OPTION VALUE="05">May</OPTION>
          <OPTION VALUE="06">June</OPTION>
          <OPTION VALUE="07">July</OPTION>
          <OPTION VALUE="08">August</OPTION>
          <OPTION VALUE="09">September</OPTION>
          <OPTION VALUE="10">October</OPTION>
          <OPTION VALUE="11">November</OPTION>
          <OPTION VALUE="12">December</OPTION>
        </SELECT>
        <SELECT NAME="year">
          <OPTION>2008</OPTION>
          <OPTION>2009</OPTION>
          <OPTION>2010</OPTION>
          <OPTION>2011</OPTION>
          <OPTION>2012</OPTION>
          <OPTION>2013</OPTION>
        </SELECT>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <INPUT NAME="show" TYPE="submit" ID="show" VALUE="Show"></TD>
    </TR>
	<TR>
	  <TD>&nbsp; </TD>
	</TR>
	
	<TR>
		<TD> <DIV ID="sales_report"> 
          <?php
	  	if(isset($_POST['show'])) {
			$month = $_POST['month'];
			$year = $_POST['year'];
			
			$month_name = getMonthName($month);		
			print "<p><strong>Sales Report of Month $month_name/$year</strong></p>";
		
			if(PurchaseItem::checkMonth($month, $year)) {
			$pi = PurchaseItem::getListByMonth($month, $year);
			
			print '<table>';
			print '<tr class="heading">';
			print '<td>S.No.</td><td>Purchase Code</td><td>Date</td><td>Item Name</td><td>Quantity</td><td>Rate</td>';
			print '<td>Total</td></tr>';
			$total = 0;
			$bgcolor = '#EFEFEF';
			$switch = 1;
			$sno = 1;
			foreach($pi as $value) {
				if($switch==1) {
					$bgcolor = '#DFDFDF';
					$switch = 0;
				} else {
					$bgcolor = '#EFEFEF';
					$switch = 1;
				}
				print "<tr style='background:$bgcolor'>";
				print '<td>' . $sno . '</td>';
				print '<td>' . $value->pur_code . '</td>';
				print '<td>' . $value->pur_date . '</td>';
				$iteminfo = Item::getById($value->item_code);
				print '<td>' . $iteminfo->name . '</td>';
				print '<td>' . $value->item_qty . '</td>';
				print '<td>' . $value->item_rate . '</td>';
				print '<td>' . $value->item_qty * $value->item_rate . '</td>';
				print '</tr>';
				$sno++;
				$total += $value->item_qty * $value->item_rate;
			}
			print '</table>';
			print '<p>Total:' .$total . '</p>';
			} 
			else {
				print "<p>There is no sales for the month of $month_name, $year</p>";
			}
	}
	  ?>
        </DIV></TD>
	</TR>
  </TABLE>
</FORM>

<?php
	if(isset($_POST['show']) && PurchaseItem::checkMonth($month, $year)) {
print '<div align=center><form method="post" action="printsalesmonthly.php">';
print '<input type="hidden" name="month" value="' . $month  . '">';
print '<input type="hidden" name="year" value="' . $year . '">';
print '<input type="submit" name="print" value="Print Report">';
print '</form></div>';
}
$form = ob_get_clean();

$GLOBALS['TEMPLATE']['content'] .= $form;

require_once(TEMPLATE_PATH . 'page.php');
?>

 