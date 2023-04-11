<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <h1>Verify Yourself</h1>
    </div>
    <p>If you are a verified member, the book will be issued to you or else you have to grant subscription form library authority</p>
    <form action="verify.php" method="post">

        <label for="user">Name: </label><br>
        <input type="text" name="name" id="name" required><br><br>
        
        <input type="submit" name='submit' id='submit'>

    </form>
</body>

</html>