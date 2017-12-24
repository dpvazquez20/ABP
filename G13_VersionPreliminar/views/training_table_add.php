<!-- Table line add view -->

<?php
class TrainingTableAdd
{
    private $listTables; // Tables list
    private $training_id;
	
    function __construct($listTables,$training_id)
    {
        $this->listTables = $listTables;
        $this->training_id = $training_id;
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
        <title> <?php echo $strings['New table']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Table insert form -->
                        <div class="col-md-12">
                            <h1 id="headname"> <?php echo $strings['New table']; ?> </h1>
                        </div>
                        <!-- End of the form -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action="../controllers/training_table_controller.php?entrenamiento_id=<?php echo $this->training_id; ?>" method='post' id="addTable">
                                    <?php generateSelect2 ($this->listTables, 'nombre','tabla_id'); ?>

                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <input type="hidden" class="form-control" name="orden_sesion" id="orden_sesion" value="1" placeholder=" <?php echo $strings['orden_sesion']; ?> " min="0" max="100">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Insert']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <!-- <button id ="cancelNL" class="btn btn-md btn-danger"> <?php //echo $strings['Cancel']; ?> </button>-->
                                            <button type="reset" class="btn btn-md btn-default"> <?php echo $strings['Reset']; ?> </button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <p id="mandatory">  <?php echo $strings['Mandatory']; ?>  </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- End button -->
                        <div class="col-md-12" id="addEditButtons">
                            <button class='btn btn-lg btn-danger' onclick="end_elem2(<?php echo $this->training_id; ?>)"> <?php echo $strings['End'] ?></button>
                        </div>
                        <!-- End of the end button -->
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