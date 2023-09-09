<?php
session_start();
include 'koneksi.php';

$kata_kunci = isset($_POST['question']) ? $_POST['question'] : ""; 
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : "";
$question = isset($_POST['question']) ? $_POST['question'] : "";
$time_chat = date("Y-m-d H:i:s");
$user_input =  isset($_POST['question']) ? $_POST['question'] : "";

$insert_sql = "INSERT INTO transaction_bot (id_user, question, answer_id, time_chat)
VALUES ('$id_user', '$question', '".call_python($user_input)."', '$time_chat')";
$conn->query($insert_sql);
header("Location: index.php"); 

function call_python($user_input){
    $command = escapeshellcmd("python C:/xampp/htdocs/php-chatbot/mybot.py \"$user_input\"");
    $output = shell_exec($command);
    return $output;
}
$conn->close(); 
?>