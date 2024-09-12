<?php
    require '../database/dbcon.php';
    header('Content-Type: application/json');


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $teacherId = $_POST['teacherId'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $password = $_POST['password'];
        
        $sql = "INSERT INTO teacher_acc (teacher_id, first_name, last_name, middle_name, password) 
        VALUES ('$teacherId','$fname','$lname','$mname','$password')";
        $query = mysqli_query($connection,$sql);

        if($query) {

            $last_id = mysqli_insert_id($connection); //GET THE LAST ID (Yung auto-increment)

            $employeeId = 'EmployeeID-'.$last_id;

            $sqlUpdate = "UPDATE teacher_acc SET emp_id ='$employeeId' WHERE id='$last_id'";
            $queryUpdate = mysqli_query($connection,$sqlUpdate);

            if($queryUpdate) {

                $data = [
                    'status' => 'success',
                    'message' => 'New Teacher Successfully Added.'
                ];
        
                echo json_encode($data);
                exit();
                
            }else{

                $data = [
                    'status' => 'failed',
                    'message' => 'Inserting Data failed.'
                ];
        
                echo json_encode($data);
                exit();
            }

        }else {
            $data = [
                'status' => 'failed',
                'message' => 'Inserting Data failed.'
            ];
    
            echo json_encode($data);
            exit();
        }

    }
