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
    <title>Question-6</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div id="logoutBtn"><a href="logout.php">Logout</a></div>
        <h1>Question 6:</h1>
        <p>When the user submits the above form, 2 copies of the data will get created in a doc format. One will store on the server and the other will be downloaded to the user submitting the data. The information in the doc should be presented in a well-defined manner.</p>

        <p>Pages: 
        <?php for ($i = 1; $i < 8; $i++) { ?>
       <a href="?q=" <?php echo $i; ?> > <?php echo $i; ?> </a>
        <?php if ($i < 8) { ?>
            <span> | </span>
       <?php } 
    }
     ?> </p>
    </div>
</body>

</html>