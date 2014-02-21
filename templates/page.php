<?php
defined('_REXEC') or die('Restricted Access');

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            <?php
            if (!empty($GLOBALS['TEMPLATE']['title'])) {
                echo $GLOBALS['TEMPLATE']['title'];
            }
            ?>
        </title>
        <link rel="stylesheet" type="text/css" href="templates/css/style.css" />

        <?php
        if (!empty($GLOBALS['TEMPLATE']['extra_head'])) {
            echo $GLOBALS['TEMPLATE']['extra_head'];
        }
        ?>

    </head>

    <body>
        <div id="container">
            <div id="header">

            </div>
            <?php
            if ($menuoff == false) {
                ?>
                <div id="menu">
                    <ul id="menu_rms">
                        <li>Inventory
                            <?php
                            if ($_SESSION['permission'] == 'management') {
                                ?>
                                <ul>
                                    <li><a href="viewstock.php">Stock Levels</a></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                        <li>Add
                            <ul>
                                <?php
                                if ($_SESSION['permission'] == 'management') {
                                    ?>
                                    <li><a href="addemployee.php">Employee</a></li>
                                    <li><a href="addmeasurement.php">Measurement</a></li>
                                    <li><a href="additem.php">Item</a></li>
                                    <li><a href="adddepartment.php">Department</a></li>
                                    <li><a href="adddish.php">Dish</a></li>
                                    <?php
                                }
                                ?>
                                <li><a href="addissue.php">Issue</a></li>
                                <li><a href="addpurchase.php">Purchase</a></li>
                                <li><a href="consumption.php">Consumption</a></li>

                            </ul>
                        </li>
                        <li>Modify
                            <?php
                            if ($_SESSION['permission'] == 'management') {
                                ?>
                                <ul>
                                    <li><a href="editemployee.php">Employee</a></li>
                                    <li><a href="editmeasurement.php">Measurement</a></li>
                                    <li><a href="edititem.php">Item</a></li>
                                    <!--<li><a href="#">Purchase</a></li> -->
                                    <li><a href="editdepartment.php">Department</a></li>
                                    <!--<li><a href="#">Issue</a></li> -->
                                    <li><a href="editdish.php">Dish</a></li>

                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                        <li>View
                            <?php
                            if ($_SESSION['permission'] == 'management') {
                                ?>
                                <ul>
                                    <li><a href="viewdepartment.php">Department</a></li>
                                    <li><a href="viewdish.php">Dish</a></li>
                                    <li><a href="viewemployee.php">Employee</a></li>
                                    <li><a href="viewissue.php">Issue</a></li>
                                    <li><a href="viewitem.php">Item</a></li>
                                    <li><a href="viewmeasurement.php">Measurement</a></li>
                                    <li><a href="viewpurchase.php">Purchase</a></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                        
                        <li>Bill
                            <?php
                            if ($_SESSION['permission'] == 'management') {
                                ?>
                                <ul>
                                    <li><a href="addbill.php">Table 1</a></li>
                                    <li><a href="addbill.php">Table 2</a></li>


                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                        <li>Reports
                            <?php
                            if ($_SESSION['permission'] == 'management') {
                                ?>
                                <ul>
                                    <li><a href="reportconsumption.php">Daily Consumption</a></li>
                                    <li><a href="reportpurchasedaily.php">Daily Purchase</a></li>
                                    <li><a href="reportissuedaily.php">Daily Issue</a></li>
                                    <li><a href="reportsalesdaily.php">Daily Sales</a></li>
                                    <li><a href="reportsalesmonthly.php">Monthly Sales Report</a></li>
                                    <li><a href="reportpurchasemonthly.php">Monthly Purchase Report</a></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                        <li>System
                            <ul>
                                <li><a href="home.php">Inital/Home Page</a></li>
                                <li><a href="logoff.php">Log Out</a></li>
                            </ul>
                        </li>
                        

                    </ul>
                </div>

                <?php
            }
            ?>

            <div id="content">
                <?php
                if (!empty($GLOBALS['TEMPLATE']['content'])) {
                    echo $GLOBALS['TEMPLATE']['content'];
                }
                ?>
            </div>

            <div id="footer">

            </div>
        </div>

    </body>
</html>

