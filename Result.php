<?php
session_start();
if(!isset($_SESSION['user']))
       header("location: index.php?Message=Login To Continue");
?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/my.css" type="text/css">
<body>
<style>

        #books .row{margin-top:30px;font-weight:800;}
        @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}
        .book-block {margin-top:20px;margin-bottom:10px; padding:10px 10px 10px 10px; border :1px solid #DEEAEE;border-radius:10px;height:100%;}
</style>

</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
             </button>
            <a class="navbar-brand" href="index.php" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="img/logo.jpg"  style="width: 147px;margin: 0px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <?php
            if(!isset($_SESSION['user']))
              {
                echo'
                <li>
                    <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Login</button>
                      <div id="login" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center">Login Form</h4>
                                </div>
                                <div class="modal-body">
                                  <ul >
                                    <li>
                                      <div class="row">
                                          <div class="col-md-12 text-center">
                                              <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                                  <div class="form-group">
                                                      <label class="sr-only" for="username">Username</label>
                                                      <input type="text" name="login_username" class="form-control" placeholder="Username" required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="sr-only" for="password">Password</label>
                                                      <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
                                                      <div class="help-block text-right">
                                                          <a href="#">Forget the password ?</a>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <button type="submit" name="submit" value="login" class="btn btn-block">
                                                          Sign in
                                                      </button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                      </div>
                </li>
                <li>
                  <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Sign Up</button>
                    <div id="register" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title text-center">Member Registration Form</h4>
                              </div>
                              <div class="modal-body">
                                <ul >
                                  <li>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                                <div class="form-group">
                                                    <label class="sr-only" for="username">Username</label>
                                                    <input type="text" name="register_username" class="form-control" placeholder="Username" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="submit" value="register" class="btn btn-block">
                                                        Sign Up
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                          </div>
                      </div>
                    </div>
                </li>';
              } 
            else
                echo' <li> <a href="destroy.php" class="btn btn-lg"> LogOut </a> </li>';
            ?>

        </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div id="top" >
      <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
          <div>
              <form role="search" method="POST" action="Result.php">
                  <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Search for a Book , Author Or Category">
              </form>
          </div>
      </div>
<?php
include "dbconnect.php";
$keyword=$_POST['keyword'];

$query="select * from products  where PID like '%{$keyword}%' OR Title like '%{$keyword}%' OR Author like '%{$keyword}%' OR Publisher like '%{$keyword}%' OR Category like '%{$keyword}%'";
$result=mysqli_query($con,$query) or die(mysqli_error($con));;

    $i=0;
    echo '<div class="container-fluid" id="books">
        <div class="row">
          <div class="col-xs-12 text-center" id="heading">
                 <h4 style="color:#00B9F5;text-transform:uppercase;"> found  '. mysqli_num_rows($result) .' records </h4>
           </div>
        </div>';
        if(mysqli_num_rows($result) > 0) 
        {   
            while($row = mysqli_fetch_assoc($result)) 
            {
            $path="img/books/" .$row['PID'].".jpg";
            $description="description.php?ID=".$row["PID"];
            if($i % 3 == 0)  $offset= 0;
            else  $offset= 1; 
            if($i%3==0)
            echo '<div class="row">';
            echo'
               <a href="'.$description.'">
                <div class="col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-'.$offset.' col-lg-3 text-center w3-card-8 w3-dark-grey">
                    <div class="book-block">
                        <img class="book block-center img-responsive" src="'.$path.'">
                        <hr>
                         ' . $row["Title"] . '<br>
                        ' . $row["Price"] .'  &nbsp
                        <span style="text-decoration:line-through;color:#828282;"> ' . $row["MRP"] .' </span>
                        <span class="label label-warning">'. $row["Discount"] .'%</span>
                    </div>
                </div>
                
               </a> ';
            $i++;
            if($i%3==0)
            echo '</div>';
            }
        }
    echo '</div>';
?>


</body>
</html>		