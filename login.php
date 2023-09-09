<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for vertical centering */
        html, body {
            height: 100%;
        }
        .card {
            border-radius: 10px;
            border-style: dotted;
            border-width: 2px;
            border-color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('https://e1.pxfuel.com/desktop-wallpaper/646/773/desktop-wallpaper-login-page-login.jpg'); /* Replace 'your-image-url.jpg' with the actual URL of your background image */
            background-size: cover; /* Adjust background size as needed */
            background-repeat: no-repeat;
        }

        input[type='text'], input[type='password'] {
            border-radius: 5px;
            border-style: dotted;
            border-width: 1px;
            border-color: black;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Media query for small screens (phones) */
        @media (max-width: 768px) {
    .container {
        width: 100% !important; /* Set the container to 100% width on small screens */
    }
    .col-md-4 {
        width: 100% !important; /* Set the card to 100% width on small screens */
    }
}
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Login Akatech Chatbot</h2>
                        <span><center>We grow better for the future</center></span><br>
                        <form action="process_login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-success">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
