<!-- Exercise modify view -->

<?php
class ExerciseModify
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
        <title> <?php echo $strings['Modify exercise']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Exercise form -->
                        <div class="col-md-12">
                            <h1 id="headname"> <?php echo $strings['Modify exercise']; ?> </h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form enctype="multipart/form-data" class="form-horizontal" action='../controllers/exercise_controller.php?id=<?php echo $this->data[0]['id']; ?>' method='post'>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="nombre"> <?php echo $strings['nombre']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder=" <?php echo $this->data[0]['nombre']; ?> " maxlength="60">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="descripcion"> <?php echo $strings['descripcion']; ?> </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="descripcion" id="descripcion" placeholder=" <?php echo $this->data[0]['descripcion']; ?> "></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="imagen"> <?php echo $strings['imagen']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" title=" <?php echo $this->data[0]['imagen']; ?> ">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo" class="col-md-2 control-label"> <?php echo $strings['tipo']; ?> </label>
                                        <div class="col-md-10">
                                            <select class="selectpicker form-control" name="tipo" id="tipo">
                                                <option value=""> <?php echo $this->data[0]['tipo']; ?> </option>
                                                <option value="<?php echo $strings['muscular']; ?>"> <?php echo $strings['muscular']; ?> </option>
                                                <option value="<?php echo $strings['stretching']; ?>"> <?php echo $strings['stretching']; ?> </option>
                                                <option value="<?php echo $strings['cardio']; ?>"> <?php echo $strings['cardio']; ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Modify']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <a href="../controllers/exercise_controller.php" class="btn btn-md btn-danger"> <?php echo $strings['Cancel']; ?> </a>
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