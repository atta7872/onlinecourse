<?php
session_start();
include('includes/config.php');

if(isset($_SESSION['alogin']) && strlen($_SESSION['alogin']) == 0) {   
    header('location:session.php');
} else {
    if(isset($_POST['submit'])) {
        $session = $_POST['session'];
        $ret = mysqli_query($bd, "INSERT INTO session(session) VALUES('$session')");
        if($ret) {
            $_SESSION['msg'] = "Session Created Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Session not created";
        }
    }

    if(isset($_GET['del'])) {
        mysqli_query($bd, "DELETE FROM session WHERE id = '".$_GET['id']."'");
        $_SESSION['delmsg'] = "Session deleted !!";
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Session</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
        .btn-danger {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>
   
    <?php if(isset($_SESSION['alogin']) && $_SESSION['alogin'] != "") {
        include('includes/menubar.php');
    }
    ?>
   
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Add session  </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Session
                        </div>
                        <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                        <div class="panel-body">
                            <form name="session" method="post">
                                <div class="form-group">
                                    <label for="session">Create Session </label>
                                    <select name="session" id="session" class="form-control">
                                        <option value="" disabled selected>Select Session</option>
                                        <option value="fall">Fall</option>
                                        <option value="spring">Spring</option>
                                        <option value="summer">Summer</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn-success" style="border-radius: 10px; padding: 2px 15px; align-items: center;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Session
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Session</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                    <?php
                                    $sql = mysqli_query($bd, "SELECT * FROM session");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($sql)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php echo htmlentities($row['session']);?></td>
                                        <td><?php echo htmlentities($row['creationDate']);?></td>
                                        <td>
                                            <a href="session.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $cnt++;
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include('includes/footer.php');?>
    
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
