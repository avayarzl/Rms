<?php
defined('_REXEC') or die('Restricted Access');

$m_list = Measurement::getAllList();

ob_start();

if(isset($_GET['option_data'])) {
	foreach($m_list as $m_value) {
		print '<option value="' . $m_value->measurementId . '">' . $m_value->code . '</option>';
	}
}
else {
print '<table>';
print '<tr class="heading"><td>Measurement Code</td>';
print '<td>Description</td></tr>';

$bgcolor = '#EFEFEF';
$switch = 1;



foreach($m_list as $m_value) {
		if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
		
	print "<tr style='background:$bgcolor'><td>". $m_value->code . '</td>';
	print '<td>' . $m_value->description . '</td>';
}

print '</table>';
}

$html = ob_get_clean();
print $html;
?>
	