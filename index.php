<?php


if (isset($_GET["submit-data"])) {
        
    $errors = NULL;
    $valid = false;
    
    // validate the fullname
    if (trim($_GET["fullname"])) {
        $fn = filter_var($_GET["fullname"], FILTER_SANITIZE_STRING);
    } else {
         $_GET["fullname"] = NULL;
        $errors .= "<p>Your name?</p>";
    }
    
    // here you want to do the same thing for your email
    if (trim($_GET["email"])) {

        if (filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
            $em = $_GET["email"];
        } else {
            // remove the email from $_GET array
            $_GET["email"] = NULL;
            
            // create error-message
            $errors .= "<p>Invalid email!</p>"; 
        }
    } else {
        $errors .= "<p>Email?</p>";
    }
    
    // here you want to do the same thing for your message
    if ($_GET["message"]) {
        $msg = $_GET["message"];
    } else {
        $_GET["message"] = NULL;
        $errors .= "<p>Your message?</p>";
    }
    
    // Create the feedback
    if (isset($fn) && isset($em) && isset($msg)) {
        $valid = true;
        $feedback = "<p>Hello {$fn}. Thank you for your message: <br>{$msg}. <br>We are going to email you at {$em} if any change happends in your program.</p>";
    }   
}
?>

<!--HTML FILE-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Bitter|Bree+Serif|Roboto" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title>Form</title>
    </head>
    <body>
       <div class="wrapper">
       <div class="masthead" style="position:relative;">
          <img src="img/1.jpeg" class="mastheadimg" />
          <div class="mtext">Doris Visual Studio</div>
       </div>

       <nav>
			<ul>
              <li><a class="active" href="#home">Home</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
		</nav>
         
        <form action="index.php" method="get">
            <fieldset>
                <legend>Form Assignment</legend>
                <div class="info">
                    <label for="fullname">Full name</label>
                    <input type="text" name="fullname" id="fullname" value="<?php if (isset($valid) && !$valid) { echo $_GET["fullname"]; } ?>">
                </div>
                <div class="info">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php if (isset($valid) && !$valid) { echo $_GET["email"]; } ?>">
                </div>
                <div class="box cleafix">
                    <label for="message">Message</label>
                    <textarea name="message" id="message"><?php if (isset($valid) && !$valid) { echo $_GET["message"]; } ?></textarea>
                </div>
                <div class="btn">
                    <input type="submit" value="Submit" name="submit-data" id="btn">
                </div>
            </fieldset>
        </form>
        <?php
        // Do your printing here
        // if feedback exists, print it
        if (isset($feedback)) {
            echo $feedback;
        }
        
        if (isset($errors)) {
            echo $errors;
        }
        ?>
        <footer>
           <div class="icons">
                <a href="http://www.facebook.com" class="fa fa-facebook"></a>
                <a href="http://www.twitter.com" class="fa fa-twitter"></a>
                <a href="http://www.google.com" class="fa fa-google"></a>
                <a href="http://www.linkedin.com" class="fa fa-linkedin"></a>
           </div>
           <div class="company">
               <p class="com_name">Doris Visual Studio</p>
               <p>Algonquin College, 1385 Woddroffe Aveue, Ottawa, Ontario, K2G 3R7</p>
               <p>Phone No: 123-456-789</p>
            </div>
        </footer>
        </div>
    </body>
</html>