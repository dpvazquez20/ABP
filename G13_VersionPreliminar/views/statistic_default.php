<!-- User's default view -->

<?php
class StatisticDefault
{
    private $data;
    private $message;

    function __construct($data, $message, $list)
    {
        $this->data = $data;
        $this->message = $message;
        $this->list = $list;
        $this->render();
    }

    function render()
    {
?>
    <html lang="es">
        <?php
            //include '../views/head.php';
            include '../languages/spanish.php';
            include '../functions/functions.php';
        ?>
        <!-- Page head -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- JQuery library -->
    <script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script language="JavaScript" type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../styles/styles.css" rel="stylesheet">

    <!-- JQuery and JavaScript files -->
    <script language="JavaScript" type="text/javascript" src= "../js/javascript.js"></script>
    <script language="JavaScript" type="text/javascript" src= "../js/validations.js"></script>

    <!-- Image in the window -->
    <link rel="shortcut icon" href="../images/windowLogo.png" type="image/png">

    <!-- Alertify JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="../js/custom_alerts.js" type="text/javascript"></script>

    <!-- Alertify CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>

    <!-- Alertify's Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        <?php echo
        "var data = google.visualization.arrayToDataTable([
        //['" . $strings['amountUsers'] . ": " . $this->data['numUsers'] . "', '" . $strings['User'] . "'],
        ['', ''],
        ['" . $strings['tdu'] . "', " . $this->data['TDUUsers'] . "],
        ['" . $strings['pef'] . "', " . $this->data['PEFUsers'] . "]
        ]);


        var options = {
          title: '" . $strings['amountUsers'] . ": " . $this->data['numUsers'] ."',
          titleTextStyle: {
                      fontSize: 20},
          slices: {
            0: { color: 'gold' },
            1: { color: 'silver' }
          },
          legend: {
                position: 'bottom'
          }
        };"
        ; ?>

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        <?php

        $users = getUsersPerActivity();
        $users2 = getUsersPerActivity2();
        $result = mergeList($users,$users2);

        echo "var data = google.visualization.arrayToDataTable([
        ['', ''],";
        foreach ($result as $row)
        {
            echo "['" . $row['nombre'] . "', " . $row['num'] . "],";
            //echo '<a class="list-group-item">' . $row['nombre'] . '<span class="badge">' . $row['num'] . '</span></a>';
        }
        /*echo "['" . $strings['numMuscular'] . "', " . 3 . "],
        ['" . $strings['numCardio'] . "', " . 3 . "],
        ['" . $strings['numStretching'] . "', " . 3 . "]
        */


        echo "]);
        var options = {
          title: '" . $strings['numExercises'] . ": " . 9 . "',
          titleTextStyle: {
                      fontSize: 20},
          pieHole: 0.4,
          legend: {
                position: 'bottom'
          }
        };"
        ; ?>

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

        chart.draw(data, options);
      }
    </script>
    

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        <?php

        echo "var data = google.visualization.arrayToDataTable([
        ['', ''],
        ['" . $strings['numMuscular'] . "', " . $this->data['numMuscular'] . "],
        ['" . $strings['numCardio'] . "', " . $this->data['numCardio'] . "],
        ['" . $strings['numStretching'] . "', " . $this->data['numStretching'] . "]
        ]);


        var options = {
          title: '" . $strings['numExercises'] . ": " . $this->data['numExercises'] ."',
          titleTextStyle: {
                      fontSize: 20
          },
          legend: {
                position: 'bottom'
          }
        };"
        ; ?>

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
    </script>

      <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            <?php
                $activities = getActivitiesPerDays();

            echo '["", "", { role: "style" } ],
                ["' . $strings['monday'] .'", ' . $activities['monday'] . ', "color: #CC5B14"],
                ["' . $strings['tuesday'] .'", ' . $activities['tuesday'] . ', "color: #99603D"],
                ["' . $strings['wednesday'] .'", ' . $activities['wednesday'] . ', "color: #FF1700"],
                ["' . $strings['thursday'] .'", ' . $activities['thursday'] . ', "color: #40FF62"],
                ["' . $strings['friday'] .'", ' . $activities['friday'] . ', "color: #1ACC00"],
                
                ]);';
                /*["' . $strings['saturday'] .'", ' . $activities['saturday'] . ', "color: #828282"],
                ["' . $strings['sunday'] .'", ' . $activities['sunday'] . ', "color: #828282"]*/

          

          echo 'var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);';

          echo 'var options = {
            title: "' . $strings['ActivityPerDay'] .  '",
            titleTextStyle: {
                      fontSize: 20},
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };';

          ?>

          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
      </script>

      <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            <?php
                $mExercises = getMostUsedExercise();

            echo '["", "", { role: "style" } ],';

            foreach ($mExercises as $row)
            {
                echo '["' . $row['nombre'] .'", ' . $row['num'] . ', ""],';
            }    

          echo ']);
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);';

          echo 'var options = {
            title: "' . $strings['TopExercises'] .  '",
            titleTextStyle: {
                      fontSize: 20},
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };';

          ?>

          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
          chart.draw(view, options);
      }
      </script>
    
