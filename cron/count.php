<?php
require('../inc/libs/twitter/tmhOAuth.php');
require('../inc/libs/twitter/tmhUtilities.php');
require('../inc/config.php');

$connection = new tmhOAuth(array(
  'consumer_key' => $consumer_key,
  'consumer_secret' => $consumer_secret,
  'user_token' => $user_token,
  'user_secret' => $user_secret
));

$tab = array('#ilfaitbeau','#ilpleut','#ilneige');

foreach ( $tab as $var )
{
  $response_code = $connection->request('GET',
  $connection->url('1.1/search/tweets'),
  array('q' => $var, 'result_type' => 'top','count' => '100'));

  $content = json_decode($connection->response['response'],true);
  $json = print_r($content,true);
  $compteur = count($content['statuses']);  

  switch ($var) {
    case "#ilfaitbeau":
        $cptbeau = $compteur;
        break;
    case "#ilpleut":
        $cptpleut = $compteur;
        break;
    case "#ilneige":
        $cptneige = $compteur;
        break;
  }
}

$bigger = max($cptbeau, $cptpleut, $cptneige);
$mysqli = new mysqli("localhost","root","","");
$date = date('Y-m-d H:i:s');

if ($bigger == $cptbeau){
  $mysqli->query("INSERT INTO hashtags(date, hashtag) VALUES('$date','ilfaitbeau')");
}elseif ($bigger == $cptpleut){
  $mysqli->query("INSERT INTO hashtags(date, hashtag) VALUES('$date','ilpleut')");
}else{
  $mysqli->query("INSERT INTO hashtags(date, hashtag) VALUES('$date','ilneige')");
}

$mysqli->close(); 
?>