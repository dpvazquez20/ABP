<!-- Table modify view -->

<?php
class TableModify
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
        <title> <?php echo $strings['Modify table']; ?> </title>

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
                            <h1 id="headname"> <?php echo $strings['Modify table']; ?> </h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action='../controllers/table_controller.php?id=<?php echo $this->data[0]['id']; ?>' method='post'>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="nombre"> <?php echo $strings['nombre']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder=" <?php echo $this->data[0]['nombre']; ?> " maxlength="60">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo" class="col-md-2 control-label"> <?php echo $strings['tipo']; ?> </label>
                                        <div class="col-md-10">
                                            <select class="selectpicker form-control" name="tipo" id="tipo">
                                                <option value=""> <?php echo $this->data[0]['tipo']; ?> </option>
                                                <option value="<?php echo $strings['normal']; ?>"> <?php echo $strings['normal']; ?> </option>
                                                <option value="<?php echo $strings['personal']; ?>"> <?php echo $strings['personal']; ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Modify']; ?>"> <?php echo $strings['Accept']; ?> </button>
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

                        <!-- Insert button -->
                        <!--<div class="col-md-12 col-md-offset-5" id="new">
                            <a href='table_line_controller.php?action=<?php echo $strings['Insert']; ?>&idTabla=<?php echo $_REQUEST['id']; ?>' class="btn btn-md btn-warning" id="newButton"> <?php echo $strings['Add exercise']; ?> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>
                        </div> -->
                        <!-- End of the insert button -->

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