<?php

require_once('dbconfig.php');

/**
 * Description of Film
 *
 * @author png
 */
class Film {

    public $name;
    public $year;
    public $country;
    public $durationMinutes;
    public $director;
    public $description;
    private $conn;

    public function __construct() {
        $database = Database::getInstance();
        $db = $database->getConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function guest_search($nameF) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM film where name='$nameF'");
            $stmt->execute();

            $num_rows = $stmt->rowCount();


            if ($num_rows > 0) {

                echo "</br>" . $num_rows . "&nbsp; film is found. </br>";
                echo "</br><table><tr><th>Name</th><th>Year</th><th>Country</th><th>durationMinutes</th><th>Director</th></tr>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    echo "<tr><td>" . $row['name'] . "</td><td>" . $row['year'] . "</td><td>" . $row['country'] . "</td><td>" . $row['durationMinutes'] . "</td><td>" . $row['director'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Nothing found !";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function member_search($name, $year, $country, $director) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM film where name='$name' or year='$year' or country='$country' or director='$director'");
            $stmt->execute();

            $num_rows = $stmt->rowCount();


            if ($num_rows > 0) {

                echo "</br>" . $num_rows . "&nbsp; film is found. </br>";
                echo "</br><table><tr><th>Name</th><th>Year</th><th>Country</th><th>durationMinutes</th><th>Director</th><th>your comment</th></tr>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    echo "<tr><td><a href='comments.php'>" . $row['name'] . "</td><td>" . $row['year'] . "</td><td>" . $row['country'] . "</td><td>" . $row['durationMinutes'] . "</td><td>" . $row['director'] . "</td>"
                    . "<td><textarea type='text' name='msg'rows='1' cols='30'></textarea><input type='submit' name='send' value='send'></input></td></tr>";
                }
                echo "</table>";
                if (isset($_POST['send'])) {
                    $msg = $_POST['msg'];
                    echo 'nn';
                    try {
                        $stmt = $this->conn->prepare("INSERT INTO comments(comment) VALUES('$msg')");
                        $stmt->execute();
                        echo "successefully added !";
                        return $stmt;
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                }
            } else {
                echo "Nothing found !";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert_film($nname, $nyear, $ncountry, $ndurationMinutes, $ndirector) {

        $this->name = $nname;
        $this->year = $nyear;
        $this->country = $ncountry;
        $this->durationMinutes = $ndurationMinutes;
        $this->director = $ndirector;
        try {
            $stmt = $this->conn->prepare("INSERT INTO film(name,year,country,durationMinutes,director) 
		                          VALUES('$this->name',' $this->year','$this->country','$this->durationMinutes','$this->director')");
            $stmt->execute();
            echo "successefully added !";
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert_from_json() {

        $filename = "info.json";
        $json = file_get_contents($filename);
        $result = json_decode($json);
        $stmt = $this->conn->prepare("
    INSERT INTO film (name, year, country, durationMinutes, director) 
    VALUES (:name, :year, :country, :durationMinutes, :director)");

        foreach ($result as $r) {
            $stmt->execute([
                ':name' => $r->name,
                ':year' => $r->year,
                ':country' => $r->country,
                ':durationMinutes' => $r->durationMinutes,
                ':director' => $r->director
            ]);
        }
        echo 'Insert Successfully';
    }

    public function read_from_file() {
        $json = file_get_contents($w->data() . "/library.json");
        $json = json_decode($json, true);

        foreach ($json as $item) {
            if (strpos(strtolower($item['data']['album']['artist']['name']), strtolower($query)) !== false ||
                    strpos(strtolower($item['data']['album']['name']), strtolower($query)) !== false ||
                    strpos(strtolower($item['data']['name']), strtolower($query)) !== false) {
                // do something
            }
        };
    }

    public function add_comment($username) {

        echo 'please write your opinion for this movie.<br><br >';
        $stmt = $this->conn->prepare("SELECT name FROM film");
        $stmt->execute();
        echo "<form method='post' action='#'>
        <select name='fname'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        echo "</select>" . "<br>"
        . "<textarea name = 'message' rows = '10' cols = '50'></textarea>"
        . "<input type = 'submit' name = 'send' value = 'send' />"
        . '</form>';
        if (isset($_POST['send'])) {
            $fname = $_POST['fname'];
            //  print_r($_POST);
            $msg = $_POST['message'];
            try {
                $stmt = $this->conn->prepare("INSERT INTO comments(fname,user_name,comment) VALUES('$fname','$username','$msg')");
                $stmt->execute();
                echo "successefully!";
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

}
