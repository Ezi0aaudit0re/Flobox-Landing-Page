<?php
  session_start();

  /*-- code for detecting mobile devides --*/
  require_once "Mobile_Detect.php";
  $detect = new Mobile_Detect;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
</head>
<body>
  
    <!-- Navbar !-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                 
                <a class="navbar-brand" href="#">FloBox</a>
            </div>
            <?php
                if(!$detect->isMobile()) 
                {
            ?>
            <h5 id="banner" class="navbar-text">JOIN TODAY TO WIN A YEAR’S FREE SUBSCRIPTION ! </h5>
            <?php } ?>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#about">About us</a></li>
                    <li><a href="#contact">Contact us</a></li>
                </ul>
            </div>
        </div>    
    </nav>
    <?php if($detect->isMobile()) { ?>
        <div class="navbar navbar-fixed-bottom navbar-inverse footer" >
                <h5 style="color: #5bc0de">JOIN TODAY TO WIN A YEAR’S FREE SUBSCRIPTION ! </h5>
        </div> 
    <?php }?>    
  <!-- Background image div !-->
    <div id="first-image">
        <div id="name">
            <span id="bold">FloBox:</span><br>
            <?php
            if(!$detect->isMobile()) 
            {
            ?>
            <span id="light">Your monthly surprise for body and mind. </span><br>
            <?php } 

            if(!isset($_SESSION["message"]))    
            {
            ?>    
            <div id="form">
                <form action="./mailgun_validations/validation.php" method='post'>
                    <input type="text" placeholder="FULL NAME" name="name"><br>
                    <input type="email" placeholder="EMAIL" name="email"><br>
                    <input type="submit" class="btn btn-info" style="font-size: 20px;">
                </form> 
            </div>
            <? } 
            else
            { ?>
             <div class="alert alert-success">
                    <h3> <?=$_SESSION["message"]?> </h3>
             </div>   
            <? 
             session_destroy();   
            } ?>
        </div>      
        <div id="arrow">
            <img src="./scrool.png" height="60px" width="60px">
        </div>
    </div>    

  
    
  
   <!-- About us div !-->
   <div id="info" class="container">
        <div class="col-md-5 pull-left" id="about">
            <h2>About us</h2>
            <p>Every month, you’ll explore funky novelties, minimalistic yet fashion forward accessory, luxury chocolate bars, bath and body essential, and exotic tea flavours with your customised sanitary necessities.</p> 
            <h3>Care package for your chums, delivered. </h3>
        </div>
        <div class="col-md-5 <?php if(!$detect->isMobile()) echo "pull-right"; ?>" id="contact">
            <h2>Contact us</h2>
            <p>Drop us an email at</p>
        </div>
   </div>     

</body>
</html>
