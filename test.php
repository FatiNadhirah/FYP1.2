<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Fatin Nadhirah">
    <title>Fatin Nadhirah</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"
        integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="style.css" />
</head>

<body class="text-center">
    <header class="py-3 mb-3 border-bottom">
        <div class="container-fluid d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
            <div class="dropdown">
                <a href="#"
                    class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none dropdown-toggle"
                    id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="um.png" class="bi me-2 img-thumbnail" width="40" height="40" />
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownNavLink">
                    <li><a class="dropdown-item active" href="#" aria-current="page">Overview</a></li>
                    <li><a class="dropdown-item" href="#">Inventory</a></li>
                    <li><a class="dropdown-item" href="#">Customers</a></li>
                    <li><a class="dropdown-item" href="#">Products</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Reports</a></li>
                    <li><a class="dropdown-item" href="#">Analytics</a></li>
                </ul>
            </div>

            <div class="d-flex align-items-center">
                <form class="w-100 me-3">
                    <!-- <input type="search" class="form-control" placeholder="Search..." aria-label="Search"> -->
                </form>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="user.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="menu.php">Home</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="index.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

<?php require_once 'process.php'; 
       // $id = $_GET['id' == 1]; 
?>

<?php 
$result = mysqli_query($mysqli, "SELECT * FROM question WHERE id=1");
if($row = mysqli_fetch_array($result))
{

$id = $row['id'];
$title = $row['category'];
$content = $row['question'];
}
?>

    <h1 class="h1 mb-4 fw-normal"><strong>Personality<br />Assessment</strong></h1>

    <main class="form-signin">
    <div class="card">
        <h5 class="card-header"><?php echo($title);?></h5>
        <div class="card-body">
          <h5 class="card-title"><?php echo($content);?></h5>
        <div class="card-body">
            <div class="mt-2 mb-2">
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="mark" id="mark1"
                        value="1">
                    <label class="form-check-label" >Strongly Agree</label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="mark" id="mark2"
                        value="1">
                    <label class="form-check-label" >Agree</label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="mark" id="mark3"
                        value="1">
                    <label class="form-check-label" >Neutral</label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="mark" id="mark4"
                        value="1">
                    <label class="form-check-label" >Disagree</label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="mark" id="mark5"
                        value="1">
                    <label class="form-check-label" >Strongly Disagree</label>
                </div>
                <br> 
          </div>

          <p>

          </p>
       

        <div class="position-absolute bottom-right">
        <?php 
        $next = mysqli_query($mysqli, "SELECT * FROM question WHERE id>$id order by id ASC");
            if($row = mysqli_fetch_array($next))
            {

            echo '<a href="nexttest.php?id='.$row['id'].'"><button class = "btn btn-primary" type="button">Next</button></a>';  
            }
        ?>
            
        </div>
        
        </div>
      </div>

      


    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"
        integrity="sha512-sH8JPhKJUeA9PWk3eOcOl8U+lfZTgtBXD41q6cO/slwxGHCxKcW45K4oPCUhHG7NMB4mbKEddVmPuTXtpbCbFA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
</body>



</html>

