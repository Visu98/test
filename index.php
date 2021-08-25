<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css"> 
    <title>Demo</title>
  </head>
  <body>
      <?php
      require 'database.php';
    session_start();
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $sql = "SELECT * FROM admin WHERE username = '$username' AND passwd = '$password'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) ==0){
        header (location:'login.php');
    }
    //For add the menu
    if (isset($_POST['add_menu'])){
        $menu_name = $_POST["menu"];
        $url = $_POST["url"];
        $add_Query = "INSERT INTO `menu` (`Menu_name`, `parent`, `child`,`url`) VALUES ($menu_name,'0','0',$url)";
        $Fire_Add_Query = mysqli_query($conn,$add_Query);
        if ($Fire_Add_Query){
            echo "<script>alert('add succesfully')</script>";
        }else{
            echo "<script>alert('fail')</script>";
        }
    }
    ?>
<!-- Menu bar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
	<a class="navbar-brand" href="">Brand</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse bg-dark" id="navbarCollapse">
    <?php
    $manu_select = "SELECT * FROM `menu` WHERE 1";
    $Fire_Query_menu = mysqli_query($conn,$manu_select);
    $Rows_menu = mysqli_num_rows($Fire_Query_menu);
    echo '<ul class="navbar-nav mr-auto">';
    if ($Rows_menu > 0 ){
        foreach ($Fire_Query_menu as $menu){
			echo '<li class="nav-item active">
				<a class="nav-link" href="#">'.$menu['Menu_name'].'</a>
			</li>';
			
        }
    }
		echo "</ul>";
    ?>
		
	  </div>
    </nav>

    <!-- Here menu add code comes -->
    <div class="container-fluid container mt-3 background-container">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item">Menu</li>
            </ol>
</div>
<div class="container-fluid container mt-3 background-container">
    <div class="row mx-auto">
<div class="Menu Title shower form-group m-1 border col-4">
    <h3>Menu</h3>
    <form action="" method="post">
    <div class="form-group">
        <label for="menuname" class="text-info">Menu Title:</label><br>
        <input type="text" name="menu" class="form-control">
    </div>  
    <div class="form-group">
        <label for="url" class="text-info">Custom Url:</label><br>
        <input type="text" name="URL" class="form-control">
    </div>
    <div class="form-group">
        
        <input type="submit" name="add_menu" class="btn btn-info btn-md" value="add">
    </div>
    </form>
</div>
<div class="Menu Title shower form-group m-1 border col-7">
    <h3>Navigator</h3>
    <form action="" method="post">
    <div class="form-group">
        <select name="parent_1" id="">
            <option value="parent1">parent1</option>
        </select>
        <div class="form-group mt-3">
        <select class="ml-5" name="p1_child_1" id="">
            <option value="parent1">Child 11</option>
        </select>

        <select class="ml-5"  name="p1_child_2" id="">
            <option value="parent1">Child 12</option>
        </select></div>
    </div>  
    <div class="form-group">
    <div class="form-group">
        <select name="parent_1" id="">
            <option value="parent1">parent 2</option>
        </select>
        <div class="form-group mt-3">
        <select class="ml-5" name="p2_child_1" id="">
            <option value="parent1">Child 21</option>
        </select>

        <select class="ml-5"  name="p2_child_2" id="">
            <option value="parent1">Child 22</option>
        </select></div>
    </div>  
    <div class="form-group">
        
        <input type="submit" name="submit" class="btn btn-info btn-md" value="add">
    </div>
    </form>
</div>
</div>




</div>
</body>
</html>
