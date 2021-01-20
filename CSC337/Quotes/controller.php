<?php
// This file contains a bridge between the view and the model and redirects back to the proper page
// with after processing whatever form this code absorbs. This is the C in MVC, the Controller.
//
// Authors: Rick Mercer and Jiazheng Huang
//  
session_start (); // Not needed in Quotes1

require_once './DatabaseAdaptor.php';

$theDBA = new DatabaseAdaptor();

if (isset ( $_GET ['todo'] ) && $_GET ['todo'] === 'getQuotes') {
    $arr = $theDBA->getAllQuotations();
    unset($_GET ['todo']);
    echo getQuotesAsHTML ( $arr );
}

if (isset ( $_POST ['increase'] )){
    $theDBA->increaseRating($_POST ['increase']);
    unset($_POST ['increase']);
    header ( 'Location: view.php' );
}

if (isset ( $_POST ['decrease'] )){
    $theDBA->decreaseRating($_POST ['decrease']);
    unset($_POST ['decrease']);
    header ( 'Location: view.php' );
}

if (isset ( $_POST ['delete'] )){
    $theDBA->deleteQuote($_POST ['delete']);
    unset($_POST ['delete']);
    header ( 'Location: view.php' );
}

function getQuotesAsHTML($arr) {
    $result = '';
    foreach ( $arr as $quote ) {
//         $_SESSION ['thisQuote'] = $quote ['quote'];
        $result .= '<div class="container">';
        $result .= '"' . $quote ['quote'] . '"<br>';
        $result .= '<p class="author">&nbsp;&nbsp;--' . $quote ['author'] . '<br></p>';
        $result .= '<form action="controller.php" method="post">';
        $result .= ' <input type="hidden" name="ID" value="7">&nbsp;&nbsp;&nbsp;';
        $result .= '<button name="increase" value="' . $quote ['id'] .'">+</button>';
        $result .= '&nbsp;<span id="rating"> ' . $quote['rating'] . '</span>&nbsp;&nbsp;';
        $result .= '<button name="decrease" value="' . $quote ['id'] .'">-</button>&nbsp;&nbsp;';
        
        if (isset ($_SESSION['user'])){
            $result .= '<button name="delete" value="' . $quote ['id'] .'">Delete</button></form></div>';
        }
        else {
            $result .= '</form></div>';
        }
    }
    return $result;
}

// This part is to add new quote
if (isset ($_POST['newQuote']) && isset ($_POST['newAuthor'])) {
    $newQ = $_POST['newQuote'];
    $newQ = htmlspecialchars($newQ);
    $newA = $_POST['newAuthor'];
    $newA = htmlspecialchars($newA);
    $theDBA->addQuote($newQ, $newA);
    header ( 'Location: view.php' );
}

// This part is for registeration
if (isset ($_POST['registerUsername']) && isset ($_POST['registerPassword'])) {
    $newUser = $_POST['registerUsername'];
    $newUser = htmlspecialchars($newUser);
    $newPW = $_POST['registerPassword'];
    $newPW = htmlspecialchars($newPW);
    
    $hashPW = password_hash($newPW, PASSWORD_DEFAULT);
    
    $arr = $theDBA->check_if_username_exist($newUser);
    if (empty($arr)){
        $theDBA->addUser($newUser, $hashPW);
        header ( 'Location: view.php' );
    }
    else {
        $_SESSION ['registrationError'] = 'Account name taken';
        header ( 'Location: register.php' );
    }
}

// This part is for login
if (isset ($_POST['LoginUsername']) && isset ($_POST['LoginPassword'])) {
    $loginUser = $_POST['LoginUsername'];
    $loginUser = htmlspecialchars($loginUser);
    $loginPW = $_POST['LoginPassword'];
    $loginPW = htmlspecialchars($loginPW);
    
    //$hashLIPW = password_hash($loginPW, PASSWORD_DEFAULT);
        
    $arr = $theDBA->check_if_username_exist($loginUser);
    $verified = $theDBA->verifyCredentials($loginUser, $loginPW);
    
    if (empty($arr)){
        $_SESSION ['loginError'] = 'Account does not exist';
        header ( 'Location: login.php' );
    }
    else {
        if($verified){
            $_SESSION ['user'] = $loginUser;
            header ( 'Location: view.php' );
        }
        else {
            $_SESSION ['loginError'] = 'Invalid credentials. Try again!';
            header ( 'Location: login.php' );
        }
    }
}

if (isset ( $_POST ['logout'] ) && $_POST ['logout'] === 'Logout') {
    session_destroy ();  // unset all $_SESSION[] elements
    header ( 'Location: view.php' );
}

?>