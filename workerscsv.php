<?php

if ($_POST["export"]) {
    $connect = mysqli_connect("localhost", "root", "", "store");  
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=workers.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Worker ID',' Worker Name','Worker Category','Contact Info','Active','Status'));
    $query = "SELECT * FROM employees";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);

}
