<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Il fait quoi ?</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Quel temps fait-il dans la twittosphère ?">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {padding-bottom:60px; font-family:Museo Slab; overflow: hidden;}
      .right{float: right; margin-top:10px;color: grey;}
      .right:hover{text-decoration: none;}
      .brand{font-size: 12pt !important; }
      #logo{position: fixed; display: block; left: 50%; margin-left: -227px; top: 50%;margin-top: -245px;}
      .container{text-align: center;width: 100% !important;}
      .row-fluid [class*="span"] { margin-left: 1px !important;}
      .navbar-inner .container {width: 80% !important;}
      figure figcaption { display: none; background:white; color: black; opacity: 0.8; text-align: left; font-family: Arial; } 
      figure figcaption p, figure figcaption p a { font-size: 9pt; font-weight: lighter; } 
      figcaption a{ font-weight: bold; font-size: 12pt; text-decoration: none; }
      figcaption a:hover{ text-decoration: none; }
      figure:hover figcaption, figure.info_bulle:focus figcaption, figure.info_bulle:active figcaption { position: absolute; width: 13.55%; padding: 1%; margin: 0.5%; display: block; }
      .tweet{padding-top: 8px;}
    </style>

    <link href="css/responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php   $mysqli = new mysqli("localhost","root","","");
            $donnee = $mysqli->query("SELECT hashtag FROM hashtags ORDER BY date DESC LIMIT 1"); 
            $btntweet = $donnee->fetch_assoc();
     ?>

    <div class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="navbar-inner">
        <div class="navbar-inner container">
          <a class="brand" href="#">ilfaitquoi.com - Quel temps fait-il dans la twittosphère ?</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php?h=ilneige">#ilneige</a></li>
              <li><a href="index.php?h=ilpleut">#ilpleut</a></li>
              <li><a href="index.php?h=ilfaitbeau">#ilfaitbeau</a></li>
              <li class="tweet"><a href="https://twitter.com/share" class="twitter-share-button" data-text="Quel temps fait-il dans la twittosphère ? #<?php echo $btntweet['hashtag']; ?>" data-via="Ludo__B">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
            </ul>
          </div><!--/.nav-collapse -->
          <a class="right" href="https://twitter.com/Ludo__B">@Ludo__B</a>
        </div>
      </div>
    </div>
    
    <div class="container">
      <div id="logo">
        <?php   if(isset($_GET['h'])) {
                  $idhash = $_GET['h']; ?>
                  <img class="center" src="img/<?php echo $idhash; ?>.png" alt="<?php echo $idhash; ?>" />
        <?php   }else{
                  $reponse = $mysqli->query("SELECT hashtag FROM hashtags ORDER BY date DESC LIMIT 1"); 
                  $fluxgeneral = $reponse->fetch_assoc();
                  $hashtagactuel = $fluxgeneral['hashtag'];  ?>
                  <img class="center" src="img/<?php echo $fluxgeneral['hashtag']; ?>.png" alt="<?php echo $fluxgeneral['hashtag']; ?>" />
        <?php   } ?>
      </div>

      <div class="row-fluid">
          <div class="span2">
            <?php   if(isset($_GET['h'])) {
                      $idhash = $_GET['h']; 
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$idhash' AND del=0 ORDER BY tweet_created_at DESC LIMIT 5");
                    }else{
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$hashtagactuel' AND del=0 ORDER BY tweet_created_at DESC LIMIT 5");
                    }
                    
                    while ($donnees = $reponse->fetch_assoc()){ ?>
                      <figure>
                        <figcaption><a href="https://twitter.com/<?php echo $donnees['user_screen_name']; ?>">@<?php echo $donnees['user_screen_name']; ?></a><br /><p><?php echo $donnees['tweet_text']; ?></p></figcaption>
                        <img src="<?php echo $donnees['media_url']; ?>" alt=""/>
                      </figure>
            <?php   } ?> 
          </div>

          <div id="resp5" class="span2">
            <?php   if(isset($_GET['h'])) {
                      $idhash = $_GET['h']; 
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$idhash' AND del=0 ORDER BY tweet_created_at DESC LIMIT 5,5");
                    }else{ 
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$hashtagactuel' AND del=0 ORDER BY tweet_created_at DESC LIMIT 5,5");
                    }         
                    
                    while ($donnees = $reponse->fetch_assoc()){ ?>
                      <figure>
                        <figcaption><a href="https://twitter.com/<?php echo $donnees['user_screen_name']; ?>">@<?php echo $donnees['user_screen_name']; ?></a><br /><p><?php echo $donnees['tweet_text']; ?></p></figcaption>
                        <img src="<?php echo $donnees['media_url']; ?>" alt=""/>
                      </figure>
            <?php   } ?> 
          </div>

          <div id="resp4" class="span2">
            <?php   if(isset($_GET['h'])) {
                      $idhash = $_GET['h']; 
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$idhash' AND del=0 ORDER BY tweet_created_at DESC LIMIT 10,5");
                    }else{
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$hashtagactuel' AND del=0 ORDER BY tweet_created_at DESC LIMIT 10,5");
                    }

                    while ($donnees = $reponse->fetch_assoc()){ ?>
                      <figure>
                        <figcaption><a href="https://twitter.com/<?php echo $donnees['user_screen_name']; ?>">@<?php echo $donnees['user_screen_name']; ?></a><br /><p><?php echo $donnees['tweet_text']; ?></p></figcaption>
                        <img src="<?php echo $donnees['media_url']; ?>" alt=""/>
                      </figure>
            <?php   } ?> 
          </div>

          <div id="resp3" class="span2">
            <?php   if(isset($_GET['h'])) {
                      $idhash = $_GET['h']; 
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$idhash' AND del=0 ORDER BY tweet_created_at DESC LIMIT 15,5");
                    }else{
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$hashtagactuel' AND del=0 ORDER BY tweet_created_at DESC LIMIT 15,5");
                    }

                    while ($donnees = $reponse->fetch_assoc()){ ?>
                      <figure>
                        <figcaption><a href="https://twitter.com/<?php echo $donnees['user_screen_name']; ?>">@<?php echo $donnees['user_screen_name']; ?></a><br /><p><?php echo $donnees['tweet_text']; ?></p></figcaption>
                        <img src="<?php echo $donnees['media_url']; ?>" alt=""/>
                      </figure>
            <?php   } ?> 
          </div>

          <div id ="resp2" class="span2">
            <?php   if(isset($_GET['h'])) {
                      $idhash = $_GET['h']; 
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$idhash' AND del=0 ORDER BY tweet_created_at DESC LIMIT 20,5");
                    }else{
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$hashtagactuel' AND del=0 ORDER BY tweet_created_at DESC LIMIT 20,5");
                    }

                    while ($donnees = $reponse->fetch_assoc()){ ?>
                      <figure>
                        <figcaption><a href="https://twitter.com/<?php echo $donnees['user_screen_name']; ?>">@<?php echo $donnees['user_screen_name']; ?></a><br /><p><?php echo $donnees['tweet_text']; ?></p></figcaption>
                        <img src="<?php echo $donnees['media_url']; ?>" alt=""/>
                      </figure>
            <?php   } ?> 
          </div>

          <div id="resp1" class="span2">
            <?php   if(isset($_GET['h'])) {
                      $idhash = $_GET['h']; 
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$idhash' AND del=0 ORDER BY tweet_created_at DESC LIMIT 25,5");
                    }else{
                      $reponse = $mysqli->query("SELECT media_url, user_screen_name, tweet_text FROM tweets WHERE ilfaitquoi_hashtag='$hashtagactuel' AND del=0 ORDER BY tweet_created_at DESC LIMIT 25,5");
                    }

                    while ($donnees = $reponse->fetch_assoc()){ ?>
                      <figure>
                        <figcaption><a href="https://twitter.com/<?php echo $donnees['user_screen_name']; ?>">@<?php echo $donnees['user_screen_name']; ?></a><br /><p><?php echo $donnees['tweet_text']; ?></p></figcaption>
                        <img src="<?php echo $donnees['media_url']; ?>" alt=""/>
                      </figure>
            <?php   } ?> 
          </div>
      </div>
    </div> <!-- /container -->
    
    <?php   $mysqli->close();  ?> 
  </body>
</html>