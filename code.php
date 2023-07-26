<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "", "crudbootstrap");

    // insert data
    if(isset($_POST["save_data"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone= $_POST["phone"];
        
        $insert_query = "INSERT INTO test(name, email, phone) VALUES ('$name', '$email', '$phone')";
        $insert_query_run = mysqli_query($connection, $insert_query);

        if($insert_query_run){
            $_SESSION['status'] = "Data inserted successfully.";
            header("Location: index.php");
        }else{
            $_SESSION['status'] = "Insertation of data failed.";
            header("Location: index.php");
        }
    }

    // view data
    if(isset($_POST['click_view_btn'])){
        $id = $_POST['user_id'];
        // echo $id;

        $fetch_query = "SELECT * FROM test WHERE id='$id'";
        $fetch_query_run = mysqli_query($connection, $fetch_query);

        if(mysqli_num_rows($fetch_query_run)> 0){
            while($row = mysqli_fetch_array($fetch_query_run)){
                echo '
                <h6>'.$row['id'].'</h6>
                <h6>'.$row['name'].'</h6>
                <h6>'.$row['email'].'</h6>
                <h6>'.$row['phone'].'</h6>
                ';
            }
        }else{
            echo '<h4>No record found</h4>';
        }
    }

    // edit data
    if(isset($_POST['click_edit_btn'])){
        $id = $_POST['user_id'];
        $arrayresult = [];
        // echo $id;

        $fetch_query = "SELECT * FROM test WHERE id='$id'";
        $fetch_query_run = mysqli_query($connection, $fetch_query);

        if(mysqli_num_rows($fetch_query_run)> 0){
            while($row = mysqli_fetch_array($fetch_query_run)){
                array_push($arrayresult, $row);
                header('content-type: application/json');
                echo json_encode($arrayresult);
            }
        }else{
            echo '<h4>No record found</h4>';
        }
    }

    // update data
    if(isset($_POST['update_data'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $update_query = "UPDATE test SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$id'";
        $update_query_run = mysqli_query($connection, $update_query);

        if($update_query_run){
            $_SESSION['status'] = "Data updated successfully.";
            header("Location: index.php");
        }else{
            $_SESSION['status'] = "Data updated failed.";
            header("Location: index.php");
        }

    }

    //delete data
    if(isset($_POST['click_delete_btn'])){
        $id = $_POST['user_id'];

        $delete_query = "DELETE FROM test WHERE id = '$id'";
        $delete_query_run = mysqli_query($connection, $delete_query);

        if($delete_query_run){
            echo "data deleted successfully.";
        }else{
            echo "Deletion failed.";
        }
    }
?>
