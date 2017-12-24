<!-- Table line add view -->

<?php
class TableLineAdd
{
    //private $data; // Table data (we use the id int the End button for return to the table_consult view
    private $exerciseList; // Exercise list
    private $tableId;

   /*function __construct($data, $exerciseList)
    {
        $this->data = $data;
        $this->exerciseList = $exerciseList;
        $this->render();
    }*/
    function __construct($exerciseList,$tableId,$message)
    {
        $this->exerciseList = $exerciseList;
        $this->tableId = $tableId;
        $this->message = $message;
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
        <title> <?php echo $strings['New table line']; ?> </title>

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
                            <h1 id="headname"> <?php echo $strings['New exercise']; ?> </h1>
                        </div>
                        <!-- End of the form -->

                        <!-- Operation message -->
                        <?php showMessage($this->message); ?>
                        <!-- End of the operation message -->

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action="../controllers/table_line_controller.php?idTabla=<?php echo $this->tableId; ?>" method='post' id="addLine">
                                    <?php generateSelect2 ($this->exerciseList, 'nombre',$strings['Exercise']); ?>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="series"> <?php echo $strings['series']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" name="series" id="series" placeholder=" <?php echo $strings['series']; ?> " min="0" max="100">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="repeticiones"> <?php echo $strings['repeticiones']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="repeticiones" id="repeticiones" placeholder=" <?php echo $strings['repeticiones']; ?> " maxlength="45">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="duracion"> <?php echo $strings['duracion']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="duracion" id="duracion" placeholder=" <?php echo $strings['duracion']; ?> " maxlength="45">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="descanso"> <?php echo $strings['descanso']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="descanso" id="descanso" placeholder=" <?php echo $strings['descanso']; ?> " maxlength="45">
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
                        <!-- End of the form -->

                        <!-- End button -->
                        <div class="col-md-12" id="addEditButtons">
                            <button class='btn btn-lg btn-danger' onclick="end_elem(<?php echo $this->tableId; ?>)"> <?php echo $strings['End'] ?></button>
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