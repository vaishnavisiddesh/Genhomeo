<?php include 'navbar2.html'; ?>
<?php
require 'config.php';

if(!empty($_SESSION["id"])){
  header("Location: index.php");
}

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO tb_user VALUES('','$name','$username','$email','$password')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration Successful'); </script>";
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <style>
          body{
            
              background:linear-gradient(to right,green,white);
        background-size:100% 100%; 
         
    margin:0;
    padding:0;
    font-family: montserrat;
    
    height:100vh;
    overflow: hidden;
    }
.center{
    position: absolute;
    top:50%;
    left:50%;
    transform: translate(-50%,-50%);
    width: 400px;
    background: white;
    border-radius: 20px;
}
.center h2{
    text-align: center;
    padding:0 0 20px 0;
    border-bottom:1px solid silver;
}
.center form{
    
    padding:0 40px;
    box-sizing:border-box;
}
form.txt_field{
    position: relative;
    border-bottom: 2px solid #adadad;
    margin:30px 0;
}
.txt_field input{
    width:100%;
    padding: 0 5px;
    height:40px;
    font-size: 16px;
    border:none;
    background: none;
    outline: none;
}

.txt_field span::before{
    content:'';
    position: absolute;
    top: 40px;
    left:0;
    width:0%;
    height:2px;
    background: #2691d9;
    transition: .5s;
}
.txt_field input:focus~label,
.txt_field input:valid~label{
    top:-5px;
    color:#2691d9;
}
.txt_field input:focus~span::before,
.txt_field input:valid~span::before{
    width:100%;
}
.reg{
    margin: -5px 0 20px 5px;
    color:#a6a6a6;
    cursor: pointer;
    text-align: center;
}
.reg:hover{
    text-decoration: underline;
    text-align: center;
}
button[type="submit"]{
    width:100%;
    height:50px;
    border:1px solid;
    background: #2691d9;
    border-radius: 25px;
    font-size: 18px;
    color:#e9f4fb;
    font-weight: 700;
    cursor:pointer;
    outline: none;
}
button[type="submit"]:hover{
    border-color:#2691d9;
    transition: .5s;
}
.txt_field label{
    top:50%;
    left:5px;
    color:#adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
    transition: .5s;
}
button[type="button"]{
    width:50%;
    height:50px;
    border:1px solid;
    background: #2691d9;
    border-radius: 25px;
    font-size: 18px;
    color:white;
    font-weight: 700;
    cursor:pointer;
    outline: none;
    
}
input,textarea,label{
    font-size:20px;
    border-radius:10px;
   
}
      </style>
    <meta charset="utf-8">
    <title>Registration</title>
   
  </head>
  <body>
      <div class="center">
    <h2>Registration</h2>
    <form class="" action="" method="post" autocomplete="off">
        
            <label for="name">Name : </label>
         <input type="text" style="width:330px;" name="name" id = "name" required value=""> <br><br>
     
      <label for="username">Username : </label>
      <input type="text" style="width:330px;" name="username" id = "username" required value=""> <br><br>
      
      <label for="email">Email : </label>
      <input type="email" style="width:330px;" name="email" id = "email" required value=""> <br><br>
       
      <label for="password">Password : </label>
      <input type="password"  style="width:330px;" name="password" id = "password" required value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"> <br>
      <center> <pre>*password contains atleast one number,one 
uppercase, one lowercase and 8 charecters or more</pre></center>

      <label for="confirmpassword">Confirm Password : </label>
      <input type="password" style="width:330px;" name="confirmpassword" id = "confirmpassword" required value=""> <br><br><br>
      <button type="submit" style="width:330px;" name="submit">Register</button>
    </form>
    <br>
    <div class="reg">
        <button type="button" style="text-decoration:none;"><a href="login.php">Login</a></button></div></div>
  </body>
</html>

