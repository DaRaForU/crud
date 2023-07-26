<?php 
    session_start();
    include ("includes/header.php"); 
?>

    <!-- Insert Modal -->
    <div class="modal fade" id="insertdata" tabindex="-1" aria-labelledby="insertdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertdataLabel">INSERT DATA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="code.php">

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save_data" class="btn btn-primary">Save Data</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- View model -->
    <div class="modal fade" id="viewusermodal" tabindex="-1" aria-labelledby="viewusermodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewusermodalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="view_user_data">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Eidt model -->
    <div class="modal fade" id="editdata" tabindex="-1" aria-labelledby="editdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editdataLabel">EDIT DATA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="code.php">

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            
                            <input type="hidden" id="user_id" name="id">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_data" class="btn btn-primary">Update Data</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php
                    if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                        echo $_SESSION['status'];

                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Hey! </strong> <?php echo $_SESSION['status'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php

                        unset($_SESSION['status']);
                    }
                ?>

                <div class="card">
                    <div class="card-header">
                        <h4>PHP POP-UP MODEL CRUD- part1</h4>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#insertdata">
                            Insert Data
                        </button>
                    </div>
                    <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">View</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $connection = mysqli_connect("localhost", "root", "", "crudbootstrap");
                                $fetch_query = "SELECT * FROM test";
                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if(mysqli_num_rows($fetch_query_run)> 0){
                                    while($row = mysqli_fetch_array($fetch_query_run)){
                                        ?>
                                            <tr>
                                                <td class="user_id"><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['phone'] ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-info view_data">View</a>
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-success edit_data">Edit</a>
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-danger delete_data">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <tr colspan="4">No Record Found</tr>
                                    <?php
                                }

                            ?>

                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



<?php include("includes/footer.php"); ?>


<script>
    // view data
    $(document).ready(function(){
        $('.view_data').click(function(e){
            e.preventDefault();

            // console.log('hello');

            var user_id = $(this).closest('tr').find('.user_id').text();

            // console.log(user_id);

            $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'click_view_btn': true,
                    'user_id': user_id,
                },
                success: function(response){
                    console.log(response);
                    $('.view_user_data').html(response);
                    $('#viewusermodal').modal('show');
                }
            });
        });
    });

    // edit data
    $(document).ready(function(){
        $('.edit_data').click(function(e){
            e.preventDefault();

            // console.log('hello');

            var user_id = $(this).closest('tr').find('.user_id').text();

            // console.log(user_id);

            $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'click_edit_btn': true,
                    'user_id': user_id,
                },
                success: function(response){
                    // console.log(response);

                    $.each(response, function(key, value){
                        // console.log(value['name']);

                        $('#user_id').val(value['id']);
                        $('#name').val(value['name']);
                        $('#email').val(value['email']);
                        $('#phone').val(value['phone']);
                    });
                    

                    $('#editdata').modal('show');
                }
            });
        });
    });

    // delete data
    $(document).ready(function(){
        $('.delete_data').click(function (e){
            e.preventDefault();
            // console.log('hello');

            var user_id = $(this).closest('tr').find('.user_id').text();
            // console.log(user_id);
            $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'click_delete_btn': true,
                    'user_id': user_id,
                },
                success:function(response){
                    console.log(response);
                    window.location.reload();
                }
            });
        });
    });
</script>