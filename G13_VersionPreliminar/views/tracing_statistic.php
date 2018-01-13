<!-- User's consult view -->

<?php
class TracingStatistic
{
    private $data;

    function __construct($data1,$data2,$idUser)
    {
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->idUser = $idUser;
        $this->render();
    }

    function render()
    {
?>
    <html lang="es">
        <?php
            include '../languages/spanish.php';
            include '../functions/functions.php';
        ?>
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
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();

      <?php 
            echo  generateStatisticsSportsman($this->data2);
        

      echo "var options = {
        chart: {
          title: '" . $strings['SportsmanProgression'] . "',
          subtitle: '" . $strings['TimesPerTable'] . "'
        },

      };"
      ?>
      var chart = new google.charts.Line(document.getElementById('linechart_material'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
    </script>
    
</head>

        <title> <?php echo $strings['Consult user']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php 
                            generateNavbar($_SESSION['userType']);
                            if($_SESSION['userType'] == $strings['coach'])
                            {
                        ?>

                                <div class="col-md-12" style="margin-bottom: 3%" id="new">
                                    <a href='statistics_controller.php' class="btn btn-md btn-warning" id="newButton"> <?php echo $strings['Back']; ?></a>
                                </div>
                                <br><br><br><br><br>
                        <?php
                            }
                        if(!is_string($this->data2)){

                        ?>
                        <!-- End of the menu -->   

                        <div id="linechart_material" style="width: 100%; height: 55%"></div>
                        
                        <?php

                        }else{
                            showMessage($this->data2);

                        }

                        ?>

                        <!-- End of the view -->
                    </div>
                </div>
            </div>
            <!-- End of the body -->

            <!-- Footer -->
            <?php include '../views/footer.php'; ?>
            <!-- End of the footer -->
        </body>
    </html>
<?php
    }
}
?>