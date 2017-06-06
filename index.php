<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

        <title>Film Management</title>
        <style>
            table, th, td {
                border: 3px solid #ac2925;
            }
        </style>
    </head>

    <body style="margin-left: 60px;">

        <h2><span style="margin-left: 280px;color: #286090">welcome to Video Information Mangement System</span></h2>
        <hr>
        <h4>Dear Guest, You can not have Advanced Search! For this you must be <a href="login.php">Login</a>.</h4><br>
        <div class="">
            <form method="post" action="#">
                <input type="text" name="name" placeholder="Film Name">
                <input type="submit" value="search" name="search">
            </form>

        </div>
        <div id="result_search">
            <?php
            require_once './class.film.php';
            $filme = new Film();

            if (isset($_POST['search'])) {
                $nameF = $_POST['name'];
                echo $filme->guest_search($nameF);
            }
            ?>
        </div>
    </body>
</html>
