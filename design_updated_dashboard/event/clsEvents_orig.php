<?php
/**
 * Change this so that it includes connect.php from the database
 * team in the final build.
 */
require_once("settings.php");

class Events {
/*
    private $address;
    private $date;
    private $description;
    private $fee;
    private $id;
    private $name;
    private $speaker;
*/
    public function __construct() {

    }

    /**
     * Replace param $time in the final build with $fee since the database team
     * uses $date for the actual date and time as well.
     */
    public function createEvent($name, $speaker, $address, $date, $time, $description) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = connect();
            $sql = "INSERT INTO events (name, speaker, address, date, time, description) VALUES ('$name', '$speaker', '$address', '$date', '$time', '$description')";

            if ($db->error) {
                die($db->error);
            }

            if ($db->query($sql)) {
                // echo "Added event successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }

            disconnect($db);
        }
    }

    public function getTotalEvents() {
        $db = connect();
        $sql = "SELECT * FROM events";
        $result = $db->query($sql);
        $size = mysqli_num_rows($result);
        disconnect($db);
        return $size;
    }

    /**
     * TO-DO: Add alternate methods for retrieving an event (i.e., by name when
     * the index is unknown). Maybe even divide this method into submethods that
     * will retrieve each field individually.
     */
    public function retrieveEvent($index, $field) {
        $db = connect();
        $sql = "SELECT * FROM events ORDER BY id DESC";
        $result = $db->query($sql);

        mysqli_data_seek($result, $index);
        $row = mysqli_fetch_assoc($result);
        disconnect($db);

        return $row[$field];
    }
}

?>
