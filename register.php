<?php

require_once "config.php";

$username = $matricno =$password = $confirm_password = $programme = $faculty = $department = $year = "";
$username_err = $matricno_err=  $password_err = $confirm_password_err = $programme_err = $faculty_err = $department_err = $year_err ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    // } elseif (!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["username"]))) {
    //     $username_err = "Username can only contain letters, numbers and underscores.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["matricno"]))) {
        $matricno_err = "Please enter your matric number.";
    } else {
        $matricno = trim($_POST['matricno']);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty(trim($_POST["programme"]))) {
        $programme_err = "Please choose your programme.";
    } else {
        $programme = trim($_POST['programme']);
    }

    if (empty(trim($_POST["faculty"]))) {
        $faculty_err = "Please choose your faculty.";
    } else {
        $faculty = trim($_POST['faculty']);
    }

    if (empty(trim($_POST["department"]))) {
        $department_err = "Please choose your department.";
    } else {
        $department = trim($_POST['department']);
    }

    if (empty(trim($_POST["year"]))) {
        $year_err = "Please choose your year.";
    } else {
        $year = trim($_POST['year']);
    }

    if (empty($username_err) && empty($matricno_err) && empty($password_err) && empty($confirm_password_err) && empty($programme_err) && empty($faculty_err) && empty($department_err) && empty($year_err)) {
        $sql = "INSERT INTO users(username,matricno, password, programme, faculty, department,year) VALUES (?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $param_username, $param_matricno, $param_password, $param_programme, $param_faculty, $param_department,$param_year);
            $param_username = $username;
            $param_matricno = $matricno;
            $param_password = md5($password);
            $param_programme = $programme;
            $param_faculty = $faculty;
            $param_department = $department;
            $param_year = $year;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Fatin Nadhirah">
    <title>Fatin Nadhirah</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="signin.css" />

    <script>
        var subjectObject = {
        "Master": {
            "Arts and Social Science": ["Ars (Research)", "Arts (English Literature)", "Arts (Malaysian History)", "Southeast Asian Studies", "Publishing Studies","Startegic and Defence Studies","Media Studies","Arts(Southeast Asian History)","Chinese Studies (Coursework)"],
            "Asia-Europe": ["ASEAN Studies", "Europian Studies"], 
            "Advanced Studies": ["Renewable Energy", "Master of Philosophy"], 
            "Built Environment": ["Project Management", "Real Estate", "Facilities and Maintenance Management", "Architecture", "Built Environment"],
            "Business and Accountancy": ["Accounting", "Business Administration", "Management", "Marketing"], 
            "Computer Science and Information Technology": ["Artificial Intelligence", "Information Science (Research)", "Information Systems (Library Science)", "Software Engineering (Software Technology)", "Library and Information Science", "Data Science (Coursework)", "Computer Science (Applied Computing)", "Computer Science (Research)"],
            "Creative Arts": ["Creative Arts"], 
            "Dentistry": ["Dental Sciences", "Doctor of Philosophy"], 
            "Economics and Administration": ["Economics", "Development Studies ", "Applied Statistics", "Public Administration", "Research in Economics by Research","Public Administration by Research"], 
            "Education": ["Curriculum and Development", "Educational Psychology", "Science Education", "Sociology of Education", "Management","Islamic Education","Mathematics Education","Planning and Administations","Measurement and Evalution","Science Education with Information Technology","Instructional Technology (Instructional Design)","Early Childhood Education","Professional Counseling","Values Education & Humanities","Visual Arts Education","Mathematics Education with Technology","Physical and Health Education","English as a Second Language Education","Arabic Language Education","Bahasa Malaysia Education"], 
            "Engineering": ["Biomedical Engineering", "Safety, Health and Environment Engineering", "Systems Engineering", "Mechanical Engineering", "Engineering Science","Doctor of Philosophy"],    
            "Islamic Studies": ["Shariah", "Usuluddin", "Islamic Studies"],
            "Languages and Lingusitic": ["Arts (Linguistics)", "English Language Studies"], 
            "Law": ["Laws", "Criminal Justice", "Commercial Law", "Legal Studies"], 
            "Malay Studies": ["Malays Studies by Coursework", "Doctor of Philosophy"],
            "Medicine": ["Medical Physics", "Nursing Science", "Public Health", "Medical Education", "Health Research Ethics","Medical Parasitology and Entomology"], 
            "Pharmacy": ["Medical Science", "Doctor of Philosophy"], 
            "Public Policy and Management": ["Public Policy"], 
            "Science": ["Science", "Petroleum Geoscience", "Sustainability Science", "Science in Statistics", "Science in Instrumental Analytical Chemistry","Applied Physics","Biotechnology","Enviromental Management Technology","Bioinformatics","Crop Protection"], 
            "Sports & Exercise Sciences": ["Sport Science", "Strength and Conditioning"]   
        },

        "Bachelor": {
            "Arts and Social Science": ["East Asian Studies", "Arts Chinese Studies", "Arts Antropology and Sociology","Geography","Enviromenral Studies","Arts History","Arts English", "Arts Indian Studies", "Arts International and Strategic Studies","Media Studies","Arts Southeast Asian Studies"],
            "Built Environment": ["Urban & Regional Planning", "Science Architecture", "Quantity Surveying","Real Estate","Building Surveying"],
            "Business and Accountancy": ["Accounting", "Business Administration", "Finance"],
            "Computer Science and Information Technology": ["Artifical Intelligence", "Computer System and Network", "Information Systems","Software Engineering","Multimedia","Data Science"],
            "Creative Arts": ["Creative Arts"],
            "Dentistry": ["Dentistry"],
            "Economics and Administration": ["Applied Economics", "Financial Economics", "Development Studies","Applied Statistics and Analytics","Public Administration"],
            "Education": ["Counseling", "Early Childhood Education", "Education Teaching of English as a Second Language"],
            "Engineering": ["Biomedical Engineering", "Chemical Engineering", "Civil Engineering","Electrical Engineering","Mechanical Engineering"],
            "Islamic Studies": ["Al-Quran and Al-Hadith", "Shariah", "Usuluddin","Muamalat Management","Shariah and Law","Islamic Education (Islamic Studies)","Islamic Education(Quranic Studies)","Islamic Studies and Science"],
            "Languages and Linguistic": ["Arabic Languages and Linguistic", "Chinese Languages and Linguistic", "English Languages and Linguistic","French Languages and Linguistic","German Languages and Linguistic","Japanese Languages and Linguistic","Spanish Languages and Linguistic", "Tamil Languages and Linguistic", "Italian Languages and Linguistic"],
            "Law": ["Laws", "Jurisprudence"],
            "Malay Studies": ["Profesional Malay", "Malay Linguistic", "Malay Literature","Malay Socio-Cultural","Malay Art"],
            "Medicine": ["Medicine", "Biomedical Science", "Nursing"],
            "Pharmacy": ["Pharmacy"],
            "Science": ["Acturial Science", "Applied Chemistry", "Applied Geology","Biochemistry","Applied Mathematics","Chemistry", "Biotechnology", "Bioninformatics", "Biohealth Science","Ecology Biodiversity","Enviromental Management","Genetics","Geology","Materials Science","Mathematics","Physics","Science and Technology Studies", "Statistics"],
            "Sports & Exercise Sciences": ["Exercise Science", "Sports Management Science"]
        
        },
        "Foundation": {
            "Islamic Studies": ["Pengajian Islam"],
            "Foundation Studies": ["Life Sciences", "Physical Sciences", "Special Preparatory Programme (Japan)", "Islamic Studies and Science"]
        }
        }
        window.onload = function() {
        var programmeSel = document.getElementById("programme");
        var facultySel = document.getElementById("faculty");
        var departmentSel = document.getElementById("department");
        for (var x in subjectObject) {
            programmeSel.options[programmeSel.options.length] = new Option(x, x);
        }
        programmeSel.onchange = function() {
            //empty Chapters- and Topics- dropdowns
            departmentSel.length = 1;
            facultySel.length = 1;
            //display correct values
            for (var y in subjectObject[this.value]) {
            facultySel.options[facultySel.options.length] = new Option(y, y);
            }
        }
        facultySel.onchange = function() {
            //empty Chapters dropdown
            departmentSel.length = 1;
            //display correct values
            var z = subjectObject[programmeSel.value][this.value];
            for (var i = 0; i < z.length; i++) {
            departmentSel.options[departmentSel.options.length] = new Option(z[i], z[i]);
            }
        }
        }   
</script>
</head>

<body class="text-center">
    <main class="form-signin">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1 class="h1 mb-4 fw-normal"><strong>Personality<br />Assessment</strong></h1>
            <div class="form-floating">
                <input type="email" name="username" class="form-control mt-2 mb-2 <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="floatingInput" placeholder="Username" value="<?php echo $username; ?>" required />
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="text" name = "matricno" class="form-control mt-2 mb-2" id="floatingInput" placeholder="Matric No." required />
                <label for="floatingInput">Matric No.</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control mt-2 mb-2 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="floatingPassword" placeholder="Password" value="<?php echo $password; ?>" required />
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" name="confirm_password" class="form-control mt-2 mb-2 <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="floatingCPassword" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>" required />
                <label for="floatingCPassword">Confirm Password</label>
            </div>
            <div class="form-floating">
                <select name = programme class="form-select mt-2 mb-2" id="programme" aria-label="Programme" required>
                    <option selected hidden></option>
                    <!-- <option name = programme value="Master">Master</option>
                    <option name = programme value="Bachelor">Bachelor</option>
                    <option name = programme value="Diploma">Diploma</option>
                    <option name = programme value="Foundation">Foundation</option> -->
                </select>
                <label for="floatingSelect">Programme</label>
            </div>
            <div class="form-floating">
                <select name = faculty class="form-select mt-2 mb-2" id="faculty" aria-label="Faculty" required>
                    <option selected hidden></option>
                </select>
                <label for="floatingSelect">Faculty</label>
            </div>
            <div class="form-floating">
                <select name = department class="form-select mt-2 mb-2" id="department" aria-label="Department" required>
                    <option selected hidden ></option>
                </select>
                <label for="floatingSelect">Department</label>
            </div>
            <!-- <div class="form-floating">
                <select name = year class="form-select mt-2 mb-2" id="year" aria-label="Year" required>
                    <option selected hidden></option>
                    <option name = year value="1">Year 1</option>
                    <option name = year value="2">Year 2</option>
                    <option name = year value="3">Year 3</option>
                    <option name = year value="4">Year 4</option>
                </select>
                <label for="floatingSelect">Year</label>
            </div>
            <div class="form-floating">
                <select name = role class="form-select mt-2 mb-2" id="role" aria-label="Role" required>
                    <option selected hidden></option>
                    <option name = role value="student">Student</option>
                    <option name = role value="guest">Not a Student</option>
                </select>
                <label for="floatingSelect">I am a:</label>
            </div> -->
            <div class="mt-2 mb-2" required>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="year" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">Year 1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="year" id="inlineRadio1" value="2">
                    <label class="form-check-label" for="inlineRadio1">Year 2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="year" id="inlineRadio1" value="3">
                    <label class="form-check-label" for="inlineRadio1">Year 3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="year" id="inlineRadio1" value="4">
                    <label class="form-check-label" for="inlineRadio1">Year 4</label>
                </div>
            </div>
            <button class="w-100 mt-4 btn btn-lg btn-primary" type="submit" value="submit">Sign Up</button>

            <p class="mt-5 mb-3 text-muted">Already have an account? <a href="index.php">Sign In</a></p>
        </form>
    </main>

</body>

</html>