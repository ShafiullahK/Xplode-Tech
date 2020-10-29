<?php


include_once dirname(__DIR__) . '/classes/index.php';
$index = new Index();


$record = json_encode([
    'Jan' => $index->get_monthly_expense_record('01'),
    'Feb' => $index->get_monthly_expense_record('02'),
    'Mar' => $index->get_monthly_expense_record('03'),
    'Apr' => $index->get_monthly_expense_record('04'),
    'May' => $index->get_monthly_expense_record('05'),
    'Jun' => $index->get_monthly_expense_record('06'),
    'Jul' => $index->get_monthly_expense_record('07'),
    'Aug' => $index->get_monthly_expense_record('08'),
    'Sep' => $index->get_monthly_expense_record('09'),
    'Oct' => $index->get_monthly_expense_record('10'),
    'Nov' => $index->get_monthly_expense_record('11'),
    'Dec' => $index->get_monthly_expense_record('12'),
]);

echo $record; return;












?>