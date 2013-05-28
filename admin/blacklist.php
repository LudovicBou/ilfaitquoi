<?php 
  if( isset($_POST) && count($_POST) ) {
    $mysqli = new mysqli("localhost","root","","");
    $pseudo = $mysqli->real_escape_string($_POST['pseudo']);
    $user_id = $mysqli->real_escape_string($_POST['user_id']);
    
    $mysqli->query("INSERT INTO blacklist(user_pseudo, user_id) VALUES('$pseudo','$user_id')");
    $mysqli->query("UPDATE tweets SET del=1 WHERE user_screen_name='$pseudo' ");

    $mysqli->close(); 
  }  // Fin du if


?>
    <?php
      include('inc/header.php'); 
      include('inc/menu.php'); 
    ?>


    <div class="container">
      <div class="row-fluid">
        <div class="span3">     
          <p>&nbsp;</p><p>&nbsp;</p>
          <form class="form" action="blacklist.php" method="POST">
            <div class="control-group">
              <label class="control-label" for="pseudo">Pseudo à blacklister</label>
              <div class="controls">
                <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="user_id">User_ID à blacklister</label>
              <div class="controls">
                <input type="text" id="user_id" name="user_id" placeholder="User_ID">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn">Valider</button>
              </div>
            </div>
          </form>
        </div>

        <div class="span9">
        <h1>Blacklist</h1>
        <p>Liste des comptes blacklistés</p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Pseudo</th>
              <th>User_ID</th>
            </tr>
          </thead>
          <tbody>
        <?php
          $mysqli = new mysqli("localhost","root","","");
          $reponse = $mysqli->query("SELECT * FROM blacklist");
          
          while ($donnees = $reponse->fetch_assoc())
          {
        ?>
            <tr id="num_<?php echo $donnees['id']; ?>">
              <td><?php echo $donnees['user_pseudo']; ?></td>
              <td><?php echo $donnees['user_id']; ?></td>
              <td><a class="btn btn-danger btn-mini btn-delete" data-base="blacklist" data-id="<?php echo $donnees['id']; ?>"><i class="icon-remove"></i> Supprimer</a></td>
            </tr>
        <?php
            }
            $mysqli->close();
        ?> 
          </tbody>
        </table>
      </div>
      </div>
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