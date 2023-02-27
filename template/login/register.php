<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="<?= baseUrlTemplate('login/assets/css/style.css')?>" rel="stylesheet">
     <link rel="stylesheet" href="<?= baseUrlTemplate('login/assets/css/cdnFontAwesome.css')?>" >
     <title>Register</title>
</head>
<body>
<div class="container">
  <div class="card">
        <h1 class="card-title">Hello !</h1>
        <small class="card-subtitle">Create Your Credentials and get access</small>
        <form class="card-form">
            <label for="username">Email</label>
            <div class="card-input-container username">
                <input type="text" placeholder="Enter your username" id="username">
            </div>
            <label for="password">Password</label>
            <div class="card-input-container password">
                <input type="password" placeholder="Enter your password" id="password">
            </div>
            <label for="password">Re-Enter Password</label>
            <div class="card-input-container password">
                <input type="password" placeholder="Enter your password" id="password">
            </div>
            <button class="card-button">Sign In</button>
            <small class="card-forgot-password">You have signed in? <a>login</a></small>
        </form>
    </div>
</div>
</body>
</html>