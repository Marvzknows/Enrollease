<?php
session_start();
include '../database/dbcon.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    // Email availability checking
    $sql = "SELECT * FROM teacher_acc where email='$email'";
    $query = mysqli_query($connection, $sql);

    if (mysqli_num_rows($query) > 0) {
        echo 'ERROR : Email is already taken';
        exit();
    } else {
        $id_name = 'TCH-';
        $teacher_id = $id_name . (mt_rand(100000, 999999));
        $sql = "INSERT INTO teacher_acc (teacher_id, first_name, last_name, middle_name, contact_number, gender, birthday, email, password)
                VALUES ('$teacher_id','$fname','$lname','$mname','$contactNumber','$gender','$birthday','$email','$password')";
        $query = mysqli_query($connection, $sql);

        if ($query) {
            echo 'Successfully Registered!';
            // $_SESSION['teacher_login'] = true;
            // $_SESSION['incomplete_form'] = 'Registration Successfully';
            // header('location: ../teacherLogin.php');
        } else {
            echo 'ERROR : Registration Failed, Try again later,';
            // $_SESSION['incomplete_form'] = 'Something is wrong, Please try again';
            // header('location: ../teacherLogin.php');
        }
    }

}else{
    echo 'ERROR: Request Method do not match';
}
// if(isset($_POST['email'])){
//     

//     // register button execution
//     if(isset($_POST['register_btn'])){

//         $fname = $_POST['fname'];
//         $mname = $_POST['mname'];
//         $lname = $_POST['lname'];
//         $number = $_POST['contact_number'];
//         $email = $_POST['email'];
//         $password = $_POST['password'];
//         $gender = $_POST['gender'];
//         $birthday = $_POST['birthday'];
    
//         if(empty($fname) || empty($lname) || empty($number) || empty($email) || empty($password) || empty($gender) || empty($birthday)){
//             $_SESSION['incomplete_form'] = 'Please Complete the registration form';
//             header('location: ../teacherLogin.php');
//         }else{
//             $sql = "SELECT * FROM teacher_acc WHERE email='$email'";
//             $query = mysqli_query($connection,$sql);
//             if(mysqli_num_rows($query) > 0){
//                 $_SESSION['incomplete_form'] = 'Email is already taken';
//                 header('location: ../teacherLogin.php');
//             }
//             else
//             {
//                 $id_name = 'TCH-';
//                 $teacher_id = $id_name . (mt_rand(100000, 999999));
//                 $sql = "INSERT INTO teacher_acc (teacher_id, first_name, last_name, middle_name, contact_number, gender, birthday, email, password)
//                 VALUES ('$teacher_id','$fname','$lname','$mname','$number','$gender','$birthday','$email','$password')";
//                 $query = mysqli_query($connection, $sql);

//                 if ($query) {
//                     $_SESSION['teacher_login'] = true;
//                     $_SESSION['incomplete_form'] = 'Registration Successfully';
//                     header('location: ../teacherLogin.php');
//                 }
//                 else{
//                     $_SESSION['incomplete_form'] = 'Something is wrong, Please try again';
//                     header('location: ../teacherLogin.php');
//                 }
//             }
//         }
//     }
    
// }


?>


