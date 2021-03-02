<?php
$firstname = $lastname = null;
$valid = true;
$showSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require '../config/database.php';
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

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
        ];
        $sql = "INSERT INTO users (id, firstname, lastname) VALUES (nextval('users_sequence'), :firstname, :lastname);";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
        $showSuccess = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple PHP CRUD - Create</title>
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
                    <h2 class="pull-left">New User</h2>
                    <a href="index.php" class="btn btn-default pull-right">Back to Listing</a>
                </div>
                <div>
                    <?php
                    if ($showSuccess) {
                        echo '<div class="text-success">Saved successfully.</div>';
                    }
                    ?>
                    <form method="post" action="create.php">
                        <div class="form-group">
                            <label for="firstname">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                   placeholder="Enter firstname">
                            <?php
                            if (!$valid && !$firstname) {
                                echo '<small class="text-danger">Firstname is required.</small>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   placeholder="Enter lastname">
                            <?php
                            if (!$valid && !$lastname) {
                                echo '<small class="text-danger">Lastname is required.</small>';
                            }
                            ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>