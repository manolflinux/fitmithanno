<?php

if ($_POST) {

    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    //Mailserver
    $to = "feedback@fitmithanno.fun";
    $subject = $subject;
    $txt = $message;

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <webmaster@fitmithanno.fun>' . "\r\n";
    $headers .= 'Cc: myboss@example.com' . "\r\n";

    mail($to, $subject, $txt, $headers);




    // $sql = "INSERT into messages (vorname, nachname, email, subject, message)  values ('$vorname', '$nachname','$email', '$subject','$message')";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Feedback</title>
    </head>

    <body>

    </body>


    </html>


<?php


    // if ($conn->query($sql) === TRUE) {
    //     echo "<div class= 'text-dark pt-2 pb-2'>";
    //     echo "<p><center><b>Vielen Dank für deine Message!</b></center></p>";
    //     echo "<p><center><b><Wir haben dein Feedback erhalten</b></center></p>";
    //     // header("refresh:2; url=../home.php");

    //     echo " <center><img src='../images/rudolf.png' alt='rudi'style='width:276px; height:463px' ></center>";
    //     echo "<br><br><center><a href='../home.php'><button type='button' class='btn btn-outline-success'>keine Ursache!</button></a></center>";
    //     echo "</div>";

    //     echo "</div>";
    // } else {
    //     echo "Error " . $sql . ' ' . $conn->connect_error;
    // }

    // include('../footer.php');
//     $conn->close();
// }

?>