<!-- Table line consult view -->

<?php
class TableLineConsult
{
    private $data;

    function __construct($data)
    {
        $this->data = $data;
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
        <title> <?php echo $strings['Consult table line']; ?> </title>

        <body>
        <!-- Main body of the page -->
        <div id="body-container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Menu -->
                    <?php generateNavbar($_SESSION['userType']); ?>
                    <!-- End of the menu -->

                    <!-- Table line view -->
                    <?php
                    $titles = array('imagen', 'nombre','series','repeticiones', 'duracion', 'descanso');
                    generateView($this->data, 'table_line', $titles);
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