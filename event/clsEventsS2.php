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
    public function createEvent($name, $speaker, $address, $date, $time, $fee, $description) {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = connect();
/*            $sql = "INSERT INTO Event (id, name, speaker, street1, street2, city, state, zip, date, fee, description, time, attendees) VALUES (1, '$name', '$speaker', '$address', '1', '1', '1', '1', $date, '$fee', '$description', $time, $attendees)";
*/
	$sql = "INSERT INTO Event(name, speaker, street1, street2, city, state, zip, date, fee, description, time, attendees) VALUES ('$name', '$speaker', '$address', 'fake','fake', 'na', '11111', '$date', '$fee', '$description', '$time', 0)";
            if ($db->error) {
                die($db->error);
		echo "Didn't work";
            }
	    
	    if ($db->query($sql)) {
                echo "Added event successfully!";
            }else {	      
                echo "Error: Did not add event."; /*. $sql . "<br>" . $db->error;*/
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
