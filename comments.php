<?php
require_once("session.php");

require_once("class.user.php");
$auth_user = new USER();


$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id" => $user_id));

$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <label class="h5">user : <?php print($userRow['user_name']); ?></label><br><br>
<!--        <form action="#" method="post">
            <select name="fname">
                <option></option>
            </select>
        </form>-->
        <?php
        require_once './class.film.php';
        $username=$userRow['user_name'];
        
        $m = new Film();
        echo $m->add_comment($username);
        
        ?>
    </body>
</html>
