<?php
    //connect to db server
    require_once('dbconnect.php');
    //start of session
    session_start();

    // collect form data and Escape special characters, if any.
    $username = mysqli_real_escape_string($con, $_POST['username']) ;
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cfm_password = mysqli_real_escape_string($con, $_POST['confirmpassword']);
    
    $errors = array();
    //check if inputs are empty
    if(empty($username)) {array_push($errors, "Username is empty!");}
    if(empty($firstname)) {array_push($errors, "Firstname is empty!");}
    if(empty($lastname)) {array_push($errors, "Lastname is empty!");}
    if(empty($password)) {array_push($errors, "Password is empty!");}
    if($password != $cfm_password){array_push($errors, "Password does not match!");}

    //if username is inputed
    if(!empty($username)){
        // Create a prepared statement
        $stmt = $con->prepare("SELECT username FROM users WHERE username=? LIMIT 1");
        // Bind parameters
        $stmt->bind_param('s', $username);
        // Execute query
        $stmt->execute();
        // Bind result variables
        $stmt->bind_result($username);
        // Close statement
        $stmt->store_result();
    //check if username already registered stored using the prepared statement
        if($stmt->num_rows == 1){
            array_push($errors, "username is already registered");
            $stmt->close(); 
        }
    }
    //execute if array is empty or no error 
    if(count($errors)==0){
        //creates a hash 
        $password = password_hash($cfm_password, PASSWORD_BCRYPT);
        $stmt = $con->prepare("INSERT INTO users(username, firstname, lastname, password ) VALUES (?,?,?,?)");
        $stmt->bind_param('ssss ', $username,  $firstname,  $lastname,  $password);
        $stmt->execute();
        /* Redirect the browser and a superglobal var ($GET) in the signup.php can fetch the success var containing
           a string*/
        header("location:../html/signup.php?Success= Successfully Registered!");
    }
    // The below code does not get executed  
    // while redirecting 
    else{
        header("location:../html/signup.php?Error= $errors[0]");
    }
?>
