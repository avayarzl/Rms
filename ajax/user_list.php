<?php
defined('_REXEC') or die('Restricted Access');

$u_list = User::getAllList();

ob_start();

	print '<table>';
	print '<tr class="heading"><td>UserName</td>';
	print '<td>Real Name</td>';
	print '<td>Permission</td>';
	print '<td>Actions</td>';
	print '</tr>';

	$bgcolor = '#EFEFEF';
	$switch = 1;
	foreach($u_list as $u_value) {
		if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
		
		print "<tr style='background:$bgcolor'><td>" . $u_value->username . '</td>';
		print '<td>' . $u_value->real_name . '</td>';
		$permission = $u_value->permission == 'm' ? 'Management' : 'Ordinary';
		print '<td>' . $permission . '</td>';
		print '<td><a href="deleteuser.php?id=' . $u_value->id . '">Delete</a></td>';
		print '</tr>';
	}

	print '</table>';


$html = ob_get_clean();
print $html;
?>
	