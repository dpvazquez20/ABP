<!-- User's consult view -->

<?php
class TracingConsult
{
    private $data;

    function __construct($data1,$data2,$locked)
    {
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->locked = $locked;
        $this->render();
    }

    function render()
    {
?>
    <html lang="es">
        <?php
            include '../views/head.php';
            include '../languages/spanish.php';
            include '../functions/functions.php';
        ?>
        <title> <?php echo $strings['Consult user']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- User view -->

                    <?php
                    if ($_SESSION['userType'] <> $strings['coach'])
                    {
                    ?>
                        <div class="col-md-12" id="new">
                            <a href='tracing_controller.php?sesionId=<?php echo $this->data1[0]['sesionId']; ?>&action=<?php echo $strings['previousTable']; ?>' class="btn btn-md btn-primary" id="newButton"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> <?php echo $strings['previous']; ?>  </a>
                            <a href='tracing_controller.php?sesionId=<?php echo $this->data1[0]['sesionId']; ?>&action=<?php echo $strings['nextTable']; ?>' class="btn btn-md btn-primary" id="newButton"> <?php echo $strings['next']; ?> <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> </a>
                        </div>
                    <?php
                    }
                    ?>

                        <?php
                            $titles = array('imagen', 'nombre', 'series', 'repeticiones', 'duracion', 'descanso','comentario','completado');

                            if ($_SESSION['userType'] == $strings['coach'])
                            {
                                generateViewTracingTitle($this->data1,true);
                            }else{
                                generateViewTracingTitle($this->data1,false);
                            }

                            if($this->locked)
                            {
                                generateViewTracingCoach2($this->data2, 'tracing', $titles);
                            }else{
                                generateViewTracingSportsman2($this->data2, 'tracing', $titles,$strings['completeLine']);
                                       
                        ?>

                        <div class="col-md-12" id="new">
                            <a href='tracing_controller.php?sesionId=<?php echo $this->data1[0]['sesionId']; ?>&action=<?php echo $strings['completeTable']; ?>' class="btn btn-md btn-warning" id="newButton"> <?php echo $strings['toComplete']; ?> <span class="glyphicon glyphicon glyphicon-send" aria-hidden="true"></span> </a>
                        </div>

                        <?php
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