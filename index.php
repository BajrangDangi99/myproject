<!-- // New Codes -->

<?php
// Define variables and set them to empty values
$fnameErr = $lnameErr = $emailErr = $mobileErr = $religiousErr = $skillsErr = $skillsErr1 = $selectErr = $addressErr = $passwordErr = $cpasswordErr = $fileuploadErr = "";
$fname = $lname = $email = $mobile = $religious = $select = $address = $password = $cpassword = $fileupload = "";
$selectedSkills = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // fname
    if (empty($_POST["fname"])) {
        $fnameErr = "First Name is required";
    } else {
        $fname = test($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $fnameErr = "Only letters and white space allowed";
        }
    }

    // lname
    if (empty($_POST["lname"])) {
        $lnameErr = "Last Name is required";
    } else {
        $lname = test($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed";
        }
    }

    // Email
    $validEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test($_POST["email"]);
        if (!preg_match($validEmail, $email)) {
            $emailErr = "Invalid email format";
        }
    }

    // Mobile
    if (empty($_POST["mobile"])) {
        $mobileErr = "Mobile is required";
    } else {
        $mobile = test($_POST["mobile"]);
        if (!preg_match('/^[0-9]{10}+$/', $mobile)) {
            $mobileErr = "Please enter only digits";
        }
    }

    // Religious
    if (empty($_POST["religious"])) {
        $religiousErr = "Religious affiliation is required";
    } else {
        $religious = test($_POST["religious"]);
    }

    // Skills
    if (isset($_POST["skills"]) && is_array($_POST["skills"])) {
        $selectedSkills = $_POST["skills"];
        if (count($selectedSkills) < 2) {
            $skillsErr1 = "Select at least two options";
        }
    } else {
        $skillsErr = "You must select skills";
    }

    // Select
    if (empty($_POST["select"])) {
        $selectErr = "State selection is required";
    } else {
        $select = test($_POST["select"]);
    }

    // Address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test($_POST["address"]);
        if (!preg_match("/^[a-zA-Z0-9' ]*$/", $address)) {
            $addressErr = "Only letters, numbers, and spaces allowed";
        }
    }

    // Password Validation
    $password = test($_POST["password"]);
    $cpassword = test($_POST["cpassword"]);
    if (empty($password)) {
        $passwordErr = "Password is required";
    } elseif (
        !preg_match("/(?=.*?[A-Z])/", $password) ||
        !preg_match("/(?=.*?[a-z])/", $password) ||
        !preg_match("/(?=.*?[0-9])/", $password) ||
        !preg_match("/(?=.*?[#?!@$%^&*-])/", $password) ||
        !preg_match("/.{8,}/", $password) ||
        preg_match("/^$|\s+/", $password)
    ) {
        $passwordErr = "Password must have at least one uppercase letter, one lowercase letter, one digit, one special character, no spaces, and a minimum length of 8 characters";
    }

    // Confirm Password
    if ($cpassword !== $password) {
        $cpasswordErr = "Confirm Password does not match";
    }
    
  
   


    
}

