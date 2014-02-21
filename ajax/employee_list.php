<?php
defined('_REXEC') or die('Restricted Access');

$emp_list = Employee::getAllList();

ob_start();

if(isset($_GET['option_data'])) {
	foreach($emp_list as $emp_value) {
		print '<option value="' . $emp_value->employeeId . '">' . $emp_value->name . '</option>';
	}
} 
else {
	
	print '<table>';
	print '<tr class="heading"><td>Name</td>';
	print '<td>Address</td>';
	print '<td>Telephone</td>';
	print '<td>Mobile</td>';
	print '<td>Email</td>';
	print '<td>Designation</td>';
	print '<td>Salary</td>';
	print '<td>Join Date</td></tr>';

	$bgcolor = '#EFEFEF';
	$switch = 1;
	
	foreach($emp_list as $emp_value) {
		if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
			
		
		print "<tr style='background:$bgcolor'><td>" . $emp_value->name . '</td>';
		print '<td>' . $emp_value->address . '</td>';
		print '<td>' . $emp_value->telephone . '</td>';
		print '<td>' . $emp_value->mobile . '</td>';
		print '<td>' . $emp_value->email . '</td>';
		print '<td>' . $emp_value->designation . '</td>';
		print '<td>' . $emp_value->salary . '</td>';
		print '<td>' . $emp_value->join_date . '</td>';
		print '</tr>';
	}

	print '</table>';
}


$html = ob_get_clean();
print $html;
?>
	