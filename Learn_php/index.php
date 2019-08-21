<?php
    $server = "localhost";
    $username ="student";
    $password ="goswami12345";
    $db ="learn_php";
    $conn = mysqli_connect($server, $username, $password, $db);


 
    ?>

<html>
    <head>
        <title>Become a Professional Developer</title>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">
    <div class="jumbotron">
    <h2>Simple CRUD (PHP with MySQL)</h2>
    </div>

    <?php
    if ( isset ($_GET['edit_id'])){
        $sql = "SELECT * FROM student WHERE user_id ='$_GET[edit_id]'";
        $run = mysqli_query($conn, $sql);
        while ( $rows = mysqli_fetch_assoc($run) ){ 
         $user = $rows['name'];
         $email = $rows['email'];
         $contact = $rows['contact'];
        }
        ?>

     <h2>Edit the User</h2>
     <form class="col-md-6" method="post">
       <div class="form-group">
         <label>Username</label>
         <input type="text" name="edit_user" value="<?php echo $user;?>" class="form-control" required>
       </div>
       <div class="form-group">
         <label>Email</label>
         <input type="email" name="edit_email" value ="<?php echo $email;?>"class="form-control" required>
       </div>
       <div class="form-group">
         <label>Password</label>
         <input type="password" name="password" class="form-control" required>
       </div>
       <div class="form-group">
         <label>Contact Number</label>
         <input type="text" name="edit_contactnumber" value="<?php echo $contact;?>" class="form-control">
       </div class="form-control">
       <div>
         <input type="hidden" value="<?php echo $_GET['edit_id']?>"; name="Edit_user_id">
         <input type="Submit" value="Done Editng"; name="Edit_user_btn" class="btn btn-primary">
       </div>
     </form>
   <?php } else {?>
        <h2>Registration new User</h2>
        <form class="col-md-6" method="post">
           <div class="form-group">
           <label>Username</label>
           <input type="text" name="user" class="form-control" required>
           </div>
           <div class="form-group">
           <label>Email</label>
           <input type="email" name="email" class="form-control" required>
           </div>
           <div class="form-group">
           <label>Password</label>
           <input type="password" name="password" class="form-control" required>
           </div>
           <div class="form-group">
           <label>Contact Number</label>
           <input type="text" name="contactnumber" class="form-control">
           </div class="form-control">
           <div>
           <input type="Submit" name="submit_user" class="btn btn-danger">
           </div>
        </form>

   <?php }
   
  
   
       $sql = "SELECT * FROM student";
       $run = mysqli_query($conn, $sql);
       /*while ( $rows = mysqli_fetch_assoc($run)){
        echo $rows['name'];
        echo "<br>";
        echo $rows['email'];
        echo "<br>";
       }*/
       echo "
       <table class='table'>
             <thead>
                <tr>
                   <th>S.No</th>
                    <th>Name</th>
                   <th>Email</th>                 
                   <th>Contact</th>
                   <th>Edit</th>
                   <th>Delete</th>
                   
                </tr>
            </thead>
         <tbody>
       ";

       $c = 1;
       while ($rows = mysqli_fetch_assoc ($run) ){
           echo "
                <tr>
                    <td>$c</td>
                    <td>$rows[name]</td>
                    <td>$rows[email]</td>
                    <td>$rows[contact]</td>
                    <td><a href='index.php?edit_id=$rows[user_id]' class='btn btn-success'>Edit</a></td>
                    <td><a href='index.php?del_id=$rows[user_id]'class='btn btn-danger'>Delete</a></td>
                   
                    
                </tr>
           ";
           $c++; 
       }
       echo " </tbody>
              </table>";
        
    ?>
    </div>
    
    </body> 
    </html> 


    <?php
  //Inserting New User
    if ( isset ($_POST ['submit_user']) ) {
         $user = mysqli_real_escape_string($conn, strip_tags($_POST['user']));
         $email = mysqli_real_escape_string($conn, strip_tags( $_POST['email']));
         $password = mysqli_real_escape_string($conn, strip_tags($_POST['password']));
        if (isset( $_POST['contactnumber']) ){
           $contactnumber = mysqli_real_escape_string($conn, strip_tags($_POST['contactnumber']));
        } 

        $ins_sql = "INSERT INTO student(name,email,contact) VALUES ('$user','$email',$contactnumber)";
        if (mysqli_query($conn, $ins_sql) ){ ?>
        <script> window.location ="index.php";</script>
   
        <?php }


    }
    //Deleting New User
        if (isset ($_GET['del_id']) ){
            $del_sql = "DELETE FROM student WHERE user_id = '$_GET[del_id]' ";
            if (mysqli_query ($conn, $del_sql) ){ ?>
            <script> window.location ="index.php"; </script>

           <?php }
     
            }
    
    //Updating or Editing an existing user
    if ( isset($_POST['edit_user_btn']) ){
        $edit_user = mysqli_real_escape_string($conn, strip_tags($_POST['edit_user']));
        $edit_email = mysqli_real_escape_string($conn, strip_tags($_POST['edit_email']));
        $edit_password = mysqli_real_escape_string($conn, strip_tags($_POST['edit_password']));
        $edit_contactnumber = mysqli_real_escape_string($conn, strip_tags($_POST['edit_contact']));
        $edit_id = $_POST['edit_user_id'];
        $edit_sql = "UPDATE student SET name = '$edit_user', email= '$edit_email', password ='$edit_password',
         contact= '$edit_contactnumber' WHERE user_id ='$edit_id' ";
         if (mysqli_query ($conn,$edit_sql) ){ ?>
         <script> window.location ="index.php";</script>
         <?php }
    }
    ?>