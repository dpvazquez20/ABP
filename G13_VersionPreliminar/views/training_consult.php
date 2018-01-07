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
                            $titles = array('nombre', 'sesiones','tipo');
                            generateView($this->data, 'training', $titles);
                        ?>
                        <!-- End of the view -->
						
						<!-- Insert button -->
                            <div class="col-md-12" id="new">
                                <a href='training_table_controller.php?entrenamiento_id=<?php getIdEntrenamiento($this->data); ?>&action=<?php echo $strings['Add']; ?>' class="btn btn-md btn-warning" id="newButton"> <?php echo $strings['Add table']; ?> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>
                            </div>
							<br>
							<br>
							<br>
                        <!-- End of the insert button -->
						
						<!-- List -->
                        <?php
							$titles = array('tabla', 'orden_sesion');
							echo '<br><br><br><br>';
							generateListTrainingTables($this->tables, 'table', $titles, $this->data);
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