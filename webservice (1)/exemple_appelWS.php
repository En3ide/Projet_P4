<!DOCTYPE html>
<html>
<head>
    <title>text cnx</title>
</head>
<body>
<script>
/* interrogation du serveur local en ajax via fetch */
fetch("http://172.31.143.240/~serveur_local/api_read.php")
.then(response=>response.json())
.then(response => document.write(response))
.catch(error => alert("erreur"+error));
/**/
</script>


<?php
    /* interrogation du serveur distant en curl */ 
	$ch= curl_init("http://172.31.143.240/~serveur_distant/api_read.php");
	$data = array("user"=>"johndoe","user_id"=>1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	print_r(json_decode($response,true));
	echo "<br>";

    /* alternative: utilisation de file_get_contents */
	$opts = array('http' =>
    array(
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

	$context  = stream_context_create($opts);
	$url = "http://172.31.143.240/~serveur_distant/api_read.php";
	$raw = file_get_contents($url, false, $context);
	$obj = json_decode($raw,true);
	print_r($obj);
?>
</body>
</html>
