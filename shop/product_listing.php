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
            <h1>Read Products</h1>
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
        $query = "SELECT id, name, description, price, product_cat_name FROM products
        INNER JOIN product_cat ON products.product_cat = product_cat.product_cat_id";

        $search = isset($_GET['name']) ? $_GET['name'] : "";

        if (!empty($search)) {
            $query .= " WHERE name LIKE :search OR product_cat_name LIKE :search";
        }

        $sort_column = isset($_GET['sort']) ? $_GET['sort'] : "id";
        $sort_order = (isset($_GET['ascdesc']) && $_GET['ascdesc'] == "desc") ? "DESC" : "ASC";

        $allowed_columns = ["name", "price"];
        if (!in_array($sort_column, $allowed_columns)) {
            $sort_column = "id";
        }

        $query .= " ORDER BY $sort_column $sort_order";

        $stmt = $con->prepare($query);

        if (!empty($search)) {
            $search = "%$search%";
            $stmt->bindParam(':search', $search);
            echo "</tr>";

            // table body will be here
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$description}</td>";
                echo "<td>{$product_cat_name}</td>";
                echo "<td>RM{$price}</td>";
                echo "<td>";
                // read one record
                echo "<a href='product_details.php?id={$id}' class='btn btn-info m-r-1em me-2'>Read</a>";

                // we will use this links on next part of this post
                echo "<a href='product_update.php?id={$id}' class='btn btn-primary m-r-1em me-2'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger me-2'>Delete</a>";
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
                window.location = 'product_delete.php?id=' + id;
            }
        }
    </script>


</body>

</html>