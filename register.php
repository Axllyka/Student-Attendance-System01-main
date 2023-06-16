<?php
include 'Includes/dbcon.php';
session_start();

if (isset($_POST['register'])) {
    $userType = $_POST['userType'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $emailAddress = $_POST['emailAddress'];
    $password = $_POST['password'];
    $password = md5($password);
    // First Update
    $phoneNo = $_POST['phoneNo'];
    $classId = $_POST['classId'];
    $classArmId = $_POST['classArmId'];
    
    // Second Update
    if ($userType == "Administrator") {
        $query = "INSERT INTO tbladmin (firstName, lastName, emailAddress, password, phoneNo, classId, classArmId) 
                  VALUES ('$firstName', '$lastName', '$emailAddress', '$password' '$phoneNo', '$classId', '$classArmId')";
    } else if ($userType == "ClassTeacher") {
        $classId = $_POST['classId'];
        $classArmId = $_POST['classArmId'];

        $query = "INSERT INTO tblclassteacher (firstName, lastName, emailAddress, password, classId, classArmId) 
                  VALUES ('$firstName', '$lastName', '$emailAddress', '$password', '$classId', '$classArmId')";
    } else {
        $error_message = "Invalid User Type!";
    }

    // Third Update
    if (isset($query)) {
        if ($conn->query($query) === TRUE) {
            $_SESSION['userId'] = $conn->insert_id;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['emailAddress'] = $emailAddress;
            $_SESSION['phoneNo'] = $phoneNo;
            $_SESSION['classId'] = $classId;
            $_SESSION['classArmId'] = $classArmId;


            if ($userType == "Administrator") {
                header("Location: Admin/index.php");
            } else if ($userType == "ClassTeacher") {
                header("Location: ClassTeacher/index.php");
            }
            exit();
        } else {
            $error_message = "Error: " . $query . "<br>" . $conn->error;
        }
    }
}

// HTML form to capture user registration details
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../Student-Attendance-System01-main/img/logo/logoBCAS.png" rel="icon">
    <title>AMS BCAS - Register</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-login" style="background-image: url('img/logo/loral1.jpeg');">
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <!-- <h5 class='align-items-center'>STUDENT ATTENDANCE SYSTEM</h5> -->
                                    <h5 align="center">ATTENDANCE MONITORING SYSTEM</h5>
                                    <div class="text-center">
                                        <img src="../Student-Attendance-System01-main/ClassTeacher/img/logo/logoBCAS.png" style="width:100px;height:100px" class="mt-2">
                                        <br><br>
                                        <h1 class="h4 text-gray-900 mb-4">Register Panel</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <select required name="userType" class="form-control mb-3">
                                                <option value="">--Select User Roles--</option>
                                                <!-- <option value="Administrator">Administrator</option> -->
                                                <option value="ClassTeacher">Class Teacher</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="firstName" name="firstName" required class="form-control" id="exampleInputfirstName" placeholder="Enter First Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="lastName" required class="form-control" id="exampleInputlastName" placeholder="Enter Last Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="emailAddress" required class="form-control" id="exampleInputlastName" placeholder="Enter Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control" id="exampleInputPassword" placeholder="Enter Password">
                                        </div>
                                        <!-- Fourth Update -->
                                        <div class="form-group">
                                            <input type="phoneNo" name="phoneNo" required class="form-control" id="exampleInputphoneNo" placeholder="Enter Phone Number">
                                        </div>
                                        <div class="form-group">
                                            <input type="classId" name="classId" required class="form-control" id="exampleInputclassId" placeholder="Enter Class Id">
                                        </div>
                                        <div class="form-group">
                                            <input type="classArmId" name="classArmId" required class="form-control" id="exampleInputClassArmId" placeholder="Enter Class Arm Id">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-block" value="Register" name="register" />
                                        </div>
                                        <div class="form-group">
                                        <div class="mt-2">Already have an account?<a href="index.php" class="ms-2">Login now.</a></div>
                                        </div>
                                    </form>
                                    <?php if(isset($error_message)): ?>
                                        <div class='alert alert-danger' role='alert'>
                                            <?php echo $error_message; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>

</html>
