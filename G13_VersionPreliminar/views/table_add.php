<!-- Table add view -->

<?php
class TableAdd
{
    function __construct()
    {
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

                        <!-- Table form -->
                        <div class="col-md-12">
                            <h1 id="headname"> <?php echo $strings['New table']; ?> </h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action='../controllers/table_controller.php' method='post'>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="nombre"> <?php echo $strings['nombre']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder=" <?php echo $strings['nombre']; ?> " maxlength="60" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo" class="col-md-2 control-label"> <?php echo $strings['tipo']; ?> </label>
                                        <div class="col-md-10">
                                            <select class="selectpicker form-control" name="tipo" id="tipo">
                                                <option value="<?php echo $strings['normal']; ?>"> <?php echo $strings['normal']; ?> </option>
                                                <option value="<?php echo $strings['personal']; ?>"> <?php echo $strings['personal']; ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Insert']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <a href="../controllers/table_controller.php" class="btn btn-md btn-danger"> <?php echo $strings['Cancel']; ?> </a>
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
                        <!-- End of the form -->
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