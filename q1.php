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
      $ques= $_GET['q'];
      header("location:q$ques.php");
    }
    else {
        /* Requested page does not exist, redirect to Question 1. */
        $ques= 1;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question-1</title>
    <style>
        body {
            background-image: linear-gradient(120deg, #e0c3fc 0%, #8ec5fc 100%);
            min-height: 100svh;
        }

        .container {
            max-width: 1400px ;
            margin:auto
        }

        a {
            color:white;
            text-decoration: none;
        }

        #logoutBtn {
            background-color: rgba(255,0,0,0.6);
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

        .heading {
            font-size: 25px;
        }
        li {
            margin: 10px 0px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
    <div id="logoutBtn"><a href="logout.php">Logout</a></div>
    <h1>Question 1:</h1>
    <div class="heading">Create a form with below fields:</div>
    <ul>
        <li>First Name - <strong> User will input only alphabets</strong></li>
        <li>Last Name - <strong> User will input only alphabets</strong></li>
        <li>Full name: User cannot enter a value in Full name field. It will be disabled by default. When the first name and last name fields are filled, this field outputs the sum of the above 2 fields.</li>
        <li>Submit Button 
            <ul>
                <li>On submit, the form gets submitted and the page will reload</li>
                <li>Hello [full-name]” will appear on the page</li>
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