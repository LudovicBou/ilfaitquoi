<?php 
  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    switch ($id) {
        case "neige":
            $hashtags ="ilneige";
            break;
        case "pleut":
            $hashtags ="ilpleut";
            break;
        case "beau":
            $hashtags ="ilfaitbeau";
            break;
    }
  }  // Fin du if
?>

    <?php
      include('inc/header.php'); 
      include('inc/menu.php'); 
    ?>



    <div class="container">
      <h1>Hashtag #<?php echo $hashtags; ?></h1>
      <p>Gerer les resultats pour #<?php echo $hashtags; ?></p>
      <?php if(!isset($_GET['valid'])) { ?>
      <a href="hashtags.php?id=<?php echo $id; ?>&valid=valid">Voir les tweets validés</a>
      <?php } ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Image</th>
            <th>Date</th>
            <th>Auteur</th>
            <th>Tweet</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $mysqli = new mysqli("localhost","root","","");
          if($_GET['valid']=='valid') {
            $reponse = $mysqli->query("SELECT * FROM tweets WHERE ilfaitquoi_hashtag='$hashtags' AND del=0 ORDER BY tweet_created_at DESC");
          }else{
            $reponse = $mysqli->query("SELECT * FROM tweets WHERE ilfaitquoi_hashtag='$hashtags' AND del=2 ORDER BY tweet_created_at DESC");
          }
          while ($donnees = $reponse->fetch_assoc())
          {
        ?>
            <tr id="num_<?php echo $donnees['id']; ?>">
              <td><img class="img-rounded" src="<?php echo $donnees['media_url']; ?>" alt=""/></td>
<?php
        $date = $donnees['tweet_created_at'];
        $datetime =  strtotime($date);                     
        $tweet_created_at = date("d-m-Y", $datetime);
?>

              <td><?php echo $tweet_created_at; ?></td>
              <td><a href="https://twitter.com/<?php echo $donnees['user_screen_name']; ?>">@<?php echo $donnees['user_screen_name']; ?></a></td>
              <td><?php echo $donnees['tweet_text']; ?></td>
              <td><?php  if(!isset($_GET['valid'])) {   ?><a class="btn btn-info btn-mini btn-delete" data-base="valid" data-id="<?php echo $donnees['id']; ?>"><i class="icon-ok"></i> Valider</a>
              <?php } ?>

              
            <a class="btn btn-danger btn-mini btn-delete" data-base="tweets" data-id="<?php echo $donnees['id']; ?>"><i class="icon-remove"></i> Supprimer</a></td>


            </tr>
        <?php
            }
            $mysqli->close();
        ?> 
        </tbody>
      </table>

    	<p>&nbsp;</p>

      <hr>

      <footer>
        <p>&copy; ilfaitquoi 2013</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="js/admin.js"></script>

  </body>
</html>