<?php

/**
 * @author Adrian
 */
include 'class/LoginView.class.php';
//include 'page/partials/base/header.php';
?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>

<div id="loginBox" class="login">
    <h1>Login</h1>
    <form action="login.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="submit" />
        <input name="username" placeholder="Username" type="text" value="" size="30" />
        <input name="password" type="password" placeholder="Password" value="" size="30" />
        <input type="submit" class="myButton btn btn-primary btn-block btn-large" value="Login" />
    </form>

</div>

<script src="js/login.js"></script>
<?php
include 'page/partials/base/footer.php';
?>