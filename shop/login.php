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
    <link rel="icon"
        href="https://upload-os-bbs.hoyolab.com/upload/2022/06/13/100427891/51296d07ef153ca7dd744dc31874d548_4734072724131588175.png"
        type="image/png">

    <style>
        html,
        body {
            height: 100vh;
            /* Ensure it covers the full viewport */
            margin: 0;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images3.alphacoders.com/137/1370585.jpeg');
            background-size: cover;
            background-position: center;
            filter: blur(1px);
            /* Apply blur effect only to the background */
            z-index: 1;
            /* Keep it behind the content */
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
            position: relative;
            z-index: 3;
            background: rgba(255, 255, 255, 0.8);
            /* Add a semi-transparent background for better readability */
            border-radius: 10px;
            /* Optional: Add rounded corners */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.4);
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
            <img class="mb-4"
                src="https://upload-os-bbs.hoyolab.com/upload/2022/06/13/100427891/51296d07ef153ca7dd744dc31874d548_4734072724131588175.png"
                alt="" width="300" height="400">
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