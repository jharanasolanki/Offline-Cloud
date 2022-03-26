
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>

    <div id ="loginBox" class="login">
    <h1>Share</h1>
        <form  id ="myform" action="register.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="submit"/> 

                    <input name="username" placeholder="Username" type="text" value="" size="30"/>
                    <input name="firstName" placeholder="First Name" type="text" title = "No special characters except underscores and spaces "value="" size="30"/> 
                    <input name="lastName" placeholder="Last Name" type="text" value="" size="30"/> 
                    <input name="email" placeholder="Email" type="text" value="" size="30"/> 
                    <input name="password" placeholder="Password" type="password" value="" size="30"/> 
                    <input name="confirmPassword" placeholder="Confirm Password" type="password" value="" size="30"/>

                    <input type="submit" class="myButton btn btn-primary btn-block btn-large" value="Register"/>
            </form>
    </div>

    <br><br><hr><br>
    <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php">Login</a>    -->
    
</div>  
<script src="js/login.js"></script>
<?php
//include 'page/partials/base/footer.php';
?>