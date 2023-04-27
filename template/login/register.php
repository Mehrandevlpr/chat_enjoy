<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?= baseUrlTemplate('login/assets/css/fontawesome/css/all.min.css')?>" >
     <link rel="stylesheet" href="<?= baseUrlTemplate('login/assets/css/fontawesome/css/fontawesome.css')?>" >
     <link href="<?= baseUrlTemplate('login/assets/css/style.css')?>" rel="stylesheet">
     <title>Register</title>
</head>
<body>
<div class="container">
  <div class="card">
        <h1 class="card-title">Hello !</h1>
        <small class="card-subtitle">Create Your Credentials and get access</small>
        <form class="card-form" action="<?= baseUrl('profile')?>" method="post">
            <label for="email">Email</label>
            <div class="card-input-container email">
                <input type="text" name="email" value="<?= isset($email) ? $email : '' ?>" placeholder="Enter your username" id="email">
            </div>
            <label for="password">Password</label>
            <div class="card-input-container password">
                <input type="password" name="password" placeholder="Enter your password" id="password">
            </div>
            <label for="password">Re-Enter Password</label>
            <div class="card-input-container password">
                <input type="password" name="re_password" placeholder="Enter your password" id="password">
            </div>
            <input type="submit" class="card-button" value="Sing In" name="submit">
            <small class="card-forgot-password">You have signed in? <a  href="<?= baseUrl('login')?>">login</a></small>
        </form>
    </div>
</div>
</body>
</html>