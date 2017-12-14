    <!-- PHP SEND MAIL FUNCTION -->
    <?php
        $event = (string) $_POST['event'];       
        $speaker = (string) $_POST['speaker'];  
		$date = (string) $_POST['date'];
		$streetAdd = (string) $_POST['streetAdd'];
		$city = (string) $_POST['city'];
		$zip = (string) $_POST['zip'];
		$fee= (string) $_POST['fee'];
		$description= (string) $_POST['description'];
 
		$curlInfo = "{\"email\": \"" . $email . "\" , \"fname\": \"" . $fname 
			. "\" , \"lname\": \"" . $lname . "\" , \"list\": \"" . $membershipType . "\"}";
		
        echo " \n curlInfo: $curlInfo Type: " . gettype($curlInfo);
		echo $curlInfo
		
		$ch = curl_init();
        /* line for local AWS 
		curl_setopt($ch, CURLOPT_URL, "http://ec2-18-216-109-127.us-east-2.compute.amazonaws.com:9000/announcement/schedule");
		*/
		curl_setopt($ch, CURLOPT_URL, "http://ec2-18-221-141-67.us-east-2.compute.amazonaws.com:81/announcement/schedule");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlInfo);
		curl_setopt($ch, CURLOPT_POSTFIELDS);
		curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        else

	curl_close ($ch);
   
    
    ?>
<script>
window.location = "http://ec2-18-216-109-127.us-east-2.compute.amazonaws.com/login/mail.php";
</script>

