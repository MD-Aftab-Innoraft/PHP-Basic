    <!-- INDEX.PHP  -->
    <?php
    require 'imageForm.php';

    // creating a new 'Form' object
    $myForm = new Form();

    // at this point all the properties are set to default values by constructor

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["fname"])) {
            $myForm->fnameErr = "First Name is required";
        } else {
            $fname = $_POST["fname"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
                $myForm->fnameErr = "Only letters and white space allowed";
            } else {
                $myForm->setFirstName($fname);
            }
        }

        if (empty($_POST["lname"])) {
            $myForm->lnameErr = "Last Name is required";
        } else {
            $lname = $_POST["lname"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
                $myForm->lnameErr = "Only letters and white space allowed";
            } else {
                $myForm->setLastName($lname);
            }
        }

        // setting the full name if both first and last names are valid
        // ie, no error in both fnameErr and lnameErr
        if ($myForm->fnameErr == "" && $myForm->lnameErr == "") {
            $myForm->setFullname();
        }
        //    seeing the files in $_FILES superglobal
        //    echo "<pre>";
        //    print_r($_FILES);
        //    echo "</pre>";

        $img_name = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];
        // move $img_tmp to the required folder with the name with which it is saved
        move_uploaded_file($img_tmp, "uploads/$img_name");

        $subjectmarks = $_POST["sub_marks"];
        $subjectmarksErr = "";
        $subjectmarkspattern = '/^[a-zA-Z0-9|\n\t\s ]+$/';

        if($subjectmarks == "") {
            $subjectmarksErr = "No subject|marks pair entered";
        }
        else {
            if(preg_match($subjectmarkspattern, $subjectmarks)) {
                $fp = fopen("marksFile.txt","w");
                fwrite($fp,$subjectmarks);
                fclose($fp);
            } 
            else {
                $subjectmarksErr = "Input can only contain alpha-numeric characters and '|'";         
            }
        }


        $phone = $_POST["phone"];
        $phoneErr = "";
        $indianphone = '/^(\+91)[1-9][0-9]{9}$/';

        if($phone == ""){
            $phoneErr = "Phone Number is required";
        } else {
            if(!preg_match($indianphone, $phone)) {
                $phoneErr = "Not an Indian Phone number";
            }
        }

    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Image</title>
        <link rel="stylesheet" href="imageform.css">

    </head>

    <body>
        <div class="container">
            <h1 class="heading">PHP Assignment 2</h1>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="fname">First Name: </label>
                <input type="text" name="fname" id="fname" placeholder="Enter your First Name">
                <span class="error">* <?php echo $myForm->fnameErr ?></span><br>

                <label for="lname">Last Name: </label>
                <input type="text" name="lname" id="lname" placeholder="Enter your Last Name">
                <span class="error">* <?php echo $myForm->lnameErr ?></span><br>

                <label for="fullname">Full Name: </label>
                <!-- change the condition for updating value of the below disabled field -->
                <input type="text" disabled name="fullname" id="fullname" value="<?php echo (($myForm->getFullName() == "") ? "disabled input" : $myForm->getFullName()); ?>"> <br>

                <label for="myimage">Upload your image:</label>
                <input type="file" name="image" id="fileToUpload"> <br>

                <label for="sub_marks">Enter Subject and Marks(Format: Subject|Marks)</label>
                <textarea id="sub_marks" name="sub_marks"></textarea>
                <span class="error">* <?php if (isset($_POST["submit"])) { echo "$subjectmarksErr"; }?></span>

                <label for="phone">Enter your Phone Number:</label>
                <input type="text" id="phone" name="phone">
                <span class="error">* <?php if(isset($_POST["submit"])) {echo $phoneErr;}?></span>

                <input type="submit" name="submit" value="Submit">
            </form>
            <?php

            // if the image name is set, we display the image
            if (isset($img_name) && !empty($img_name)) {
                echo "<div class='uploadimage'>";
                echo "<img  src = 'uploads/$img_name'  height=300px>";
                echo "</div>";
            }

            if ($myForm->getFullName() != "") {
                echo "<div class='detail'>Full name : " . $myForm->getFullName() . "</div>" . "<br>";
            }

            // if form is submitted and no subject|marks were inputted
            if (isset($_POST["submit"]) && $subjectmarksErr == "") {

                $fp = fopen("marksFile.txt", "r");
                echo "<table class='tableheading' >";
                echo "<tr> <td>Subject</td> <td>Marks</td> </tr>";
                while (!feof($fp)) {
                    $fileline = fgets($fp);
                    $fileline = explode("|", $fileline);
                    echo "<tr>
            <td>" . $fileline[0] . "</td>
            <td> " . $fileline[1] . " </td>
             </tr>";
                }
                echo "</table>";
            }

            if(isset($_POST["submit"]) && $phoneErr == "") {
                echo "<div class='detail'> Phone Number: " . $phone . "</div>";
            }

            // showing an error message below the image
            // elseif(isset($_POST["submit"]) && $_POST["sub_marks"] == "") {
            //     echo "No marks inserted";
            // }

            ?>
        </div>
    </body>


    </html>