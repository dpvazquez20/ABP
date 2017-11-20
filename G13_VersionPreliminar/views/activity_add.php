
<!-- Activity add view -->

<?php
class ActivityAdd
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
        <title> <?php echo $strings['New activity']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Activity form -->
                        <div class="col-md-12">
                            <h1 id="headname"> <?php echo $strings['New activity']; ?> </h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action='../controllers/activity_controller.php' onsubmit="return checkMaxParticipants() && checkActivityTimes() " method='post'>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="nombre"> <?php echo $strings['nombre']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder=" <?php echo $strings['Enter a name']; ?> "  maxlength="60" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="descripcion"> <?php echo $strings['descripcion']; ?> </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="descripcion" id="descripcion" placeholder=" <?php echo $strings['Enter a description']; ?> "></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="frecuencia"> <?php echo $strings['frecuencia']; ?>* </label>
                                        <div class="col-md-10">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="frecuencia[]" id="frecuencia" value="<?php echo $strings['monday']; ?>"> <?php echo $strings['monday']; ?>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="frecuencia[]" id="frecuencia" value="<?php echo $strings['tuesday']; ?>"> <?php echo $strings['tuesday']; ?>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="frecuencia[]" id="frecuencia" value="<?php echo $strings['wednesday']; ?>"> <?php echo $strings['wednesday']; ?>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="frecuencia[]" id="frecuencia" value="<?php echo $strings['thursday']; ?>"> <?php echo $strings['thursday']; ?>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="frecuencia[]" id="frecuencia" value="<?php echo $strings['friday']; ?>"> <?php echo $strings['friday']; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="horaInicio"> <?php echo $strings['horaInicio']; ?>* </label>
                                        <div class="col-md-2">
                                            <input type="time" class="form-control" name="horaInicio" id="horaInicio" placeholder=" <?php echo $strings['Enter start time']; ?> " onchange="checkActivityTimes(this)" required>
                                        </div>

                                        <label class="control-label col-md-2" for="horaFin"> <?php echo $strings['horaFin']; ?>* </label>
                                        <div class="col-md-2">
                                            <input type="time" class="form-control" name="horaFin" id="horaFin" placeholder=" <?php echo $strings['Enter end time']; ?> " onchange="checkActivityTimes(this)" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo" class="col-md-2 control-label"> <?php echo $strings['tipo']; ?>* </label>
                                        <div class="col-md-10">
                                            <select class="selectpicker form-control" name="tipo" id="tipo" required>
                                                <option data-hidden="true"> <?php echo $strings['Nothing selected']; ?> </option>
                                                <option value="<?php echo $strings['individual']; ?>"> <?php echo $strings['individual']; ?> </option>
                                                <option value="<?php echo $strings['group']; ?>"> <?php echo $strings['group']; ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="numMaxParticipantes"> <?php echo $strings['numMaxParticipantes']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="number"  class="form-control-number" name="numMaxParticipantes" id="numMaxParticipantes" placeholder=" <?php echo $strings['Enter maximum number of participants']; ?>" onchange="checkMaxParticipants(this)">
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($_REQUEST['tipo']) == $strings['individual'] && $_REQUEST['numMaxParticipantes'] == '1')
                                    {
                                        echo  'error';
                                    }

                                    ?>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Insert']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <a href="../controllers/activity_controller.php" class="btn btn-md btn-danger"> <?php echo $strings['Cancel']; ?> </a>
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
