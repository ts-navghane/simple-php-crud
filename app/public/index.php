<?php

require '../config/database.php';

$stmt = $conn->query('SELECT id, firstname, lastname from users ORDER BY id;');
$results = $stmt->fetchAll();

$table = '<table class="table table-bordered table-striped">';
$table .= '<thead><tr>';
$table .= '<th scope="col">Firstname</th>';
$table .= '<th scope="col">Lastname</th>';
$table .= '<th scope="col">Actions</th>';
$table .= '</tr></thead>';


if (count($results) > 0) {
    foreach ($results as $result) {
        $table .= '<tr>';
        $table .= '<td>'.$result['firstname'].'</td>';
        $table .= '<td>'.$result['lastname'].'</td>';
        $table .= '<td>';
        $table .= '<a href="update.php?id='.$result['id'].'">edit</a> ';
        $table .= '<a data-id="'.$result['id'].'" href="javascript:void(0);" class="delete-user">delete</a>';
        $table .= '</td>';
        $table .= '</tr> ';
    }
} else {
    $table .= '<tr class="text-center" ><td colspan = "3" > No rows found </td ></tr > ';
}

$table .= '</table > ';
$stmt->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple PHP CRUD - Read</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">User Details</h2>
                    <a href="create.php" class="btn btn-success pull-right">Add New User</a>
                </div>
                <div>
                    <?php
                    echo $table; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $(window).load(function () {
        $('.delete-user').click(function () {
            const id = $(this).data('id');
            $.post('delete.php', {'id': id}, function (data) {
                if (data.success) {
                    location.reload();
                }
            });
        });
    });
</script>
</body>
</html>
