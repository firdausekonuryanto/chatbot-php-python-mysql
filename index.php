<?php 
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Akatech Chatbot!</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .logout-mobile{
            display: block;
        }
        .logout-mobilex{
            display: none;
        }
        @media (max-width: 768px) {
    /* Center align the content within the .header-container */
    .logout-mobile {
        display: none;
    }
    .logout-mobilex{
        display: block;
    }
}
    </style>
</head>
<body>
    <?php 
    if(isset($_SESSION['username'])){
    ?>
<div class="header-container" style="background-color:#329179; color:white; padding:15px; display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; align-items: center;">
        <img src="jodigas-circle-logo.png">
        <div style="display: flex; flex-direction: column; margin-left: 10px;">
            <h3>Akatech Chatbot</h3>
            <span style="margin-top: -12px;">We grow better for the future</span>
        </div>
    </div>
    <div class="logout-mobile" >
    <a  href="logout.php" style="color: white; text-decoration: none; ">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path d="M9.5 1.5a.5.5 0 0 0-1 0V8a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5V14a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5V8a.5.5 0 0 0 .5-.5z"/>
            <path d="M13.354 8.354a.5.5 0 0 0-.708-.708L9 11.293V2.5a.5.5 0 0 0-1 0v8.793L2.354 7.646a.5.5 0 1 0-.708.708l4 4a.5.5 0 0 0 .708 0l4-4z"/>
        </svg>
        Logout (<?php echo $_SESSION['username']; ?>)
    </a>
    </div>
</div>

<div class="header-containerx d-flex flex-row-reverse"  style="background-color:#329179; margin-top:-20px; color:white; padding:10px;  align-items: center;">
<div class="logout-mobilex" >   
<a  href="logout.php" style="color: white; text-decoration: none; ">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path d="M9.5 1.5a.5.5 0 0 0-1 0V8a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5V14a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5V8a.5.5 0 0 0 .5-.5z"/>
            <path d="M13.354 8.354a.5.5 0 0 0-.708-.708L9 11.293V2.5a.5.5 0 0 0-1 0v8.793L2.354 7.646a.5.5 0 1 0-.708.708l4 4a.5.5 0 0 0 .708 0l4-4z"/>
        </svg>
        Logout (<?php echo $_SESSION['username']; ?>)
    </a>
</div>
</div>

    <?php include 'koneksi.php'; ?>
    <div class="container-fluid">
        <div class="col">
            <div class="row" style="background-color: while; padding:20px; margin-top:-20px">
                <?php 
                $sql_transaction_bot = "SELECT * FROM transaction_bot, chatbot WHERE transaction_bot.id_user = '".$_SESSION['username']."' AND transaction_bot.answer_id = chatbot.id";
                $result = $conn->query($sql_transaction_bot);
                while ($row = $result->fetch_assoc()) {
                    $user_message = htmlspecialchars($row["question"]);
                    $bot_message = htmlspecialchars($row["answer"]);
                ?>
                <div class="user_message"><?php echo $user_message; ?></div>
                <div>
                    <div class="bot_message"><?php echo $bot_message; ?></div>
                </div>
                <?php } ?>
                
                <form action="proses_chat.php" method="post" style=" margin-top:100px" >
                    <input type="hidden" name="id_user" id="" value="<?php echo $_SESSION['username'];?>">
                    <div class="input-group mt-3">
                        <input type="text" class="form-control" name="question" id="" placeholder="Masukkan Pertanyaan !">
                        <button type="submit" name="save_chat" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-check" viewBox="0 0 16 16">
                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372l2.8-7Zm-2.54 1.183L5.93 9.363 1.591 6.602l11.833-4.733Z"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>  
    </div>
    <?php } else { header("Location: login.php"); } ?>
    </body>
</html>
