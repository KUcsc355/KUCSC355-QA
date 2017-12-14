    <!-- PHP SEND MAIL FUNCTION -->
    <?php
                // john better put a super slick description of what this function does :)
    
        echo "test 1";
        echo "Subject: ".$_POST['subject'];
        $subject = $_POST['subject'];       
        $content = $_POST['content'];  
        echo $subject;
        echo $content;

         $ch = curl_init();
        echo "after curl_init()";
        curl_setopt($ch, CURLOPT_URL, "http://ec2-18-221-141-67.us-east-2.compute.amazonaws.com/announcement/blast");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"subject\": ".$subject.", \"content\":".$content."}");
      //  curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"subject\": \"test separate\", \"content\": \"blah blah blah\"}");
        curl_setopt($ch, CURLOPT_POST, 1);
        echo "after curl_setopt()";
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        echo "before $result assignment statement";
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
    
        curl_close ($ch);
   
    
    ?>