<?php

/* Starting the session. */
session_start();

/* If user is not logged in, redirect to login page. */
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: index.php");
    exit;
}

/* Handling query string. */
if (isset($_GET['q']) && is_numeric($_GET['q']) && ($_GET['q'] > 0 && $_GET['q'] < 8)) {
    $ques = $_GET['q'];
    header("location:q$ques.php");
} else {
    /* Requested page does not exist, redirect to Question 1. */
    $ques = 1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question-5</title>
    <style>
        body {
            background-image: linear-gradient(120deg, #e0c3fc 0%, #8ec5fc 100%);
            min-height: 100svh;
        }

        .container {
            max-width: 1400px;
            margin: auto;
        }

        a {
            color: white;
            text-decoration: none;
        }

        #logoutBtn {
            background-color: rgba(255, 0, 0, 0.6);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        #logoutBtn:hover {
            background-color: red;
        }

        p {
            font-size: 20px;
            line-height: 25px;
        }

        li {
            margin: 10px 0px;
            line-height: 25px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="logoutBtn"><a href="logout.php">Logout</a></div>
        <h1>Question 5:</h1>
        <p>Add a new single text field to the above form that will accept email id. Do not use email id input field type.</p>

        <ul>
            <li><strong>a. Email Syntax check</strong>
                <ul>
                    <li>User will enter email id and on submit, check if correct email id syntax has been used.</li>
                    <li>Show a message on successful email syntax or show an error message on the wrong syntax.</li>
                </ul>
            </li>
            <li><strong>b. Valid Email id check</strong>
                <ul>
                    <li>User will enter email id and on submit, use the following site http://www.mailboxlayer.com/ to check if the entered email id is valid.</li>
                </ul>
            </li>
        </ul>

        <p>Pages: 
        <?php for ($i = 1; $i < 8; $i++) { ?>
       <a href="?q=<?php echo $i; ?>" > <?php echo $i; ?> </a>
        <?php if ($i < 8) { ?>
            <span> | </span>
       <?php } 
    }
     ?> </p>
    </div>
</body>

</html>