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
            <h1>Update Product</h1>
            <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

            //include database connection
            include 'config/database.php';

            // read current record's data
            try {
                // prepare select query
                $query = "SELECT id, name, description, price, promotion_price, product_cat, manufacture_date, expired_date FROM products
                WHERE id = ? LIMIT 0,1";
                $stmt = $con->prepare($query);

                // this is the first question mark
                $stmt->bindParam(1, $id);

                // execute our query
                $stmt->execute();

                // store retrieved row to a variable
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // values to fill up our form
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
                $product_cat = $row['product_cat'];
                $promotion_price = $row['promotion_price'];
                $manufacture_date = $row['manufacture_date'];
                $expired_date = $row['expired_date'];
            }

            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
            ?>

            <?php

            // check if form was submitted
            if ($_POST) {
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $promotion_price = htmlspecialchars(strip_tags($_POST['promotion_price']));
                $manufacture_date_string = htmlspecialchars(strip_tags($_POST['manufacture_date']));
                $expired_date_string = htmlspecialchars(strip_tags($_POST['expired_date']));
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
                if (isset($_POST['product_cat']) && !empty($_POST['product_cat'])) {
                    $product_cat = htmlspecialchars(strip_tags($_POST['product_cat']));
                } else {
                    $errors[] = "Choose a product category.";
                }
                try {
                    if (!empty($errors)) {
                        echo "<div class='alert alert-danger'><ul>";
                        foreach ($errors as $error) {
                            echo "<li>{$error}</li>";
                        }
                        echo "</ul></div>";
                    } else {
                        $manufacture_date_string = $manufacture_date->format('Y-m-d H:i:s');
                        $expired_date_string = $expired_date->format('Y-m-d H:i:s');
                        // write update query
                        // in this case, it seemed like we have so many fields to pass and
                        // it is better to label them and not use question marks
                        $query = "UPDATE products
                        SET name=:name, description=:description,
                        price=:price, product_cat=:product_cat, promotion_price=:promotion_price, manufacture_date=:manufacture_date, expired_date=:expired_date WHERE id = :id";
                        // prepare query for excecution
                        $stmt = $con->prepare($query);
                        // posted values
            
                        // bind the parameters
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':description', $description);
                        $stmt->bindParam(':price', $price);
                        $stmt->bindParam(':product_cat', $product_cat);
                        $stmt->bindParam(':promotion_price', $promotion_price);
                        $stmt->bindParam(':manufacture_date', $manufacture_date_string);
                        $stmt->bindParam(':expired_date', $expired_date_string);
                        $stmt->bindParam(':id', $id);

                        // Execute the query
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success'>Record was updated.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                        }
                    }
                }
                // show errors
                catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            } ?>


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Name</td>
                        <td><input type='text' name='name' value="<?php echo $name; ?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name='description' class='form-control'><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type='text' name='price' value="<?php echo $price; ?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Promotion Price</td>
                        <td><input type='text' name='promotion_price' value="<?php echo $promotion_price; ?>"
                                class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Product Category</td>
                        <td><label for="product_cat">Choose a Category:</label>
                            <select name="product_cat" id="product_cat" class='form-control'>
                                <?php
                                $query = "SELECT id, product_cat_name, product_cat.* FROM products
                                INNER JOIN product_cat ON products.product_cat = product_cat.product_cat_id WHERE id = ?";
                                $stmt2 = $con->prepare($query);
                                $stmt2->bindParam(1, $id);
                                $stmt2->execute();
                                $row = $stmt2->fetch(PDO::FETCH_ASSOC);

                                $current_product_cat_id = $row['product_cat_id'];
                                $current_product_cat_name = $row['product_cat_name'];

                                extract($row);
                                echo '<option value="' . $product_cat_id . '">' . $product_cat_name . '</option>';
                                ?>
                                <?php
                                $query = "SELECT * FROM product_cat";
                                $stmt3 = $con->prepare($query);
                                $stmt3->execute();
                                while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                    // extract row
                                    // this will make $row['firstname'] to just $firstname only
                                    extract($row);
                                    // creating new table row per record
                                    if ($product_cat_id == $current_product_cat_id) {
                                        continue;
                                    }
                                    echo '<option value="' . $product_cat_id . '">' . $product_cat_name . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Manufacture Date</td>
                        <td><input type='datetime-local' name='manufacture_date'
                                value="<?= $manufacture_date->format('Y-m-d\TH:i') ?>" class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Expired Date</td>
                        <td><input type='datetime-local' name='expired_date'
                                value="<?= $expired_date->format('Y-m-d\TH:i') ?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Save Changes' class='btn btn-primary' />
                            <a href='product_listing.php' class='btn btn-danger'>Back to read products</a>
                        </td>
                    </tr>
                </table>
            </form>


        </div>
    </div>
</body>

</html>