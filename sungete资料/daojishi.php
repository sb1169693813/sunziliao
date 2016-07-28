<?php
//echo date("Y-m-d",strtotime("-10 year"));
//倒计时（天数）
echo (strtotime("2016-2-11")-strtotime(date('Y-m-d')))/(3600*24);