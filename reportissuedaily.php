<?php
require_once('global.php');	

ob_start();
?>
<H3>Daily Issue Report</H3>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="92%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD WIDTH="27%">Select Date: 
        <SELECT NAME="day">
          <OPTION VALUE="01">1</OPTION>
          <OPTION VALUE="02">2</OPTION>
          <OPTION VALUE="03">3</OPTION>
          <OPTION VALUE="04">4</OPTION>
          <OPTION VALUE="05">5</OPTION>
          <OPTION VALUE="06">6</OPTION>
          <OPTION VALUE="07">7</OPTION>
          <OPTION VALUE="08">8</OPTION>
          <OPTION VALUE="09">9</OPTION>
          <OPTION>10</OPTION>
          <OPTION>11</OPTION>
          <OPTION>12</OPTION>
          <OPTION>13</OPTION>
          <OPTION>14</OPTION>
          <OPTION>15</OPTION>
          <OPTION>16</OPTION>
          <OPTION>17</OPTION>
          <OPTION>18</OPTION>
          <OPTION>19</OPTION>
          <OPTION>20</OPTION>
          <OPTION>21</OPTION>
          <OPTION>22</OPTION>
          <OPTION>23</OPTION>
          <OPTION>24</OPTION>
          <OPTION>25</OPTION>
          <OPTION>26</OPTION>
          <OPTION>27</OPTION>
          <OPTION>28</OPTION>
          <OPTION>29</OPTION>
          <OPTION>30</OPTION>
          <OPTION>31</OPTION>
        </SELECT>
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
		<TD> <DIV ID="issue_report"> 
          <?php
	  	if(isset($_POST['show'])) {
			$day = $_POST['day'];
			$month = $_POST['month'];
			$year = $_POST['year'];
			$date = $year . '-'. $month . '-' . $day; 
			print "<p><strong>Issue Report of date $date</strong></p>";
		} else {
			$date = date('y/m/d');
			print "<p><strong>Today's Issue Report ($date)</strong></p>";
		}
			if(IssueItem::check($date)) {
			$ii = IssueItem::getListByDate($date);
			
			print '<table>';
			print '<tr class="heading">';
			print '<td>S.No.</td><td>Issue Code</td><td>Department</td><td>Item Name</td><td>Quantity</td>';
			print '</tr>';
			$bgcolor = '#EFEFEF';
			$switch = 1;
			$sno = 1;
			foreach($ii as $value) {
				if($switch==1) {
					$bgcolor = '#DFDFDF';
					$switch = 0;
				} else {
					$bgcolor = '#EFEFEF';
					$switch = 1;
				}
				print "<tr style='background:$bgcolor'>";
				print '<td>' . $sno . '</td>';
				print '<td>' . $value->issue_code . '</td>';
				$deptinfo = Department::getById($value->dept_code);
				$iteminfo = Item::getById($value->item_code);
				print '<td>' . $deptinfo->name . '</td>';
				print '<td>' . $iteminfo->name . '</td>';
				print '<td>' . $value->item_qty  . '</td>';
				print '</tr>';
				$sno++;
			}
			print '</table>';
			} 
			else {
				print "<p>There was no issue made on that day: $date</p>";
			}

	  ?>
        </DIV></TD>
	</TR>
  </TABLE>
</FORM>

<?php
if(IssueItem::check($date)) {
print '<div align=center><form method="post" action="printissuedaily.php">';
print '<input type="hidden" name="date" value="' . $date . '">';
print '<input type="submit" name="print" value="Print Report">';
print '</form></div>';
}
$form = ob_get_clean();

$GLOBALS['TEMPLATE']['content'] .= $form;

require_once(TEMPLATE_PATH . 'page.php');
?>

 