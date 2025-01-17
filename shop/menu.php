<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a href="https://zenless.hoyoverse.com/en-us/" target="blank">
            <img class="mb-4"
                src="https://upload-os-bbs.hoyolab.com/upload/2022/06/13/100427891/51296d07ef153ca7dd744dc31874d548_4734072724131588175.png"
                alt="" width="130" height="160" style="padding: 30px; border-radius: 10px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="product_create.php">Create Product</a></li>
                        <li><a class="dropdown-item" href="product_listing.php">Product Listing</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Customers
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="customer_create.php">Create Customer</a></li>
                        <li><a class="dropdown-item" href="customer_listing.php">Customer Listing</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <ul class="navbar-nav ms-auto d-flex align-items-center">
            <li class="nav-item">
                <span class="navbar-text me-3">
                    Welcome, <strong id="username"><?php echo $_SESSION['username']; ?> </strong>!
                </span>
            </li>
            <li class="nav-item me-4">
                <span>
                    <a class="button-c" href="logout.php">Log Out</a>
                </span>
            </li>
        </ul>
    </div>
</nav>
<style>
    .button-c {
        background: #fff;
        border: none;
        padding: 10px 25px 10px 30px;
        display: inline-block;
        font-size: 15px;
        font-weight: 600;
        width: 120px;
        cursor: pointer;
        transform: skew(-10deg);
        text-decoration: none;
        color: black;
    }

    .button-c::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        right: 100%;
        left: 0;
        background: rgb(20, 20, 20);
        opacity: 0;
        z-index: -1;
        transition: all 0.35s;
    }

    .button-c:hover {
        color: #fff;
    }

    .button-c:hover::before {
        left: 0;
        right: 0;
        opacity: 1;
    }
</style>