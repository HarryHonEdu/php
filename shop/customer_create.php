<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon"
        href="https://upload-os-bbs.hoyolab.com/upload/2022/06/13/100427891/51296d07ef153ca7dd744dc31874d548_4734072724131588175.png"
        type="image/png">
</head>

<body>
    <?php
    include 'validation.php';
    include 'menu.php';
    // Check if the user is logged in
    

    ?>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Customer</h1>
        </div>
        <?php

        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {
                // posted values
                $username = $_POST['username'];
                $password = $_POST['password'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];

                $dob = $_POST['dateofbirth'];
                $errors = [];
                //Check Username
                if (empty($username)) {
                    $errors[] = 'Username is required.';
                } else {
                    $check_query = "SELECT username FROM customers WHERE username = :username";
                    $check_stmt = $con->prepare($check_query);
                    $check_stmt->bindParam(':username', $username);
                    $check_stmt->execute();
                    if ($check_stmt->rowCount() > 0) {
                        $errors[] = "The username '{$username}' is already taken. Please choose a different one.";
                    }
                }
                if (empty($email)) {
                    $errors[] = 'Email is required.';
                } else {
                    $check_query = "SELECT email FROM customers WHERE email = :email";
                    $check_stmt = $con->prepare($check_query);
                    $check_stmt->bindParam(':email', $email);
                    $check_stmt->execute();
                    if ($check_stmt->rowCount() > 0) {
                        $errors[] = "The username '{$email}' is already taken. Please choose a different one.";
                    }
                }
                //Check Password
                if (empty($password)) {
                    $errors[] = 'Password is required.';
                }
                //Check First Name
                if (empty($firstname)) {
                    $errors[] = 'First Name is required.';
                }
                //Check Last Name
                if (empty($lastname)) {
                    $errors[] = 'Last Name is required.';
                }
                //Check Gender
                if (isset($_POST['gender']) && !empty($_POST['gender'])) {
                    $gender = $_POST['gender'];
                } else {
                    $errors[] = 'Gender is required.';
                }
                //Check Date Of Birth
                if (empty($dob)) {
                    $errors[] = 'Date of birth is empty.';
                }
                //If there is errors, show them
                if (!empty($errors)) {
                    echo "<div class='alert alert-danger'><ul>";
                    foreach ($errors as $error) {
                        echo "<li>{$error}</li>";
                    }
                    echo "</ul></div>";
                } else {
                    // insert query
                    $query = "INSERT INTO customers SET username=:username, email=:email, password=:password, first_name=:first_name, last_name=:last_name, 
                    gender=:gender, date_of_birth=:date_of_birth";
                    // prepare query for execution
                    $stmt = $con->prepare($query);
                    // bind the parameters
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':first_name', $firstname);
                    $stmt->bindParam(':last_name', $lastname);
                    $stmt->bindParam(':gender', $gender);
                    $stmt->bindParam(':date_of_birth', $dob);
                    // specify when this record was inserted to the database
                    // Execute the query
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Customer was added.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                }
            }
            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <!-- html form to create product will be here -->

        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type='email' name='email' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name='password' class='form-control'></input></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='firstname' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='lastname' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type='radio' id='male' name='gender' value='male' />
                        <label for="male">Male</label><br>
                        <input type='radio' id='female' name='gender' value='female' />
                        <label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <td>Date of birth</td>
                    <td><input type='date' name='dateofbirth' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='customer_listing.php' class='btn btn-danger'>Back to read customers</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
</body>

</html>