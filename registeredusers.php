
<html>
    <head>
        <title>
            billing php
        </title>
         <style>
             table{
                 padding:20px;
                 font-size:30px;
             }
             tr{
                 padding:30px;
             }
             td{
                 padding:30px;
             }
             body{
                 background:linear-gradient(to left,lightgreen,white);
                 background-size:100% 100%;
             }
    </style>
    </head>
   
    <body>

         <?php
      $i = 1;
     $conn = mysqli_connect("aws-simplified.cr4ooq6sa891.eu-north-1.rds.amazonaws.com", "admin", "nithya2002", "reglog");
      $rows = mysqli_query($conn, "SELECT * FROM tb_user");
      ?>
    <center><h1>Registered users are</h1></center>
<?php foreach ($rows as $row) : ?>
        <table border="1">
           
            <tr>
               
             <th>Name</th>
            <th>Username</th>
             <th>Email</th>
         
             </tr>
            <tr>
                <td> <?php echo $row["name"]; ?></td>
            <td> <?php echo $row["username"]; ?></td>
           <td> <?php echo $row["email"]; ?></td>
          
           </tr>
            
         </table>
      <?php endforeach; ?>
       

         
    </body>
</html>


