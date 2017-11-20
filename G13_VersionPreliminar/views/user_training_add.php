<!-- Table line add view -->

<?php
class UserTrainingAdd
{
    private $listTrainings; // Tables list
    private $user_id;
	
    function __construct($listTrainings,$user_id)
    {
        $this->listTrainings = $listTrainings;
        $this->user_id = $user_id;
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
        <title> <?php echo $strings['Assign']; ?> </title>

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
                            <h1 id="headname"> <?php echo $strings['Assign']; ?> </h1>
                        </div>
                        <!-- End of the form -->                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action="../controllers/training_controller.php?user_id=<?php echo $this->user_id; ?>" method='post' id="addTraining">
                                    <?php generateSelect2 ($this->listTrainings, 'nombre','Entrenamiento'); ?>
                                    
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['AssignTraining']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <button id ="cancelNL" class="btn btn-md btn-danger"> <?php echo $strings['Cancel']; ?> </button>
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