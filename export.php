<?php

if ($_POST["export"]) {
    $connect = mysqli_connect("localhost", "root", "", "store");  
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=expenses.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Expense Name', 'Expense Amount','Payment Status', 'Expense Balance'));
    $query = "SELECT expense_name,expense_amount,payment_status,expense_balance FROM expenses";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);

}
