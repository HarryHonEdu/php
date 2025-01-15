<!DOCTYPE HTML>
<?php
include 'config/database.php';
if ($_POST) {
    try {
        // posted values
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $promotion_price = $_POST['promotion_price'];
        $manufacture_date_string = $_POST['manufacture_date'];
        $expired_date_string = $_POST['expired_date'];
        $product_cat = '';
        $errors = [];
        $manufacture_date = DateTime::createFromFormat('Y-m-d\TH:i', $manufacture_date_string);
        $expired_date = DateTime::createFromFormat('Y-m-d\TH:i', $expired_date_string);
        //Check name
        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
        //Check description
        if (empty($description)) {
            $errors[] = 'Description is required.';
        }
        //Check price
        if (empty($price)) {
            $errors[] = 'Price is required.';
        }
        if (!is_numeric($price) && !empty($price)) {
            $errors[] = 'Price must be number(s).';
        }
        //Check promotion price
        if (!is_numeric($promotion_price) && !empty($promotion_price)) {
            $errors[] = 'Promotion price must be number(s).';
        }
        if (is_numeric($promotion_price) > is_numeric(($price))) {
            $errors[] = 'Promotion price must be lower than price.';
        }
        //Check manufacture date
        if (empty($manufacture_date)) {
            $errors[] = 'Manufacture Date is empty.';
        }
        //Check expired date
        if (empty($expired_date)) {
            $errors[] = 'Expired Date is empty.';
        }
        if (!empty($manufacture_date) && !empty($expired_date)) {
            $diff = date_diff($manufacture_date, $expired_date);
            if ($diff->invert == 1) {
                $errors[] = "Expired Date must be later than Manufacture Date.";
            }
        }
        //Check Category
        if (isset($_POST['category']) && !empty($_POST['category'])) {
            $product_cat = $_POST['category'];
        } else {
            $errors[] = "Choose a product category.";
        }

    } // show error
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
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
    // Check if the user is logged in
    include 'validation.php';
    include 'menu.php';

    ?>

    <?php
    // include database connection
    include 'config/database.php';

    // delete message prompt will be here
    
    // select all data
    $query = "SELECT * FROM product_cat";
    $stmt = $con->prepare($query);
    $stmt->execute();



    ?>

    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>

        <!-- html form to create product will be here -->



        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Promotion Price</td>
                    <td><input type='text' name='promotion_price' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Manufacture Date</td>
                    <td><input type='datetime-local' name='manufacture_date' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Expired Date</td>
                    <td><input type='datetime-local' name='expired_date' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Proudct Category</td>
                    <td><label for="category">Choose a Category:</label>
                        <select name="category" id="category">
                            <option value="" selected disabled>Select a category</option>
                            <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                // extract row
                                // this will make $row['firstname'] to just $firstname only
                                extract($row);
                                // creating new table row per record
                                echo '<option value="' . $product_cat_id . '">' . $product_cat_name . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php
                if ($_POST) {
                    try {
                        include 'config/database.php';
                        //If there is errors, show them
                        if (!empty($errors)) {
                            echo "<div class='alert alert-danger'><ul>";
                            foreach ($errors as $error) {
                                echo "<li>{$error}</li>";
                            }
                            echo "</ul></div>";
                        } else {
                            $manufacture_date_string = $manufacture_date->format('Y-m-d H:i:s');
                            $expired_date_string = $expired_date->format('Y-m-d H:i:s');
                            // insert query
                            $query = "INSERT INTO products (name, description, price, promotion_price, manufacture_date, expired_date, product_cat, created) 
                VALUES (:name, :description, :price, :promotion_price, :manufacture_date, :expired_date, :product_cat, :created)";
                            // prepare query for execution
                            $stmt = $con->prepare($query);
                            // bind the parameters
                            $stmt->bindParam(':name', $name);
                            $stmt->bindParam(':description', $description);
                            $stmt->bindParam(':product_cat', $product_cat);
                            $stmt->bindParam(':price', $price);
                            $stmt->bindParam(':promotion_price', $promotion_price);
                            $stmt->bindParam(':manufacture_date', $manufacture_date_string);
                            $stmt->bindParam(':expired_date', $expired_date_string);
                            // specify when this record was inserted to the database
                            $created = date('Y-m-d H:i:s');
                            $stmt->bindParam(':created', $created);
                            // Execute the query
                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success'>Product was added.</div>";
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
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='product_listing.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->



</body>

</html>