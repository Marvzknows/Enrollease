<?php
    
    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $editId = $_POST['editId'];

        $output = '';

        $dataSql = "SELECT * FROM teacher_acc WHERE id='$editId'";
        $dataQuery = mysqli_query($connection,$dataSql);

        if($dataQuery){
            $fetchData = mysqli_fetch_assoc($dataQuery);
            $output .='
            <div class="mb-3">
                <label class="form-label fw-bold">First Name</label>
                <input type="text" name="editFname" id="editFname" value="'.$fetchData['first_name'].'" class="form-control border-dark-subtle">
                <small class="text-danger fw-semibold" id="editFnameError"></small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Middle Name</label>
                <input type="text" name="editMname" id="editMname" value="'.$fetchData['middle_name'].'" class="form-control border-dark-subtle">
                <small class="text-danger fw-semibold" id="editMnameError"></small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Last Name</label>
                <input type="text" name="editLname" id="editLname" value="'.$fetchData['last_name'].'" class="form-control border-dark-subtle">
                <small class="text-danger fw-semibold" id="editLnameError"></small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <input type="password" name="editPassword" id="editPassword" value="'.$fetchData['password'].'" class="form-control border-dark-subtle">
                        <span class="input-group-text" id="showPasswordToggle">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                <small class="text-danger fw-semibold" id="editPasswordError"></small>
            </div>
            ';
        }

        // Display output
        echo $output;
    }
?>