function test($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<?php  
    
    if($fnameErr == "" && $lnameErr == "" && $emailErr == "" && $mobileErr == "" && $religiousErr == "" && $skillsErr == "" && $skillsErr1 == "" && $selectErr == "" && $addressErr == "" && $passwordErr == "" && $cpasswordErr == "" && $fileuploadErr == "") {  
      if(isset($_POST['submit'])) {   
         // Check if a file was uploaded
    if (!empty($_FILES["fileupload"]["name"])) {
      $fileupload = $_FILES["fileupload"];
      $target_dir = "upload/";  // Specify the directory where you want to store uploaded files

      // Check if the "upload" directory exists, and if not, create it
      if (!file_exists($target_dir)) {
          mkdir($target_dir, 0755, true);
      }

      $target_file = $target_dir . basename($fileupload["name"]);

      if (move_uploaded_file($fileupload["tmp_name"], $target_file)) {
          // File was successfully uploaded
      } else {
          $fileuploadErr = "Error uploading file";
          }
      } else {
          $fileuploadErr = "File upload is required";
      }
      echo "<h3 color = #FF0001> <b>You have sucessfully registered.</b> </h3>"; 

      }  
    }  else {  
      echo "<h3> <b>You didn't filled up the form correctly.</b> </h3>";  
  } 
?>  



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reg</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .error { color: #FF0000; }
    </style>
</head>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <!-- Your form content here, as previously provided -->
        <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block mt-4">
                                <img src="img4.png" class="img-fluid" alt="Sample photo" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                                
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase">Student registration form</h3>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <!-- <input type="text" id="fname" class="form-control form-control-lg" value="<?php echo $fname;?>" />
                                                <label class="form-label" name="fname" for="fname">First name</label>
                                                <span class="error">* <?php echo $fnameErr;?></span> -->
                                                <input type="text" name="fname" class="form-control form-control-lg" value="<?php echo $fname;?>">
                                                <label class="form-label" name="fname" for="fname">First name</label>
                                                    <span class="error">* <?php echo $fnameErr;?></span>
                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="lname" name="lname" class="form-control form-control-lg" value="<?php echo $lname;?>" />
                                                <label class="form-label"  for="lname">Last name</label>
                                                <span class="error">* <?php echo $lnameErr;?></span>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?php if(isset($_POST['email'])) echo $email;?>"/>
                                                <label class="form-label"  for="email">Email ID</label>
                                                <span class="error">* <?php echo $emailErr;?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="phone" id="mobile" name="mobile" class="form-control form-control-lg" value="<?php echo $mobile;?>" />
                                                <label class="form-label" for="mobile">Mobile</label>
                                                <span class="error">* <?php echo $mobileErr;?></span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                                        <h6 class="mb-0 me-4">Religious: </h6>
                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" name="religious" value="hinduism" <?php if (isset($religious) && $religious == "hinduism") echo "checked"; ?>>
                                            <label class="form-check-label" for="hinduism">Hinduism</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" name="religious" value="sikhism" <?php if (isset($religious) && $religious == "sikhism") echo "checked"; ?>>
                                            <label class="form-check-label" for="sikhism">Sikhism</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="radio" name="religious" value="islam" <?php if (isset($religious) && $religious == "islam") echo "checked"; ?>>
                                            <label class="form-check-label" for="islam">Islam</label>
                                        </div>
                                        <span class="error">* <?php echo $religiousErr; ?></span>
                                    </div>


                                    <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                                        <h6 class="mb-0 me-4">Skills </h6>
                                        <div class="form-check mb-0 me-4">
                                            <input type="checkbox" class="form-check-input" name="skills[]" value="html5" <?php if(isset($_POST['skills']) && in_array('html5', $_POST['skills'])) echo 'checked'; ?>>
                                            <label class="form-check-label" for="html5">HTML5</label>
                                        </div>
                                        <div class="form-check mb-0 me-4">
                                            <input type="checkbox" class="form-check-input" name="skills[]" value="css" <?php if(isset($_POST['skills']) && in_array('css', $_POST['skills'])) echo 'checked'; ?>>
                                            <label class="form-check-label" for="css">CSS</label>
                                        </div>
                                        <div class="form-check mb-0 me-4">
                                            <input type="checkbox" class="form-check-input" name="skills[]" value="php" <?php if(isset($_POST['skills']) && in_array('php', $_POST['skills'])) echo 'checked'; ?>>
                                            <label class="form-check-label" for="php">PHP</label>
                                        </div>
                                        <div class="form-check mb-0 me-4">
                                            <input type="checkbox" class="form-check-input" name="skills[]" value="mysql" <?php if(isset($_POST['skills']) && in_array('mysql', $_POST['skills'])) echo 'checked'; ?>>
                                            <label class="form-check-label" for="mysql">MYSQL</label>
                                        </div>
                                        <span class="error">* <?php echo $skillsErr; ?></span>
                                        <span class="error"> <?php echo $skillsErr1; ?></span>
                                    </div>

                                  
                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                        <select class="select" name="select">
                                            <option value="">Select State</option>
                                            <option value="andhra pradesh" <?php if ($select === "andhra pradesh") echo 'selected'; ?>>Andhra Pradesh</option>
                                            <option value="bihar" <?php if ($select === "bihar") echo 'selected'; ?>>Bihar</option>
                                            <option value="chhattisgarh" <?php if ($select === "chhattisgarh") echo 'selected'; ?>>Chhattisgarh</option>
                                            <option value="madhya pradesh" <?php if ($select === "madhya pradesh") echo 'selected'; ?>>Madhya Pradesh</option>
                                            <option value="rajasthan" <?php if ($select === "rajasthan") echo 'selected'; ?>>Rajasthan</option>
                                            <option value="punjab" <?php if ($select === "punjab") echo 'selected'; ?>>Punjab</option>
                                            <option value="haryana" <?php if ($select === "haryana") echo 'selected'; ?>>Haryana</option>
                                        </select>

                                            <span class="error">* <?php echo $selectErr;?></span>
                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <!-- code -->

                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                    
                                      <input type="text" id="address" name="address" class="form-control form-control-lg" value="<?php  echo $address;?>" />
                                        <label class="form-label" for="address">Address</label>
                                        <span class="error">* <?php echo $addressErr;?></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" value="<?php if (isset($password)) echo $password;?>" />
                                        <label class="form-label" for="password">Password</label>
                                        <span class="error">* <?php echo $passwordErr;?></span>
                                         <!--//Password//-->
                                          
                                              
                                          
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg" value="<?php if (isset($cpassword)) echo $cpassword;?>" />
                                        <label class="form-label" for="cpassword">Confom Password</label>
                                      <span class="error">* <?php echo $cpasswordErr;?></span>
                                         <!--//Confirm Password//-->                                     
                                            
                                  
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="file" name="fileupload" id="fileupload" class="form-control form-control-lg">
                                        
                                        <!-- <input type="file" id="form3Example90" class="form-control form-control-lg" /> -->
                                        <label class="form-label" for="fileupload">Images</label>
                                        <span class="error">* <?php echo $fileuploadErr;?></span> 
                                        

                                    </div>

                                    <div class="d-flex justify-content-end pt-3">
                                        <button type="reset" value="reset" class="btn btn-light btn-lg">Reset all</button>
                                        <button type="submit" name="submit" id="submit"  class="btn btn-warning btn-lg ms-2">Submit form</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
</body>

</html>