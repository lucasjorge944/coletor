<?php
	require "twitteroauth/autoload.php";
	require "db_connect.php";
	use Abraham\TwitterOAuth\TwitterOAuth;
	date_default_timezone_set('America/Bahia');

	$consumer_key = 'mG7bejDWumaYLKgQAkrHXJwBm'; 
	$consumer_secret = 'g5fwIst1PsOZFlQ51E24PDplWx0Lcgg0FKkc215VlGTFmaleyy'; 
	$oauth_token = '3620525715-HyXh18beP1xtZQhMhHqhCbyxTSiSMv0Dtdo9QW6'; 
	$oauth_token_secret = 'ybw1jrGyECmdV7C0afgxyQ79muRZq2acRseVYqBSX6ewW'; 

	$connection = new TwitterOAuth(
		$consumer_key, 
		$consumer_secret, 
		$oauth_token, 
		$oauth_token_secret
	);

	function criarArquivo($nome_arquivo, $tweets){
		$arquivo_tweets = fopen("coletas/".$nome_arquivo.".txt", "a+");
		fwrite($arquivo_tweets, $tweets);
		fclose($arquivo_tweets);
	}

	function coleta($connection, $conn){
		$tweets = $connection->get(
			'statuses/home_timeline',
			array("user_id"=>"644150770460426240")
		);
		//print_r($tweets);

		$data_hora = date('Y-m-d H:i:s');
		$nome_arquivo = date('Y-m-d-H-i-s');

		criarArquivo($nome_arquivo, $tweets);

		$sql = "INSERT INTO tbl_coletas VALUES (null, '".$data_hora."', '".$nome_arquivo."');";

		if ($conn->query($sql) === TRUE) {
	    	echo "Coleta Gravada com Sucesso!";
		} else {
		    echo "Error: " . "<br>" . $conn->error;
		}
	}

	function seguidores($connection, $conn){
		$tweets = $connection->get(
			'users/show',
			array("screen_name"=>"@tig2015")
		);

		$data_hora = date('Y-m-d H:i:s');

		$tweets = json_decode($tweets);
		$numero_seguidores = $tweets->followers_count;

		$sql = "INSERT INTO seguidores VALUES (null, '".$data_hora."', '".$numero_seguidores."');";

		if ($conn->query($sql) === TRUE) {
	    	echo "Seguidores Gravados!";
		} else {
		    echo "Error: " . "<br>" . $conn->error;
		}
	}

	coleta($connection, $conn);
	seguidores($connection, $conn);

?>