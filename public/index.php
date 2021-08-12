<?php

    session_start();
    
    if(!isset($_SESSION['user_info']))
    {
        
        header("Location: /public/login.php");
    }
    $create_date = strtotime($_SESSION['user_info']['created_at']);
    $update_date = strtotime($_SESSION['user_info']['updated_at']);
    $create_time = date('g:i a',$create_date);
    $update_time = date('g:i a',$update_date);
    $create_date = date('d-M-Y',$create_date);    
    $update_date = date('d-M-Y',$update_date);
    include_once '../layouts/header.php';
    include_once '../layouts/navbar.php';
?>    

    <div class="row">
        <div class="col-lg-6 pt-5">
            <div class="card" id="userInfo">
                <div class="card-header">
                    <h4 class="text-info">User Profile</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td><b>Name : </b></td>
                            <td><?= $_SESSION['user_info']['name'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Email :</b> </td>
                            <td><?= $_SESSION['user_info']['email'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Registered On : </b></td>
                            <td><?= $create_date." at $create_time"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Last Updated On : </b></td>
                            <td><?= $update_date." at $update_time" ; ?></td>
                        </tr>
                       
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php

    include_once '../layouts/footer.php';
?>

