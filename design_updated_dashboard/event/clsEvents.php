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

// Add time??

    public function createEvent($name, $speaker, $address, $date, $fee, $description) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = connect();
	    
            $stmt = $db->prepare("INSERT INTO Event (name, speaker, street1, date, fee, description) VALUES (:name, :speaker, :street1, :date, :fee, :description)");

	    $stmt->execute(array('name' => $name, 'speaker' => $speaker, 'street1' => $address, 'date' => $date, 'fee' => $fee, 'description' => $description));
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
        $stmt = $db->prepare("SELECT * FROM Event WHERE date >= CURDATE() ORDER BY date ASC");
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
     * Not tested.
     */
    public function register($eventID, $userID) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
	   echo "hello";
            $db = connect();
            $stmt = $db->prepare("INSERT INTO EventAttend (eventID, userID) VALUES (:eventID, :userID)");
            $stmt->execute(array('eventID' => $eventID, 'userID' => $userID));
            disconnect($db);
        }
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
