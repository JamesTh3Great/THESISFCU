<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
            <title>Registration Form</title>
            <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div>
    <?php
    if(isset($_POST['create'])){
        $firstname     =$_POST['firstname'];
        $lastname      =$_POST['lastname'];
        $email         =$_POST['email'];
        $phonenumber   =$_POST['phonenumber'];
        $password      =$_POST['password'];
    
        $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password) VALUES(?,?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $password]);
        if($result){
            echo 'Successfully Saved';
        }else{
            echo 'There were error while saving the date';
        }

    }
    ?>
</div>

<div>
    <form action="registration.php" method="post">
        <div class="container">

            <div class="row">
                <div class="col-sm-3"> 
                        <h1>Registration Form</h1>
                        <p>Fill up the form with correct values.</p>
                        <hr class="mb-3">
                        <label for="firstname"><b>First Name</b></label>
                        <input type="text" id="firstname" name="firstname" required>

                        <label for="lastname"><b>Last Name</b></label>
                        <input type="text" id="lastname" name="lastname" required>

                        <label for="email"><b>Email Address</b></label>
                        <input type="email" id="email" name="email" required>

                        <label for="phonenumber"><b>Phone Number</b></label>
                        <input type="text" id="phonenumber" name="phonenumber" required>

                        <label for="password"><b>Password</b></label>
                        <input type="password" id="password" name="password" required>
                        <hr class="mb-3">    
                        <input class="btn btn-success" type="submit" id="register" name="create" value="Sign Up">
                </div>
            </div>
        </div>
    </form>    
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(function(){
            $('#register').click(function(e){

                var valid = this.form.checkValidity();

                if(valid){

                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
                var email = $('#email').val();
                var phonenumber = $('#phonenumber').val();
                var password = $('#password').val();

                    e.preventDefault();

                    $.ajax({
                        type: 'Post',
                        url: 'process.php',
                        data: {firstname: firstname,lastname: lastname,email: email,phonenumber: phonenumber,password: password},
                        success: function (data){

                        Swal.fire({
                            'title': 'Succesful',
                            'text': data,
                            'type': 'success' 
                                  }) 
                        },
                        error: function (data){
                            Swal.fire({
                            'title': 'Errors',
                            'text': 'There were error while saving the data.',
                            'type': 'error' 
                                  })   
                        }

                    });
                                  
                }  
        });   
    });
    //cids
</script>

</body>
</html>