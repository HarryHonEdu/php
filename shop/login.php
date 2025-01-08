<!DOCTYPE html>
<?php
include 'config/database.php';
if ($_POST) {
    try {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $errors = [];

        if (empty($email)) {
            $errors[] = "Please enter your email / username.";
        }
        if (empty($password)) {
            $errors[] = "Please enter your password.";
        }


    } catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}
session_start();
session_regenerate_id(true);
?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .btn-custom {
            background-color: #ff6347;
            /* Tomato color */
            color: white;
            border: none;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin w-100 m-auto">
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
            <img class="mb-4" src="https://c.tenor.com/G9B2_i_ENPEAAAAd/tenor.gif" alt="" width="300" height="180">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email/Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <?php
            if ($_POST) {
                if (!empty($errors)) {
                    echo "<div class='alert alert-danger'><ul>";
                    foreach ($errors as $error) {
                        echo "<li>{$error}</li>";
                    }
                    echo "</ul></div>";
                } else {
                    $query = "SELECT username, password, account_status FROM customers WHERE username = ? LIMIT 1";

                    $stmt = $con->prepare($query);
                    $stmt->bindParam(1, $email);
                    $stmt->execute();

                    $num = $stmt->rowCount();

                    if ($num > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $fetched_password = $row['password'];
                        $fetched_status = $row['account_status'];
                        if ($fetched_password === $password) {
                            if ($fetched_status == 1) {
                                $_SESSION['user_id'] = 1;
                                $_SESSION['username'] = $email;
                                $_SESSION['is_logged_in'] = true;
                                header('Location: product_listing.php');
                                exit();
                            } else {
                                echo "<div class='alert alert-danger'><ul>";
                                echo "<li>Account is not active. Please contact support.</li>";
                                echo "</ul></div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'><ul>";
                            echo "<li>Invalid Password.</li>";
                            echo "</ul></div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'><ul>";
                        echo "<li>Invalid Username.</li>";
                        echo "</ul></div>";
                    }
                }
            }


            ?>
            <button class="btn btn-custom w-100 py-2" type="submit">Sign in</button>
        </form>

    </main>
</body>

</html>