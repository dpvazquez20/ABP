<!-- User's consult view -->

<?php
class TrainingConsult
{
    private $data;

    function __construct($data, $tables)
    {
        $this->data = $data;
		$this->tables = $tables;
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
        <title> <?php echo $strings['Consult training']; ?> </title>

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
                            $titles = array('nombre', 'sesiones');
                            generateView($this->data, 'training', $titles);
                        ?>
                        <!-- End of the view -->
						
						<!-- List -->
                        <?php
							$titles = array('tabla', 'orden_sesion');
							echo '<br><br><br><br>';
							generateListTrainingTables($this->tables, 'table', $titles);
                        ?>
                        <!-- End of the list -->
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