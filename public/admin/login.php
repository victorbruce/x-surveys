<?php
    session_start();
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS',   'God&myself');
    define('DB_NAME', 'xsurvey');

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        die ("Database connection failed: " . mysqli_errno() . "("
         . mysqli_connect_error() . ")");
    }

// include_once('../../includes/database.php');

if (isset($_POST['submit'])) {
    $errors = array();

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($_POST['email'])) {
        $errors[] = "Email field cannot be empty";
    } else {
        $email = $_POST['email'];
    }
    if (empty($_POST['password'])) {
        $errors[] = "Password field cannot be empty";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM admins WHERE email =  '{$email}'";
        $result = mysqli_query($connection, $query);
    
        if ($result) {
            $found_admin = mysqli_fetch_array($result);
    
            if ($password == $found_admin['password']) {
                $_SESSION['admin_id'] = $found_admin['id'];
                $_SESSION['username'] = $found_admin['first_name'];
                header('Location: ../index.php');
            } else {
                $_SESSION['err_msg'] = 'Email/Password mismatch';
            }
    
        } 
    }



// if ($found_admin) {
//      //$admin = $database->mysqli_fetch_array($found_admin);
//     // if ($password == $admin['password']) {
//     //     header('Location: ../index.php');
//     //     exit;
//     // } else {
//     //     echo 'Email/Password combination mismatch';
//     // } 
//     // echo $found_admin;
// } else {
//     echo 'Database query failed';
// }
}
?>
<?php $page_title = "Login"; ?>
<?php include_once('header.php'); ?>

<!-- Main Page -->

<header id="header">
    <div class="container">
        <div class="col-xs-12">
            <h1>Login System</h1>
        </div>
    </div>
</header>
<div class="container height">
    <div class="col-xs-6 col-xs-offset-2">
        <nav class="nav nav-tabs nav-justified">
            <li class="active"><a href="login.php">Login</a></li>
            
        </nav>
        <br>
        <?php if (isset($errors)) {
            foreach ($errors as $error) {
                echo "<ul class=\"list-group\">";
                echo "<li>$error;</li>";
                echo "</ul>";

            }
        }?>
        <?php if (isset($message)) { echo $_SESSION['err_msg']; } ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group col-xs-12 col-xs-offset-1">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Email Address"
                name="email" value="">
            </div>
            <div class="form-group col-xs-12 col-xs-offset-1">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter Password"
                name="password">
            </div>
            <div class="form-group col-xs-6 col-xs-offset-1">
                <button type="submit" name="submit" value="submit" class="btn btn-success">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
<?php 
    include_once('footer.php');
    if (isset($database)) {
        $database->close_connection();
    } 
?>