<?php
defined('_REXEC') or die('Restricted Access');

$dept_list = Department::getAllList();

ob_start();

if(isset($_GET['option_data'])) {
	foreach($dept_list as $dept_value) {
		print '<option value="' . $dept_value->deptId . '">' . $dept_value->name . '</option>';
	}
} 
else if(isset($_GET['edit_data'])) {
	print '<table>';
	print '<tr class="heading"><td>Dept Code</td>';
	print '<td>Dept Name</td>';
	print '<td>Dept Head</td></tr>';

	foreach($dept_list as $dept_value) {
		print '<tr><td>'. $dept_value->deptId . '</td>';
		print '<td><a href="editdepartment.php?deptId=' . $dept_value->deptId . '">'  . $dept_value->name . '</td>';
		print '<td>' . $dept_value->head . '</td>';
	}

	print '</table>';
}
else {
	print '<table>';
	print '<tr class="heading"><td>Dept Code</td>';
	print '<td>Department Name</td>';
	print '<td>Department Head</td></tr>';
	
	$bgcolor = '#EFEFEF';
	$switch = 1;

	foreach($dept_list as $dept_value) {
		if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
		print "<tr style='background:$bgcolor'><td>"  . $dept_value->deptId . '</td>';
		print '<td>' . $dept_value->name . '</td>';
		print '<td>' . $dept_value->head . '</td>';
	}

	print '</table>';
}


$html = ob_get_clean();
print $html;
?>
	