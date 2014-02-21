<?php
require_once('global.php');	

if(isset($_POST['mode']))
	$page_mode = $_POST['mode'];
else if(isset($_GET['mode']))
	$page_mode = $_GET['mode'];
else 
	$page_mode = "itemconsumption";
	
ob_start();

if($page_mode == "dishconsumption") {
?>
<H3>Dish Consumption Report</H3>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="92%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD>Department Name<BR>
        <SELECT NAME="dept_name" ID="dept_name">
          <?php
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'dept_list.php');
		?>
        </SELECT></TD>
      <TD WIDTH="72%" ROWSPAN="3" VALIGN="TOP">
	  <DIV ID="consumption_report">
	  <?php
	  	if(isset($_POST['show'])) {
			$day = $_POST['day'];
			$month = $_POST['month'];
			$year = $_POST['year'];
			$date = $year . '-'. $month . '-' . $day; 
			$dept_code = $_POST['dept_name'];
			if(DishConsumption::check($date,$dept_code)) {
			$d = DishConsumption::getByDate($date,$dept_code);
			
			print '<table>';
			print '<tr class="heading">';
			print '<td>S.No.</td><td>Dish</td><td>Prepared</td><td>Waste</td><td>Wastage Description</td>';
			print '</tr>';
			$sno = 1;
			$bgcolor = '#EFEFEF';
			$switch = 1;
			foreach($d as $d_value) {
					if($switch==1) {
						$bgcolor = '#DFDFDF';
						$switch = 0;
					} else {
						$bgcolor = '#EFEFEF';
						$switch = 1;
					}
				print "<tr style='background:$bgcolor'>";
				print '<td>' . $sno . '</td>';
				$dishinfo = Dish::getDishInfo($d_value->dish_code);
				print '<td>' . $dishinfo->name . '</td>';
				print '<td>' . $d_value->prepared . '</td>';
				print '<td>' . $d_value->wastage . '</td>';
				print '<td>' . $d_value->wastage_description . '</td>';
				print '</tr>';
				$sno++;
			}
			print '</table>';
			} 
			else {
				print '<p>There is no dish consumption report for that day</p>';
			}
		}
	  ?>
	  </DIV>
	  </TD>
    </TR>
    <TR> 
      <TD WIDTH="28%">Date<BR>
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
        </SELECT></TD>
    </TR>
	<TR>
	  <TD>
  	  <INPUT TYPE="hidden" NAME="mode" VALUE="dishconsumption">
	  <INPUT NAME="show" TYPE="submit" ID="show" VALUE="Show"></TD>
	</TR>
  </TABLE>
</FORM>

<?php
} 
else {
?>
<H3>Item Consumption Report</H3>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <TABLE WIDTH="92%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD>Department Name<BR>
        <SELECT NAME="dept_name" ID="dept_name">
          <?php
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'dept_list.php');
		?>
        </SELECT></TD>
      <TD WIDTH="73%" ROWSPAN="3" VALIGN="TOP">
	 <DIV ID="consumption_report">
	  <?php
	  	if(isset($_POST['show'])) {
			$day = $_POST['day'];
			$month = $_POST['month'];
			$year = $_POST['year'];
			$date = $year . '-'. $month . '-' . $day; 
			$dept_code = $_POST['dept_name'];
			if(ItemConsumption::check($date,$dept_code)) {
			$d = ItemConsumption::getByDate($date,$dept_code);
			
			print '<table>';
			print '<tr class="heading">';
			print '<td>S.No.</td><td>Item Name</td><td>Consumption</td><td>Waste</td><td>Wastage Description</td>';
			print '</tr>';
			$sno = 1;
			$bgcolor = '#EFEFEF';
			$switch = 1;
			foreach($d as $d_value) {
				if($switch==1) {
						$bgcolor = '#DFDFDF';
						$switch = 0;
					} else {
						$bgcolor = '#EFEFEF';
						$switch = 1;
					}
				print "<tr style='background:$bgcolor'>";
				print '<td>' . $sno . '</td>';
				$iteminfo = Item::getById($d_value->item_code);
				print '<td>' . $iteminfo->name . '</td>';
				print '<td>' . $d_value->consumption . '</td>';
				print '<td>' . $d_value->wastage . '</td>';
				print '<td>' . $d_value->wastage_description . '</td>';
				print '</tr>';
				$sno++;
			}
			print '</table>';
			} 
			else {
				print '<p>There is no item consumption report for that day</p>';
			}
		}
	  ?>
	  </DIV>
	  </TD>
    </TR>
    <TR> 
      <TD WIDTH="27%">Date<BR>
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
        </SELECT></TD>
    </TR>
	<TR>
	  <TD>
	  <INPUT TYPE="hidden" NAME="mode" VALUE="itemconsumption">
	  <INPUT NAME="show" TYPE="submit" ID="show" VALUE="Show"></TD>
	</TR>
  </TABLE>
</FORM>

<?php 
}
if(isset($_POST['show'])) {
	if($page_mode == "dishconsumption") {
		if(DishConsumption::check($date,$dept_code)) {
			print '<div align=center><form method="post" action="printconsumptiondish.php">';
			print '<input type="hidden" name="date" value="' . $date . '">';
			print '<input type="hidden" name="dept_code" value="' . $dept_code . '">';
			print '<input type="submit" name="print" value="Print Report">';
			print '</form></div>';
		}
	} else {
		if(ItemConsumption::check($date,$dept_code)) {
			print '<div align=center><form method="post" action="printconsumptionitem.php">';
			print '<input type="hidden" name="date" value="' . $date . '">';
			print '<input type="hidden" name="dept_code" value="' . $dept_code . '">';
			print '<input type="submit" name="print" value="Print Report">';
			print '</form></div>';
		}
	}
}

$form = ob_get_clean();

$GLOBALS['TEMPLATE']['content'] .= '<p id="con_report" ><a href="reportconsumption.php?mode=dishconsumption">Dish Consumption Report</a>  <a href="reportconsumption.php?mode=itemconsumption">Item Consumption</a></p><div style="clear:both"></div>';
$GLOBALS['TEMPLATE']['content'] .= $form;


require_once(TEMPLATE_PATH . 'page.php');
?>

 