<!-- Table line modify view -->

<?php
class TableLineModify
{
    private $data; // Table line data
    private $exerciseList; // Exercise list

    function __construct($data, $exerciseList)
    {
        $this->data = $data;
        $this->exerciseList = $exerciseList;
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
        <title> <?php echo $strings['Modify table line']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Table line form -->
                        <div class="col-md-12">
                            <h1 id="headname"> <?php echo $strings['Modify table line']; ?> </h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action='../controllers/table_line_controller.php?id=<?php echo $this->data[0]['id']; ?>&idTabla=<?php echo $this->data[0]['tabla_id']; ?>' method='post'>
                                    <?php generateSelect3 ($this->exerciseList, 'nombre',$strings['Exercise'],$this->data[0]['ejercicio_id']); ?>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="series"> <?php echo $strings['series']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" name="series" id="series" placeholder=" <?php echo $this->data[0]['series']; ?> " min="0" max="100">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="repeticiones"> <?php echo $strings['repeticiones']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="repeticiones" id="repeticiones" placeholder=" <?php echo $this->data[0]['repeticiones']; ?> " maxlength="45">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="duracion"> <?php echo $strings['duracion']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="duracion" id="duracion" placeholder=" <?php echo $this->data[0]['duracion']; ?> " maxlength="45">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="descanso"> <?php echo $strings['descanso']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="descanso" id="descanso" placeholder=" <?php echo $this->data[0]['descanso']; ?> " maxlength="45">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Modify']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <a href="../controllers/table_line_controller.php?idTabla=<?php echo $this->data[0]['tabla_id']; ?>.php" class="btn btn-md btn-danger"> <?php echo $strings['Cancel']; ?> </a>
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