
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign-6</title>

    <!-- Linking stylesheet for the page -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1 class="heading">PHP Assignment 6</h1>
        
        <form onsubmit="return validateData();" method="post" enctype="multipart/form-data" action="pdfGenerate.php">
            <!-- Input for First name and display for errors  -->
            <label for="fname">First Name: </label>
            <input type="text" name="fname" id="fname" minlength="2" maxlength="25" required placeholder="Enter your First Name">
            <span class="error" id="fnameError">* <?php echo $myForm->fnameError; ?></span><br>

            <!-- Input for Last name and display for errors  -->
            <label for="lname">Last Name: </label>
            <input type="text" name="lname" id="lname" minlength="2" maxlength="25" required placeholder="Enter your Last Name">
            <span class="error" id="lnameError">* <?php echo $myForm->lnameError; ?></span><br>

            <!-- Full name disabled input field for displaying it and related errors -->
            <label for="lname">Full Name: </label>
            <input type="text" name="fullName" id="fullName" value=""  maxlimit="50" disabled>
            <span class="error" id="fullNameError" >* <?php echo $myForm->fullNameError; ?></span><br>

            <!-- Uploading an image and displaying related errors  -->
            <label for="image">Upload your image</label>
            <input accept="image/apng, image/jpeg, image/png" name="image" id="image" required type="file" title="Please upload an image" />
            <span class="error" id="imageError"> <?php echo $imageUploadError; ?></span><br>

            <!-- Input for Subject|Marks pairs. One in each line -->
            <label for="subjectMarks">Enter Subject|Marks : </label>
            <textarea name="subjectMarks" id="subjectMarks" cols="30" rows="10" required maxlength="100"></textarea>
            <span class="error" id="subjectMarksError">* <?php echo $myForm->subjectMarksError ?> </span> <br>

            <!-- Input an Indian Phone number. -->
            <label for="indianPhoneNumber" id="indianPhoneNumberLabel">Indian Phone no. :</label>
            <input type="tel" name="indianPhoneNumber" id="indianPhoneNumber" placeholder="Enter +91 followed by 10 digit number" minlength="13" maxlength="13" required >
            <span class="error" id="indianPhoneError">* <?php echo $myForm->indianPhoneError ?></span> <br>

            <!-- Input a valid email address. -->
            <label for="emailAddress">Email Address:</label>
            <input type="email" name="emailAddress" id="emailAddress" placeholder="Enter your Email address" maxlength="100" required>
            <span class="error" id="emailAddressError">* <?php echo $myForm->emailAddressError; ?></span> <br>

            <!-- Submits the form. -->
            <input type="submit" name="submit" value="Submit">
        </form>

    </div>

    <!-- Adding the javascript file. -->
    <script src="./script.js"></script>
</body>

</html>

