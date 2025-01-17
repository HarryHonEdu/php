<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
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
            <h1>Read Customer</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $userid = isset($_GET['userid']) ? $_GET['userid'] : die('ERROR: Record Username not found.');

        //include database connection
        include 'config/database.php';
        // read current record's data
        try {
            // prepare select query
            $query = "SELECT user_id, username, password, first_name, last_name, gender, date_of_birth, registration_time, account_status FROM customers WHERE user_id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $userid);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $fetched_id = $row['user_id'];
            $fetched_name = $row['username'];
            $fetched_password = $row['password'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $gender = $row['gender'];
            $date_of_birth = $row['date_of_birth'];
            $registration_time = $row['registration_time'];
            $account_status = $row['account_status'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <!-- HTML read one record table will be here -->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>User ID</td>
                <td><?php echo htmlspecialchars($fetched_id, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><?php echo htmlspecialchars($fetched_name, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?php echo htmlspecialchars($fetched_password, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><?php echo htmlspecialchars($first_name, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><?php echo htmlspecialchars($last_name, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><?php echo htmlspecialchars($gender, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td><?php echo htmlspecialchars($date_of_birth, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Registration Time</td>
                <td><?php echo htmlspecialchars($registration_time, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Account Status</td>
                <td><?php
                $status = "";
                if ($account_status == 1) {
                    $status = "Active";
                    echo htmlspecialchars($status, ENT_QUOTES);
                }
                if ($account_status == 0) {
                    $status = "Inactive";
                    echo htmlspecialchars($status, ENT_QUOTES);
                }
                ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='customer_listing.php' class='btn btn-danger'>Back to read customers</a>
                </td>
            </tr>
        </table>

    </div> <!-- end .container -->

</body>

</html>