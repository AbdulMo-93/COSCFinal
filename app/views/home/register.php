<?php require_once '../app/views/templates/headerPublic.php' ?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background-color: Maroon;
                background-color: rgb(93, 0, 0);
                color: rgb(255, 255, 255);
            }
        </style>
        <style> 
            input[type=text],[type=password] {
                width: 15%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;
            }
        </style>
        <style> 
            button[type=submit] {
                background-color: blue;
                border: none;
                color: white;
                padding: 8px 16px;
                text-decoration: none;
                margin: 2px 1px;
            }
        </style>

    </head>
    <body>

        <h1>Please Create an Account!</h1>

    </body>
</html>
<body> 
    <p class="lead"> <?= date("F jS, Y"); ?></p>
    <form method="post" action="<?= LOGIN_REGISTER ?>">
        Email:<br/>
        <input type="email" name="Email"><br/>
        Username:<br/>
        <input type="text" name="Username"><br/>
        Password<br/>
        <input type="password" name="Password"><br/>
        <br/>
        <button type="submit" > submit </button> <br/>
        <br/>
    </form>
</body>
</html>
<a href="<?= LOGIN_INDEX ?>"> Sign up here </a>
<?php require_once '../app/views/templates/footerPublic.php' ?>
