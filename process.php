<?php

/*

Server side --
Checks if email exists via kickbox
If exists, stores the data into the database and sends a confirmation at frontend

*/

require_once('config.php');
require_once("kickbox/vendor/autoload.php");
require_once('credentials.php');
?>
<?php

if(isset($_POST)){
	$name = $_POST['username'];
	$email = $_POST['email'];
	
	$client   = new Kickbox\Client($KICKBOX_API_KEY);
    $kickbox  = $client->kickbox();
	 
	$verf = 0;
    try {
        $response = $kickbox->verify($email);
     
        switch($response->code) {
            case 200:
                if ($response->body['result'] == 'deliverable') {
                    //echo "Valid Email.";
                    $verf = 1;
                    
                } else {
					echo "Invalid Email. Data not saved!";
					$verf = 0;
                    
                }
                break;
            case 429:
                echo "Rate limit exceeded.";
                break;
            default:
                echo "Something went wrong";
        }
    }
    catch (Exception $e) {
        echo "Code: " . $e->getCode() . " Message: " . $e->getMessage();
	}
	if ($verf == 1){
		$sql = "INSERT INTO users (name,email) VALUES (?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$name,$email]);
		if($result){
			echo 'Registration successful!';
		}
		else{
			echo 'Error saving';
		}
	}

}
else {
	echo 'No data';
}

