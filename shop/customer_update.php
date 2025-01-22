<!DOCTYPE HTML>
<?php
include 'config/database.php';
include 'validation.php';
include 'menu.php';
?>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Update Customer</h1>
            <?php
            $userid = isset($_GET['userid']) ? $_GET['userid'] : die('ERROR: Record Username not found.');


            include 'config/database.php';
            try {

                // prepare select query
                $query = "SELECT user_id, username, password, first_name, last_name, gender FROM customers WHERE user_id = ? LIMIT 0,1";
                $stmt = $con->prepare($query);

                // this is the first question mark
                $stmt->bindParam(1, $userid);
                // execute our query
                $stmt->execute();
                // store retrieved row to a variable
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // values to fill up our form
                $fetched_name = $row['username'];
                $fetched_password = $row['password'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $fetched_gender = $row['gender'];
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
            ?>

            <?php
            if ($_POST) {
                $nameUser = htmlspecialchars(strip_tags($_POST['nameUser']));
                $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
                $lastname = htmlspecialchars(strip_tags($_POST['lastname']));
                $confirm_password = htmlspecialchars(strip_tags($_POST['confirm_password']));
                $errors = [];
                if (empty($nameUser)) {
                    $errors[] = 'Username is required.';
                }
                if (empty($firstname)) {
                    $errors[] = 'First Name is required.';
                }
                if (empty($lastname)) {
                    $errors[] = 'Last Name is required.';
                }
                if (isset($_POST['gender']) && !empty($_POST['gender'])) {
                    $gender = $_POST['gender'];
                } else {
                    $errors[] = 'Gender is required.';
                }
                if (empty($_POST['password']) && empty($_POST['new_password']) && empty($_POST['confirm_password'])) {

                } else if (!empty($_POST['password']) || !empty($_POST['new_password']) || !empty($_POST['confirm_password'])) {
                    if (!empty($_POST['password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {

                    } else {
                        $errors[] = "Please fill in all the fields to update your password.";
                    }
                }

                if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
                    if ($_POST['new_password'] != $_POST['confirm_password']) {
                        $errors[] = "New password and confirm Password does not match.";
                    }
                }

                if (!empty($_POST['password']) && !empty($_POST['new_password'])) {
                    if ($_POST['password'] == $_POST['new_password'])
                    $errors[] = "New and old password cannot be the same.";
                }

                if (!empty($_POST['password'])) {
                    if ($fetched_password != $_POST['password']) {
                        $errors[] = "Incorrect old password.";
                    }
                }
                if ($nameUser != $fetched_name) {
                    $check_query = "SELECT username FROM customers WHERE username = :username";
                    $check_stmt = $con->prepare($check_query);
                    $check_stmt->bindParam(':username', $nameUser);
                    $check_stmt->execute();
                    if ($check_stmt->rowCount() > 0) {
                        $errors[] = "The username '{$nameUser}' is already taken. Please choose a different one.";
                    }
                }
                try {
                    if (!empty($errors)) {
                        echo "<div class='alert alert-danger'><ul>";
                        foreach ($errors as $error) {
                            echo "<li>{$error}</li>";
                        }
                        echo "</ul></div>";
                    } else {
                        $query = "UPDATE customers
                        SET username=:username, password=:password, first_name=:first_name, last_name=:last_name, 
                        gender=:gender WHERE user_id=:user_id";
                        $stmt = $con->prepare($query);

                        // bind the parameters
                        if (!empty($_POST['password'])) {
                            $stmt->bindParam(':password', $confirm_password);
                        } else {
                            $stmt->bindParam(':password', $fetched_password);
                        }
                        $stmt->bindParam(':user_id', $userid);
                        $stmt->bindParam(':first_name', $firstname);
                        $stmt->bindParam(':last_name', $lastname);
                        $stmt->bindParam(':gender', $gender);

                        if ($nameUser != $fetched_name) {
                            $stmt->bindParam(':username', $nameUser);
                        } else {
                            $stmt->bindParam(':username', $fetched_name);
                        }

                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success'>Record was updated.</div>";
                            $query = "SELECT user_id, username, password, first_name, last_name, gender FROM customers WHERE user_id = ? LIMIT 0,1";
                            $stmt = $con->prepare($query);

                            // this is the first question mark
                            $stmt->bindParam(1, $userid);
                            // execute our query
                            $stmt->execute();
                            // store retrieved row to a variable
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            // values to fill up our form
                            $fetched_name = $row['username'];
                            $fetched_password = $row['password'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $fetched_gender = $row['gender'];

                        } else {
                            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                        }
                    }
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            } ?>


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?userid={$userid}"); ?>" method="post">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Username</td>
                        <td><input type='text' name='nameUser'
                                value="<?php echo htmlspecialchars($fetched_name, ENT_QUOTES) ?>"
                                class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><input type='text' name='firstname'
                                value="<?php echo htmlspecialchars($first_name, ENT_QUOTES) ?>" class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type='text' name='lastname'
                                value="<?php echo htmlspecialchars($last_name, ENT_QUOTES) ?>" class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>
                            <input type='radio' id='male' name='gender' value='male' <?php echo ($fetched_gender == 'male') ? 'checked' : ''; ?> />
                            <label for="male">Male</label><br>
                            <input type='radio' id='female' name='gender' value='female' <?php echo ($fetched_gender == 'female') ? 'checked' : ''; ?> />
                            <label for="female">Female</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name='password' class='form-control'></input>
                        </td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name='new_password' class='form-control'></input>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name='confirm_password' class='form-control'></input>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Save Changes' class='btn btn-primary' />
                            <a href='customer_listing.php' class='btn btn-danger'>Back to read customers</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>