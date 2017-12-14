<?php
/**
 * Change this so that it includes connect.php from the database
 * team in the final build.
 *
 * Update to eventually use PDO for database access.
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
    public function createEvent($name, $speaker, $address, $date, $time, $fee, $description) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = connect();
            $stmt = $db->prepare("INSERT INTO events (name, speaker, address, date, time, description) VALUES (:name, :speaker, :address, :date, :time, :description)");
            $stmt->execute(array('name' => $name, 'speaker' => $speaker, 'address' => $address, 'date' => $date, 'time' => $time, 'description' => $description));
            disconnect($db);
        }
    }

    public function deleteEvent() {

    }

    /**
     * Retrieve events from this day on forward.
     * These events are stored in an array.
     */
    public function getAllEventInfo() {
        $db = connect();
        $events = array();
        $stmt = $db->prepare("SELECT * FROM events WHERE date >= CURDATE() ORDER BY id DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }

        disconnect($db);
        return $events;
    }

    public function getTotalEvents() {
        $db = connect();
        $stmt = $db->prepare("SELECT * FROM events");
        $stmt->execute();
        disconnect($db);
        return $stmt->rowCount();
    }

    /**
     * TO-DO: Add alternate methods for retrieving an event (i.e., by name when
     * the index is unknown).
     */
    public function retrieveEvent($index, $field) {
        $db = connect();
        $savedRow = null;
        $seekPos = 0;
        $stmt = $db->prepare("SELECT * FROM events ORDER BY id DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($seekPos == $index) {
                $savedRow = $row;
                break;
            }
            ++$seekPos;
        }

        disconnect($db);

        return $savedRow[$field];
    }

    public function updateEvent() {

    }
}

?>
