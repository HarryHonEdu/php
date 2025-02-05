<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon"
        href="https://upload-os-bbs.hoyolab.com/upload/2022/06/13/100427891/51296d07ef153ca7dd744dc31874d548_4734072724131588175.png"
        type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <h1>Customer Listing</h1>
        </div>

        <!-- PHP code to read records will be here -->

        <?php
        // include database connection
        include 'config/database.php';

        // delete message prompt will be here
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        // if it was redirected from delete.php
        if ($action == 'deleted') {
            echo "<div class='alert alert-warning'>Record was deleted.</div>";
        }

        // select all data
        $query = "SELECT user_id, username, email, first_name, last_name, date_of_birth FROM customers";
        $stmt = $con->prepare($query);

        $search = isset($_GET['name']) ? $_GET['name'] : "";

        if (!empty($search)) {
            $query .= " WHERE username LIKE :search OR first_name LIKE :search OR last_name LIKE :search OR email LIKE :search";
        }

        $sort_column = isset($_GET['sort']) ? $_GET['sort'] : "user_id";
        $sort_order = (isset($_GET['ascdesc']) && $_GET['ascdesc'] == "desc") ? "DESC" : "ASC";

        $allowed_columns = ["username", "email", "first_name", "last_name"];
        if (!in_array($sort_column, $allowed_columns)) {
            $sort_column = "user_id";
        }

        $query .= " ORDER BY $sort_column $sort_order";

        $stmt = $con->prepare($query);

        if (!empty($search)) {
            $search = "%$search%";
            $stmt->bindParam(':search', $search);
        }

        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();

        // link to create record form
        echo "<br> <div class='container-fiuld d-flex gap-2 justify-content-between align-items-center'>";
        echo "<a href='customer_create.php' class='btn btn-primary m-b-1em mb-2'>Create New Customer</a>";
        echo "<div class='d-flex align-items-center'>
        <form method='GET' class='d-flex align-items-center'>
        <input type='text' name='name' class='form-control me-2 mb-2' placeholder='Search...' style='width: 200px; height: 38px;'></input>";
        echo "<br><button type='submit' class='btn btn-primary m-b-1em mb-2'>Search</button>";
        echo "</form></div></div>";

        //check if more than 0 record found
        if ($num > 0) {
            echo "Total Customers: <strong>" . $num . "</strong>";

            // data from database will be here
            echo "<table class='table table-hover table-responsive table-bordered'>";//start table
        
            //creating our table heading
            echo "<tr>";
            echo "<th><div class='d-flex gap-2 align-items-center'>Username
                <a href='?sort=username&ascdesc=asc'><i class='fa-solid fa-caret-up'></i></a> <!-- Ascending sort icon -->       
                <a href='?sort=username&ascdesc=desc'><i class='fa-solid fa-caret-down'></i> <!-- Descending sort icon -->
            </div></th>";
            echo "<th><div class='d-flex gap-2 align-items-center'>Email
                <a href='?sort=email&ascdesc=asc'><i class='fa-solid fa-caret-up'></i></a> <!-- Ascending sort icon -->       
                <a href='?sort=email&ascdesc=desc'><i class='fa-solid fa-caret-down'></i> <!-- Descending sort icon -->
            </div></th>";
            echo "<th><div class='d-flex gap-2 align-items-center'>First Name
                <a href='?sort=first_name&ascdesc=asc'><i class='fa-solid fa-caret-up'></i></a> <!-- Ascending sort icon -->       
                <a href='?sort=first_name&ascdesc=desc'><i class='fa-solid fa-caret-down'></i> <!-- Descending sort icon -->
            </div></th>";
            echo "<th><div class='d-flex gap-2 align-items-center'>Last Name
                <a href='?sort=last_name&ascdesc=asc'><i class='fa-solid fa-caret-up'></i></a> <!-- Ascending sort icon -->       
                <a href='?sort=last_name&ascdesc=desc'><i class='fa-solid fa-caret-down'></i> <!-- Descending sort icon -->
            </div></th>";
            echo "<th>Date Of Birth</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            // table body will be here
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$username}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$first_name}</td>";
                echo "<td>{$last_name}</td>";
                echo "<td>{$date_of_birth}</td>";
                echo "<td>";
                // read one record
                echo "<a href='customer_details.php?userid={$user_id}' class='btn btn-info m-r-1em me-2'>Read</a>";

                // we will use this links on next part of this post
                echo "<a href='customer_update.php?userid={$user_id}' class='btn btn-primary m-r-1em me-2'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_user({$user_id});'  class='btn btn-danger me-2'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            // end table
            echo "</table>";
        }
        // if no records found
        else {
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>

    </div> <!-- end .container -->

    <!-- confirm delete record will be here -->
    <script type='text/javascript'>
        // confirm record deletion
        function delete_user(id) {

            var answer = confirm('Are you sure?');
            if (answer) {
                // if user clicked ok,
                // pass the id to delete.php and execute the delete query
                window.location = 'customer_delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>