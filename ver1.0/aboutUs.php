<?php 
/**
 * @author Adrian
 */
$pageTitle = "About Us - Web USB";

include 'page/partials/base/header.php';

?>

    <div id ="content">

    <div id='cssmenu'>
        <ul>
           <li><a href='device.php'><span>Home</span></a></li>
           <li><a href='aboutUs.php'><span><i><b>About Us</b></i></span></a></li>
           <li><a href='login.php?command=logOut'><span>Log Out</span></a></li>
           
        </ul>
    </div>
    
        <br> <br>    

    
    <div id ="contentBox">  
        
        <b>Information</b>
        <hr>    
        <p>This is an extension for WebUSB API for using USB storage devices over the network.</p> 
        
        
       
        <p><i><div style="padding-left: 5%;width:55%;">"The primary goal of this project is to create a web based application that allows a 
        user to manage their USB storage devices locally and remotely via their home 
        network. ." 
            </div></i></p>
        <br><br><center><img src='information/technologies.png'/></center>  <br> 
             
    </div>

    
    <br><br><hr><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php?command=logOut">Log Out</a>
    
    
</div>  

<?php
include 'page/partials/base/footer.php';
?>

