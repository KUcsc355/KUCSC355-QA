    <!-- PHP SEND MAIL FUNCTION -->
    <?php
    
    
		
        $subject = (string) $_POST['subject'];       
        $content = (string) $_POST['content'];  
		echo gettype($subject);
 
		echo $subject . " " . $content;

		$curlInfo = "{\"subject\": \"" . $subject . "\" , \"content\": \" " . $content . "\" }";
		$curlInfoTest = "{\"subject\": \"test separate\", \"content\": \"blah blah blah\"}";
        echo " \n curlInfo: $curlInfo Type: " . gettype($curlInfo);
		echo " \n curlInfoTest: $curlInfoTest Type: " . gettype($curlInfoTest);
		
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ec2-18-216-109-127.us-east-2.compute.amazonaws.com:9000/announcement/blast");
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
