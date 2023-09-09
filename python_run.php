<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_input = "what is indonesia";
if (!empty($user_input)) {
    $command = escapeshellcmd("python C:/xampp/htdocs/php-chatbot/mybot.py \"$user_input\"");
    $output = shell_exec($command);

    if ($output === null) {
        echo "Error executing the Python script or no output produced.";
    } else {
        echo $output;
    }
} else {
    echo "Please enter a question.";
}
?>
