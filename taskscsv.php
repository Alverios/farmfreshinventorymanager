<?php

if ($_POST["export"]) {
    $connect = mysqli_connect("localhost", "root", "", "store");
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=tasks.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Task ID','Task Date','Assigned To','Task Description','Active','Status'));
    $query = "SELECT * FROM tasks";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);

}
