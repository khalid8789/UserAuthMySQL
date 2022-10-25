<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();
    $query = "SELECT * FROM students WHERE email='$email'";
    $value = mysqli_query($conn,$query);

    if(mysqli_num_rows($value) > 0){
        echo '<script>
       alert( "User Already Existed");
        </script>';
         exit;
    } else{
        $insert = "INSERT INTO students (full_names, country, email, gender, password) VALUES ('$fullnames', '$country', '$email', '$gender', '$password')";
        $value = mysqli_query($conn, $insert);
        echo '<script>
        alert("User Successfully registered")
        </script>';
        // header("location: ../forms/login.html");
        }
   
   //check if user with this email already exist in the database
}



//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    $query = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    $value = mysqli_query($conn,$query);

    if($value){
        $user = mysqli_num_rows($value);
        if($user > 0){
            session_start();
            $_SESSION['email'] = $email;
            header("location: ../dashboard.php");
        }else{
            echo '<script>
        alert( "Login Successfully");
          </script>';
            header("Location: ../forms/login.html");
            }
       
    // echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
}
}



function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    // echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    $sql = "SELECT * FROM students WHERE email = '$email' ";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        $newpassword = "UPDATE students SET password ='$password' WHERE email='$email'";
        $newResult = mysqli_query($conn,$newpassword);
        if($newResult){
            echo "Password successfully updated!";
        }else{
            echo " password reset failed";
        }
    }
    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
}


function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</form></td></tr>";
        }
        echo "</table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     $delete = mysqli_query($conn, "DELETE  FROM `students` WHERE id = $id");
     //delete user with the given id from the database
 }

 
