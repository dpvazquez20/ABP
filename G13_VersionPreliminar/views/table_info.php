<!-- Table info view -->

<?php
class TableInfo
{
    private $data; // Table data
    private $lines; // Line's list
    private $message;

    function __construct($data, $lines, $message, $idTabla)
    {
        $this->data = $data;
        $this->lines = $lines;
        $this->message = $message;
        $this->idTabla = $idTabla;
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
        <title> <?php echo $strings['Info table']; ?> </title>

        <body>
        <!-- Main body of the page -->
        <div id="body-container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Menu -->
                    <?php generateNavbar($_SESSION['userType']); ?>
                    <!-- End of the menu -->

                    <div class="row">
                        <!-- Operation message -->
                        <?php showMessage($this->message); ?>
                        <!-- End of the operation message -->

                        <div class="col-md-12">
                            <!-- Table view -->
                            <?php
                            $titles = array('nombre','tipo');
                            generateView($this->data, 'table', $titles);
                            ?>
                            <!-- End of the view -->

                            <!-- Insert button -->
                            <div class="col-md-12" id="new">
                                <a href='table_line_controller.php?idTabla=<?php getIdTabla($this->data); ?>&action=<?php echo $strings['Insert']; ?>' class="btn btn-md btn-warning" id="newButton"> <?php echo $strings['Add exercise']; ?> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>
                            </div>
                            <!-- End of the insert button -->

                            <!-- List -->
                            <?php
                            $titles = array('imagen', 'ejercicio', 'series', 'repeticiones', 'duracion', 'descanso');
                            generateListInfo ($this->lines, 'table_line', $titles, $this->idTabla);
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



