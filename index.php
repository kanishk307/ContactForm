<?php
$msg = '';
$msgClass= '';
if(filter_has_var(INPUT_POST, 'submit')){
//     echo "submitted";
//    get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    if(!empty($name) && !empty($email) && !empty($message)){
        //passed
        //checking for email
        if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            $msg = 'Please fill all fields correctly';
            $msgClass = 'alert-danger';
        } else{
//             echo 'Passed';
               //Recipient email
               $toEmail = "ysj30797.kj@gmail.com";
               $subject = "Contact request from $name";
               $body = "<h2>Contact Request</h2>
               <h4>Name : $name</h4>
                <h4>Email : $email</h4> 
                 <h4>Message : $message</h4>";
               
               // Setting email headers here
               $headers = "MIME-Version: 1.0" ."\r\n";
               $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";
               
               // Additional Headers
               $headers .= "From: " .$name. "<".$email.">". "\r\n";
        } 
     
         
         
    if(mail($toEmail, $subject, $body,$headers)){
        $msg = 'Thank you for sending your details. We will respond soon.';
        $msgClass = 'alert-success';
    }else{
        $msg = 'You email was not sent';
        $msgClass = 'alert-danger';
    }
    }
    else{
        //failed
        $msg = 'Please fill all fields correctly';
        $msgClass = 'alert-danger';
    }
    
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact form</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/slate/bootstrap.min.css">
</head>
<body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./index.php">Contact Form </a>
                </div>
            </div>
        </nav>

        <div class="container" style="margin: 50px auto; width:30%; ">
          <?php if($msg != ''):?>
          	<div class="alert <?php echo $msgClass;?>"><?php echo $msg;?></div>
          <?php endif;?>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo isset($name)? $name : ''; ?>">
                    
                </div>

                <div class="form-group">
                    <label for="email">Email  </label>
                    <input type="text" name="email" class="form-control"  value="<?php echo isset($email)? $email : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                   <textarea name="message"  cols="30" rows="10" class="form-control"><?php echo isset($message)? $message : ''; ?></textarea>
                </div>

                <div class="form-group">
                  <button type="submit" name="submit">Submit</button>
                </div>

            </form>
        </div>  
</body>
</html>