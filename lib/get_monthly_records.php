<?php


include_once dirname(__DIR__) . '/classes/index.php';
$index = new Index();

 $records = json_encode([
     'Jan' => (int)$index->get_monthly_records('01'),
     'Feb' => (int)$index->get_monthly_records('02'),
     'Mar' => (int)$index->get_monthly_records('03'),
     'Apr' => (int)$index->get_monthly_records('04'),
     'May' => (int)$index->get_monthly_records('05'),
     'Jun' => (int)$index->get_monthly_records('06'),
     'Jul' => (int)$index->get_monthly_records('07'),
     'Aug' => (int)$index->get_monthly_records('08'),
     'Sep' => (int)$index->get_monthly_records('09'),
     'Oct' => (int)$index->get_monthly_records('10'),
     'Nov' => (int)$index->get_monthly_records('11'),
     'Dec' => (int)$index->get_monthly_records('12'),
 ]);

 echo $records ;return;

















?>