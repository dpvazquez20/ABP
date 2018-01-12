<!-- Event add view -->

<?php
class EventAdd
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
        <title> <?php echo $strings['New event']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Event form -->
                        <div class="col-md-12">
                            <h1 id="headname"> <?php echo $strings['New event']; ?> </h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form enctype="multipart/form-data" class="form-horizontal" action='../controllers/event_controller.php' method='post'>
                                    
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
                                        <label class="control-label col-md-2" for="imagen"> <?php echo $strings['imagen']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" placeholder=" <?php echo $strings['Nothing selected']; ?> ">
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label class="control-label col-md-2" for="horaInicio"> <?php echo $strings['horaInicio']; ?>* </label>
                                        <div class="col-md-2">
                                            <input type="time" class="form-control" name="horaInicio" id="horaInicio" placeholder=" <?php echo $strings['Enter start time']; ?> " onchange="checkActivityTimes(this)" required disabled>
                                        </div>

                                        <label class="control-label col-md-2" for="horaFin"> <?php echo $strings['horaFin']; ?>* </label>
                                        <div class="col-md-2">
                                            <input type="time" class="form-control" name="horaFin" id="horaFin" placeholder=" <?php echo $strings['Enter end time']; ?> " onchange="checkActivityTimes(this)" required disabled>
                                        </div>
                                    </div>
									
	                                <div class="form-group">
                                        <label class="control-label col-md-2" for="fechaInicio"> <?php echo $strings['fechaInicio']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="checkActivityDates(this)" required disabled>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label class="control-label col-md-2" for="fechaFin"> <?php echo $strings['fechaFin']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" onchange="checkActivityDates(this)" required disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Insert']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <a href="../controllers/event_controller.php" class="btn btn-md btn-danger"> <?php echo $strings['Cancel']; ?> </a>
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