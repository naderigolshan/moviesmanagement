<?php
require_once("session.php");

require_once("class.user.php");
$auth_user = new USER();


$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id" => $user_id));

$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
    <head>
        <meta charset="UTF-8"></meta>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"></link>
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"></link>
        <script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"  ></link>
        <title>Admin Page</title>
        <style>
            table, th, td {
                border: 4px solid #2b669a;
                text-align: center;
                size: 40px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="clearfix"></div>

        <div class="container-fluid" style="margin-top:80px;">

            <div class="container">

                <label class="h5">welcome : <?php print($userRow['user_name']); ?></label>
                <hr />
                <h1>
                    <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp; 
                    <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1>
                <hr />
                <form method="post" action="#">
                    <input type="submit" name="insert_json" value="Insert from json"></input>
                </form>
                <?php
                if (isset($_POST['insert_json'])) {
                    require_once './class.film.php';
                    $j = new Film();
                    $j->insert_from_json();
                }
                ?>
                <hr/>
                <div class=""><h2>Insert new Film</h2>
                    <form method="post" action="#" >
                        <input type="text" name="nname" placeholder="Film Name"></input>
                        <input type="number" name="nyear" placeholder="year"></input>
                        <input type="text" name="ncountry" placeholder="Country"></input>
                        <input type="number" name="ndurationMinutes" placeholder="durationMinutes"></input>
                        <input type="text" name="ndirector" placeholder="Director"></input>
                        <input type="submit" name="insert" value="Insert"></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </form> 
                    <?php
                    if (isset($_POST['insert'])) {
                        if ($userRow['user_name'] == "admin") {

                            require_once './class.film.php';

                            $nname = $_POST['nname'];
                            $nyear = $_POST['nyear'];
                            $ncountry = $_POST['ncountry'];
                            $ndurationMinutes = $_POST['ndurationMinutes'];
                            $ndirector = $_POST['ndirector'];
                            $n = new Film();

                            if ($nname != "" && $nyear != "" && $ncountry && $ndurationMinutes != "" && $ndirector != "") {
                                $n->insert_film($nname, $nyear, $ndurationMinutes, $ncountry, $ndirector);
                            } else {
                                echo 'please fill all fieldssss';
                            }
                        } else {
                            echo "you can not insert movie";
                        }
                    }
                    ?>

                </div>
                <br></br>
                <div class=""><h2>Search</h2> 
                    <form method="post" action="#" class="">
                        <input type="text" name="name" placeholder="Film Name"></input>
                        <input type="number" name="year" placeholder="year"></input>
                        <input type="text" name="country" placeholder="Country"></input>
                        <input type="text" name="director" placeholder="Director"></input>
                        <input type="submit" name="search" value="search"></input>
                    </form>
                </div>
                <div id="result_search">
                    <?php
                    require_once './class.film.php';
                    $filme = new Film();

                    if (isset($_POST['search'])) {

                        $name = $_POST['name'];
                        $year = $_POST['year'];
                        $country = $_POST['country'];
                        $director = $_POST['director'];
                        //   echo $filmee->guest_search($nameF);
                        echo $filme->member_search($name, $year, $country, $director);

                        // Write to default log
                        require_once './class.logs.php';

                        $s = new Logs();

                        $result = $s->write_log("An error occurred that prevented a message from being saved");

                        // Write to another log
                        define("UPLOAD_LOG", "/home/png/Desktop/upload.log");
                        $result = $s->write_log("User attempted to send file larger than 2 megabytes", UPLOAD_LOG);
                        echo 'dskjf';
                        echo 'dskjf';
                    }
                    ?>
                </div>
            </div>

        </div>

        <script src="bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>