</head>

        <title> <?php echo $strings['Statistics']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Order and search squares -->
                        <?php
                            if ($_SESSION['userType'] == $strings['coach'])
                            {
                        ?>
                                <div class="row" id="order_search">
                                    <?php
                                        $listOrder = array('Name A-Z', 'Name Z-A', 'Surnames A-Z', 'Surnames Z-A');
                                        generateOrderAndSearch($listOrder, 'statistics');
                                    ?>
                                </div>
                        <?php
                            }
                        ?>
                        <!-- End of the squares -->
                        <div class="col-md-12" height="100%">
                            
                                <?php
                                    if ($_SESSION['userType'] == $strings['secretary'])
                                    {
                                        echo    '<div class="col-md-4" style="margin: auto">
                                                    <div id="columnchart_values" style="height: 50%"></div>
                                                </div>';

                                        echo    '<div class="col-md-4" style="margin: auto">
                                                    <div id="donutchart" style="height: 50%"></div>
                                                </div>';

                                        echo    '<div class="col-md-4" style="margin: auto">
                                                    <div id="piechart" style="height: 50%"></div>
                                                </div>';
                                
                                    }else{
                                        if ($_SESSION['userType'] == $strings['coach'])
                                        {
                                       echo    '<div class="col-md-6" style="margin: auto">
                                                    <div id="piechart2" style="height: 50%"></div>
                                                </div>';

                                        echo    '<div class="col-md-6">
                                                    <div id="columnchart_values2" style="height: 50%"></div>
                                                </div>';
                                        }
                                    }
                                ?> 
                            </div>
                        </div>    

                        <div class="row">
                            <!-- Operation message -->
                            <?php showMessage($this->message); ?>
                            <!-- End of the operation message -->

                            <div class="col-md-12">
                                <!-- View -->
                                
                                <?php
                                if ($_SESSION['userType'] == $strings['secretary'])
                                {
                                    generateSecretaryStatistics($this->data);

                                } elseif ($_SESSION['userType'] == $strings['coach']) {

                                    //echo '<div id="piechart2" style="width: 50%; height: 50%;"></div>';
                                    generateCoachStatistics($this->data);

                                }
                                ?>
                                <!-- End of the view -->
                            </div>
                            <div class="col-md-12">
                                <?php
                                if ($_SESSION['userType'] == $strings['coach']) {

                                    // Display button
                                    echo '<div id="showSportsmen" style="text-align: center; margin-top: 1%">
                                                <button class="btn btn-lg btn-default">' . $strings['showSportsmen'] . '</button>
                                          </div>';

                                    $titles = array('imagen', 'login', 'nombre', 'apellidos',  'dni');
                                    generateViewStatisticsCoach($this->list, 'tracing', $titles);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of the body -->

            <!-- Footer -->
            <?php include  '../views/footer.php'; ?>
            <!-- End of the footer -->
        </body>
    </html>
<?php
    }
}
?>



