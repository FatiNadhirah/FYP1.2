<?php 
    // session_start();

    // if (isset($_SESSION['username']) && isset($_SESSION['id']))
    // { 
        ?>

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
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

      


    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"
        integrity="sha512-sH8JPhKJUeA9PWk3eOcOl8U+lfZTgtBXD41q6cO/slwxGHCxKcW45K4oPCUhHG7NMB4mbKEddVmPuTXtpbCbFA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

<?php require_once 'process.php'; ?>
    
    <?php
        if (isset($_SESSION['message'])): ?>
    
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
            
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
    </div>
    <?php endif ?>
    <div class=container>
            <h1 class="h1 mb-4 fw-normal text-center" > <strong>Admin Page</strong> </h1>
            <!-- <h5> Admin Page </h5> -->
    <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="floatingInput">Category</label>
                <input type="text" name = "category" class="form-control mt-2 mb-2" 
                        value = "<?php echo $category; ?>" placeholder="Enter the Category" required />
            </div>
            <div class="form-group">
                <label for="floatingInput">Question</label>
                <input type="text" name = "question" class="form-control mt-2 mb-2" 
                        value ="<?php echo $question; ?>" placeholder="Enter the Question" required />
                
            </div>
            <div class="button">
            <?php
            if ($update == true):
            ?>
                <button class="w-100 mt-4 btn btn-lg btn-primary" id = "submit" type="submit" value="submit" name = "update"> Update </button>
            <?php else:?>
                <button class="w-100 mt-4 btn btn-lg btn-primary" id = "submit" type="submit" value="submit" name = "save"> Save </button>
            <?php endif; ?>
            </div>
        </form>

    <?php
        $mysqli = new mysqli('localhost','root','','personality') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM question") or die($mysqli->error);
        // pre_r($result);
        ?>

        <div class = "row justify-content-center">
            <table class = "table">
                <thead>
                    <tr>
                        <th> Category </th>
                        <th> Question </th>
                        <th colspan = "2"> Action </th>
                    </tr>
                </thead>

            <?php
            while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td> <?php echo $row['category'];?> </td>
                <td> <?php echo $row['question']; ?> </td>
                <td>
                    <a href="question.php?edit=<?php echo $row['id']; ?>"    
                    class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>"    
                    class="btn btn-danger">Delete</a>
                </td>
            </tr>

            <?php endwhile; ?>
            </table>
        </div>

        <?php function pre_r( $array ){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

    ?>

    </div>

</body>



</html>

<?php 
// } else {
//         header ("Location: index.php");
//   } 
?>
