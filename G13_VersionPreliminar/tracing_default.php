<!-- Tracing's default view -->

<?php
class TracingDefault
{
    private $data;
    private $message;

    function __construct($data, $message)
    {
        $this->data = $data;
        $this->message = $message;
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
        <title> <?php echo $strings['Tracing']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Order and search squares -->
                        <div class="row" id="order_search">
                            <?php
                                $listOrder = array('Name A-Z', 'Name Z-A', 'Surnames A-Z', 'Surnames Z-A');
                                generateOrderAndSearch($listOrder, 'tracing');
                            ?>
                        </div>
                        <!-- End of the squares -->

                        <div class="row">
                            <!-- Insert button 
                            <div class="col-md-12" id="new">
                                <a href='tracing_controller.php?action=<?php echo $strings['Insert']; ?>' class="btn btn-md btn-warning" id="newButton">  <?php echo $strings['New']; ?> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>
                            </div>
                            End of the insert button -->

                            <!-- Operation message -->
                            <?php showMessage($this->message); ?>
                            <!-- End of the operation message -->

                            <div class="col-md-12">
                                <!-- List -->
                                <?php
                                    $titles = array('imagen', 'apellidos', 'nombre', 'sexo','dni');

                                    if ($_SESSION['userType'] == $strings['coach'])
                                    {
                                        generateListCoach2($this->data, 'tracing', $titles);
                                    } else {

                                        generateViewTracingSportsman ($this->data, 'tracing', $titles,'action');
                                    }
                                ?>
                                <!-- End of the list -->
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



