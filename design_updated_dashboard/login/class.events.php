<?php
/**
 * Change this so that it includes connect.php from the database
 * team in the final build. Condense to 80 chars/line...
 */
//require_once("settings.php");

class Events {
    private $db;

    public function __construct($DB_con) {
        $db = $DB_con;
    }

    public function createEvent($name, $speaker, $date, $street1, $city, $zip, $fee, $description) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stmt = $db->prepare("INSERT INTO Event (name, speaker, date, street1, city, zip, fee, description) VALUES (:name, :speaker, :date, :street1, :city, :zip, :fee, :description)");
            $stmt->execute(array('name' => $name, 'speaker' => $speaker, 'date' => $date, 'street1' => $street1, 'city' => $city, 'zip' => $zip, 'fee' => $fee, 'description' => $description));
        }
    }

    // Should we update this to delete by id?
    public function deleteEvent($name) {
        $db->exec("DELETE FROM events WHERE name='$name'");
    }

    /**
     * Retrieve events from this day on forward.
     * These events are stored in an array.
     */
    public function getAllEventInfo() {
        $events = array();
        $stmt = $db->prepare("SELECT * FROM events WHERE date >= CURDATE() ORDER BY id DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }

        return $events;
    }

    public function getTotalEvents() {
        $stmt = $db->prepare("SELECT * FROM events");
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Not tested.
     */
    public function register($eventID, $userID) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stmt = $db->prepare("INSERT INTO EventAttend (eventID, userID) VALUES (:eventID, :userID)");
            $stmt->execute(array('eventID' => $eventID, 'userID' => $userID));
        }
    }

    public function retrieveEvents() {
        $events = array();
        $stmt = $db->prepare("SELECT * FROM Event ORDER BY eventID DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }

        return $events;
    }

    public function post() {
        echo("Hi");
    }

    /**
     * TO-DO: Add alternate methods for retrieving an event (i.e., by name when
     * the index is unknown).
     */
    public function retrieveEvent($index, $field) {
        $savedRow = null;
        $seekPos = 0;
        $stmt = $db->prepare("SELECT * FROM Event ORDER BY eventID DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($seekPos == $index) {
                $savedRow = $row;
                break;
            }
            ++$seekPos;
        }

        return $savedRow[$field];
    }

    // Should we update this to update by id?
    public function updateEvent($name, $speaker, $address, $date, $time, $fee, $description) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stmt = $db->prepare("UPDATE events SET name='$name', speaker='$speaker', address='$address', date='$date', time='$time', fee=$fee, description='$description' WHERE name='$name'");
            $stmt->execute();
        }
    }
}

?>
