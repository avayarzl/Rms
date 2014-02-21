<?php
require_once('global.php');	

ob_start();
?>

<div id="selectdish">
<form METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
Select a Dish to View its Details: &nbsp;<SELECT NAME="dish_name" ID="select2" onChange="fillM(this)">
          <?php 
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'dish_list.php');	
		?>
        </SELECT>
</form>
</div>
<div id="dish_view_list">

</div>
<?php

$html = ob_get_clean();
$GLOBALS['TEMPLATE']['extra_head'] .= '<SCRIPT language="javascript" src="includes/js/aj_dishview.js" type="text/javascript"></SCRIPT>';
$GLOBALS['TEMPLATE']['content'] .= '<h3>Viewing Dish Record</h3>';
$GLOBALS['TEMPLATE']['content'] .= $html;

require_once(TEMPLATE_PATH . 'page.php');
?>

 