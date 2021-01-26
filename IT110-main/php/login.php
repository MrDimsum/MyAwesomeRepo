<?php 
//connect to db server
require_once('dbconnect.php');
//start of session to store information (in variables) to be used across multiple pages
session_start();
        //collect data and stored in their specific variables
        $username = $_POST['username'];
        $password = $_POST['password'];
        $newhash ="";
        /*if user did'nt input user and pass, the superglobal var $GET['Empty'] in the login.php can
         fetch the  variable empty in the header function.*/
        if(empty($username) || empty($password)){
            //Redirect the browser
            header("location:../html/login.php?Empty= You did not input anything!");
        }
        else{
            $stmt = $con->prepare("SELECT user_id, firstname, lastname, username, password FROM users WHERE username=? LIMIT 1");
            $stmt->bind_param('s', $username);
            //execute query
            $stmt->execute();

            $stmt->bind_result($user_ID, $firstname, $lastname, $username, $hash);
            /* store result */
            $stmt->store_result();
           
            if($stmt->num_rows == 1){
                //fetch data, the MySQL client/server protocol places the data for the bound columns into the specified variables 
                while($stmt->fetch()){
                
                    if(password_verify($password, $hash)){
                        // Set session variables to be use in index.php
                        $_SESSION['user_id']=$user_ID;
                        $_SESSION['firstname']=$firstname;
                        $_SESSION['lastname']=$lastname;
                        //redirect browser
                        header("location:../index.php");
                    }
                    else{
                         /*Redirect the browser and a superglobal var ($GET) in the signup.php can fetch 
                         the invalid var containing a string*/
                    header("location:../html/login.php?Invalid= Incorrect Password!");     
                    }
                }
            }

            else{
                header("location:../html/login.php?Invalid= Username not found!");
            }
                
            $stmt->close();           
        } 
    

?>
