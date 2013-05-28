    <?php
      include('inc/header.php'); 
      include('inc/menu.php'); 
    ?>

    <div class="container">
      <div class="row-fluid">
        <div class="span4">
          <h1>Taches cron</h1>
          <p>Exectuer les taches cron.</p>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Titre</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="corpstab">
              <tr>
                <td>COUNT</td>
                <td><a class="btn btn-info btn-mini btn-refresh-count"><i class="icon-refresh"></i> Relancer</a></td>
              </tr>
              <tr>
                <td>ALL</td>
                <td><a class="btn btn-info btn-mini btn-refresh-all"><i class="icon-refresh"></i> Relancer</a></td>
              </tr>
              <tr>
                <td>PURGE</td>
                <td><a class="btn btn-info btn-mini btn-refresh-purge"><i class="icon-refresh"></i> Relancer</a></td>
              </tr>
            </tbody>
          </table>
        </div>


        <div class="span4">
          <h1>Liste hashtags</h1>
          <p>La liste des hashtags depuis une semaine.</p>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Titre</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody id="corpstab">
            <?php
              $mysqli = new mysqli("localhost","root","","");
              $reponse = $mysqli->query("SELECT * FROM hashtags ORDER BY date DESC LIMIT 10");
              
              while ($donnees = $reponse->fetch_assoc())
              {
            ?>
                <tr id="num_<?php echo $donnees['id']; ?>">
                  <td><?php echo $donnees['hashtag']; ?></td>
                  <td><?php echo date("d-m-Y", strtotime($donnees['date'])); ?></td>
                </tr>
            <?php
                }
                $mysqli->close();
            ?>
            </tbody>
          </table>
        </div>


        <div class="span4">
          <h1>Activer hashtag</h1>
          <p>Activer l'un des trois hashtags.</p>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Titre</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="corpstab">
              <tr>
                <td>#ilneige</td>
                <td><a class="btn btn-mini btn-updaten" data-id="neige"><i class="icon-off"></i> Actif</a></td>
              </tr>
              <tr>
                <td>#ilpleut</td>
                <td><a class="btn btn-mini btn-updatep" data-id="pleut"><i class="icon-off"></i> Actif</a></td>
              </tr>
              <tr>
                <td>#ilfaitbeau</td>
                <td><a class="btn btn-mini btn-updateb" data-id="beau"><i class="icon-off"></i> Actif</a></td>
              </tr>
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