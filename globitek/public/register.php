<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database
?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

    <?php
        $err_arr = [];
        if(isset($_POST['submit'])) {
            //first_name validation
            $error = 0;
            $first_name = $_POST['firstname'];
            if(isset($_POST['firstname']) && !is_blank($first_name)) {
                if(!has_length($first_name, [1,256])) {
                    $error = 1;
                    array_push($err_arr, "First name must be between 2 and 255 characters.");   
                }
            }
            else {          
                $error = 1;
                array_push($err_arr, "First name cannot be blank.");
            }
            
            $last_name = $_POST['lastname'];
            if(isset($_POST['lastname']) && !is_blank($last_name)) {
                if(!has_length($last_name, [1,256])) {
                    $error = 1;
                    array_push($err_arr, "Last name must be between 2 and 255 characters.");   
                }
            }
            else {            
                $error = 1;
                array_push($err_arr, "Last name cannot be blank.");
            }
            
            $email = $_POST['email'];
            if(isset($_POST['email']) && !is_blank($email)) {
                if(!has_valid_email_format($email)) {
                    $error = 1;
                    array_push($err_arr, "Email must be valid email.");   
                }
            }
            else {            
                $error = 1;
                array_push($err_arr, "Email cannot be blank.");
            }
            
            $username = $_POST['username'];
            if(isset($_POST['username']) && !is_blank($username)) {
                if(!has_length($username, [7,256])) {
                    $error = 1;
                    array_push($err_arr, "Username must be between 8 and 255 characters.");   
                }
            }
            else {            
                $error = 1;
                array_push($err_arr, "Username cannot be blank.");
            }
            
            if(!$error) {
            // Write SQL INSERT statement
                $first_name = h($first_name);
                $last_name = h($last_name);
                $email = h($email);
                $username = h($username);
                $date = date("Y-m-d H:i:s");
                $sql = "INSERT INTO globitek.users (first_name, last_name, email,username,created_at) VALUES('$first_name','$last_name','$email','$username','$date')";

              // For INSERT statments, $result is just true/false
                $result = db_query($db, $sql);
                if($result) {
                    db_close($db);
                    header("Location: registration_success.php");
                    exit;
                } 
                else {
                    echo db_error($db);
                    db_close($db);
                    exit;
                }
            }
            echo display_errors($err_arr);
        }
    
    ?>
  <!-- TODO: HTML form goes here -->

    <form method="post" action="register.php">
        First name:<br>
        <?php
            $first_name = "";
            if(isset($_POST['submit'])) {
                $first_name = $_POST['firstname'];
            }
            echo '<input type="text" name="firstname" value= "' .$first_name.'" class="first_name"><br>'
        ?>
        Last name:<br>
        <?php
            $last_name = "";
            if(isset($_POST['submit'])) {
                $last_name = $_POST['lastname'];
            }
            echo '<input type="text" name="lastname" value= "' .$last_name.'" class="last_name"><br>'
        ?>
        Email:<br>
        <?php
            $email = "";
            if(isset($_POST['submit'])) {
                $email = $_POST['email'];
            }
            echo '<input type="text" name="email" value= "' .$email.'" class="email_class"><br>'
        ?>
        Username:<br>
        <?php
            $username = "";
            if(isset($_POST['submit'])) {
                $username = $_POST['username'];
            }
            echo '<input type="text" name="username" value= "' .$username.'" class="user_class"><br>'
        ?>
        <br>
        <input class="submit" type="submit" name="submit">
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
