<?php
require_once("global.php");	
$GLOBALS['TEMPLATE']['content'] .= '<h3>New Bill</h3>';

ob_start();
?>
<P ALIGN=right>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE WIDTH="87%" BORDER="1" CELLSPACING="0" CELLPADDING="0">
    <TR> 
      <TD width="33%">Date<strong>
              <div class="sdate">
        <?php 
			print date('d/m/y');
		?>
                  </div>
        </strong></TD>
      <TD width="67%" colspan=2>Bill No 
      <input name="quantity2" type="text" id="quantity" size="8" /></TD>
    </TR>
    <TR> 
      <TD > Dish Name: 
        <SELECT NAME="dish_name" ID="select" onChange="fillM(this)">
          <?php 
			//$_GET['option_data'] = true;
			require_once('ajax'.DS.'dish_list.php');	
		?>
        </SELECT></TD>
<td>Amount
  <input name="quantity" type="text" id="quantity2" size="8" /></td>
<td><label>
  <input type="submit" name="add" id="add" value="Add" />
</label></td>
    </TR>
    <TR>
      <TD colspan="2" ><div id="bill_list">
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td>Bill No</td>
            <td>Date</td>
            <td>Dish Name</td>
            <td>Amount</td>
          </tr>
          <tr>
            <td><span class="billno">&nbsp;</span></td>
            <td><span class="date">&nbsp;</span></td>
            <td><span class="dishname">&nbsp;</span></td>
            <td><span class="amount">&nbsp;</span></td>
          </tr>
        </table>
      </div></TD>
      <td>
        <span style="width:130px;float:left;">Discount</span><span id="disc"></span><br />
        <span style="width:130px;float:left;">Discount Amount</span><span id="discamt"></span><br />
        <span style="width:130px;float:left;">Payable Amount</span><span id="totamount"></span>
      </td><br />
    </TR>
    
    
    <TR>
      <TD >&nbsp;</TD>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </TR>
     </TABLE>
</FORM>

<?php

$form = ob_get_clean();
$GLOBALS['TEMPLATE']['extra_head'] .= '<SCRIPT language="javascript" src="includes/js/aj_purchase.js" type="text/javascript"></SCRIPT>';

$GLOBALS['TEMPLATE']['content'] .= $form;


require_once(TEMPLATE_PATH . 'page.php');
?>
<script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#add").click(function(e){
            if($('#quantity').val() != '' && $('#quantity2').val() != '') {
                $('.billno').text($('#quantity').val());
                $('.date').text($('.sdate').text());
                $('.dishname').text($('#select :selected').text());
                $('.amount').text($('#quantity2').val());
                $('#disc').text('5%');
                var discamt = (parseInt($('#quantity2').val())*5)/100;
                $('#discamt').text(discamt);
                var totalamt = parseInt($('#quantity2').val())-discamt;
                $('#totamount').text(totalamt);
            } else {
                alert('Fill Bill No and Amount');
            }
            e.preventDefault();
        });
    });
</script>

 