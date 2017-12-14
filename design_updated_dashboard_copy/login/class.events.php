<?php

class Events {
    private $db;

    public function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function createEvent($name, $speaker, $date, $time, $street1, $street2, $city, $state, $zip, $fee, $description) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stmt = $this->db->prepare("INSERT INTO Event (name, speaker, date, time, street1, street2, city, state, zip, fee, description) VALUES (:name, :speaker, :date, :time, :street1, :street2, :city, :state, :zip, :fee, :description)");
            $stmt->execute(array('name' => $name, 'speaker' => $speaker, 'date' => $date, 'time' => $time, 'street1' => $street1, 'street2' => $street2, 'city' => $city, 'state' => $state, 'zip' => $zip, 'fee' => $fee, 'description' => $description));
        }
    }

    // Should we update this to delete by id?
    public function deleteEvent($name) {
        $this->db->exec("DELETE FROM Event WHERE name='$name'");
    }

    /**
     * Retrieve events from this day on forward.
     * These events are stored in an array.
     */
    public function getAllEventInfo() {
        $events = array();
        $stmt = $this->db->prepare("SELECT * FROM Event WHERE date >= CURDATE() ORDER BY eventID DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }

        return $events;
    }

    // Not finished.
    public function getHeadCount($name) {
        $stmt = $this->db->prepare("SELECT COUNT(EventAttend.userID) FROM EventAttend WHERE Event.name='$name' INNER JOIN Event ON Event.userID=EventAttend.userID");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalEvents() {
        $stmt = $this->db->prepare("SELECT * FROM Event");
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Not tested.
     */
    public function register($eventID, $userID) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stmt = $this->db->prepare("INSERT INTO EventAttend (eventID, userID) VALUES (:eventID, :userID)");
            $stmt->execute(array('eventID' => $eventID, 'userID' => $userID));
        }
    }

    public function retrieveEvents() {
        $events = array();
        $stmt = $this->db->prepare("SELECT * FROM Event ORDER BY eventID DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }

        return $events;
    }

    public function post() {
        return "Hi";
    }

    /**
     * TO-DO: Add alternate methods for retrieving an event (i.e., by name when
     * the index is unknown).
     */
    public function retrieveEvent($index, $field) {
        $savedRow = null;
        $seekPos = 0;
        $stmt = $this->db->prepare("SELECT * FROM Event ORDER BY eventID DESC");
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
    public function updateEvent($name, $speaker, $date, $time, $street1, $street2, $city, $state, $zip, $fee, $description) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stmt = $this->db->prepare("UPDATE Event SET name='$name', speaker='$speaker', date='$date', time='$time', street1='$street1', street2='$street2', city='$city', state='$state', zip='$zip', fee='$fee', description='$description' WHERE name='$name'");
            $stmt->execute();
        }
    }
}

?>
