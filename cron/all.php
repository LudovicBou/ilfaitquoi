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

$mysqli = new mysqli("localhost","root","","");
$reponse = $mysqli->query('SELECT * FROM keywords');

while ($donneesg = $reponse->fetch_assoc())
{
  $response_code = $connection->request('GET',
  $connection->url('1.1/search/tweets'),
  array('q' => $donneesg['keyword'], 'result_type' => 'top','count' => '100'));

  $content = json_decode($connection->response['response'],true);
  $json = print_r($content,true);

  foreach ($content['statuses'] as $tweet) {
    if(!empty($tweet['entities']['media'])){
      foreach ($tweet['entities']['media'] as $img) {
        $tweet_created_at = date('Y-m-d H:i:s', strtotime($tweet['created_at']));

        $tweet_id = $tweet['id_str'];
        $tweet_text = $tweet['text'];

        $media_id = $img['id_str'];
        $media_url = $img['media_url'];
        $media_display_url = $img['display_url'];
        $media_expanded_url = $img['expanded_url'];

        $ilfaitquoi_hashtag = $donneesg['hashtag'];
        $user_id = $tweet['user']['id_str'];
        $user_name = $tweet['user']['name'];
        $user_screen_name = $tweet['user']['screen_name'];

        $reqq = $mysqli->query("SELECT user_pseudo FROM blacklist");
        $ress = $reqq->fetch_assoc();
        $req = $mysqli->query("SELECT id FROM tweets WHERE media_url='$media_url'");
        $res = $req->fetch_assoc();
        if(($res['id']=='') && ($user_screen_name!=$ress['user_pseudo']))
          $mysqli->query("INSERT INTO tweets(tweet_created_at, tweet_id, tweet_text, media_id, media_url, media_display_url, media_expanded_url, ilfaitquoi_hashtag, user_id, user_name, user_screen_name, del)VALUES('$tweet_created_at','$tweet_id','$tweet_text','$media_id','$media_url','$media_display_url','$media_expanded_url','$ilfaitquoi_hashtag','$user_id','$user_name','$user_screen_name', '2')");
       }
    }
  }
}
$mysqli->close();
?>