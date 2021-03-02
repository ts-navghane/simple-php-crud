<?php

require '../config/database.php';
$firstname = $lastname = null;
$valid = true;
$showSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    if (empty($id)) {
        echo '<div class="text-danger">Invalid input!</div>';
        exit();
    }

    if (empty($firstname)) {
        $valid = false;
    }

    if (empty($lastname)) {
        $valid = false;
    }

    if ($valid) {
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'id' => $id,
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname WHERE id = :id;';
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
        $showSuccess = true;
    }
} elseif ($_SERVER["REQUEST_METHOD"] === 'GET') {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo '<div class="text-danger">No record found!</div>';
        exit();
    }

    $sql = "SELECT firstname, lastname FROM users WHERE id = $id;";
    $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

    if (count($result) === 2) {
        $firstname = $result['firstname'];
        $lastname = $result['lastname'];
    } else {
        echo '<div class="text-danger">No record found!</div>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple PHP CRUD - Update</title>
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
                    <h2 class="pull-left">Update User</h2>
                    <a href="index.php" class="btn btn-default pull-right">Back to Listing</a>
                </div>
                <?php
                if ($showSuccess) {
                    echo '<div class="text-success">Updated successfully.</div>';
                }
                ?>
                <form method="post" action="update.php">
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"
                               placeholder="Enter firstname" value="<?php
                        echo $firstname; ?>">
                        <?php
                        if (!$valid && !$firstname) {
                            echo '<small class="text-danger">Firstname is required.</small>';
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname"
                               placeholder="Enter lastname" value="<?php
                        echo $lastname; ?>">
                        <?php
                        if (!$valid && !$lastname) {
                            echo '<small class="text-danger">Lastname is required.</small>';
                        }
                        ?>
                    </div>
                    <input type="hidden" name="id" value="<?php
                    echo $id; ?>"/>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
