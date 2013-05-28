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

  if( isset($_POST) && count($_POST) ) {
    $mysqli = new mysqli("localhost","root","","");
    $keyword = $mysqli->real_escape_string($_POST['keyword']);
    
    $mysqli->query("INSERT INTO keywords(keyword, hashtag) VALUES('$keyword','$hashtags')");

    header("Location:keywords.php?id=".$_GET['id']);
    exit();
    $mysqli->close(); 
  }  // Fin du if


      include('inc/header.php'); 
      include('inc/menu.php'); 
    ?>

    <div class="container">
      <div class="row-fluid">
        <div class="span3">     
          <p>&nbsp;</p><p>&nbsp;</p>
          <form class="form" action="keywords.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="control-group">
              <label class="control-label" for="keyword">Keyword</label>
              <div class="controls">
                <input type="text" id="keyword" name="keyword" placeholder="Keyword">
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
        <h1>Keywords pour #<?php echo $hashtags; ?></h1>
        <p>Gerer les keywords pour #<?php echo $hashtags; ?></p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Keywords</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
        <?php
          $mysqli = new mysqli("localhost","root","","");
          $reponse = $mysqli->query("SELECT * FROM keywords WHERE hashtag='$hashtags'");
          
          while ($donnees = $reponse->fetch_assoc())
          {
        ?>
            <tr id="num_<?php echo $donnees['id']; ?>">
              <td><?php echo $donnees['id']; ?></td>
              <td><?php echo $donnees['keyword']; ?></td>
              <td><a class="btn btn-danger btn-mini btn-delete" data-base="keywords" data-id="<?php echo $donnees['id']; ?>"><i class="icon-remove"></i> Supprimer</a></td>
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