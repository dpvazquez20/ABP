<!-- Activity consult view -->

<?php
class ActivityConsult
{
    private $data;

    function __construct($data,$data2,$data3)
    {
        $this->data = $data;
        $this->data2 = $data2;
        $this->data3 = $data3;
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
        <title> <?php echo $strings['Consult activity']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Activity view -->
                        <br>
                        <h2 id="headname"><?php  echo $strings['Consult activity'] ?> </h2>

                        <div class="col-md-10 col-md-offset-3">
                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="nombre"> <?php echo $strings['nombre']; ?>: </label>
                                <p class="col-md-9" for="nombre"> <?php echo $this->data[0]["nombre"]; ?> </p>
                            </div>

                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="descripcion"> <?php echo $strings['descripcion']; ?>: </label>
                                <p class="control-label col-md-9" for="descripicion"> <?php echo $this->data[0]["descripcion"]; ?> </p>
                            </div>

                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="resource"> <?php echo $strings['resource']; ?>: </label>
                                <p class="normal-label col-md-9" for="resource"> <?php echo $this->data2[0]["nombre"]; ?> </p>
                            </div>

                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="act_coach"> <?php echo $strings['act_coach']; ?>: </label>
                                <p class="control-label col-md-9" for="act_coach"> <?php echo $this->data3[0]["nombre"]; ?> </p>
                            </div>

                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="frecuencia"> <?php echo $strings['frecuencia']; ?>: </label>
                                <p class="control-label col-md-9" for="frecuencia"> <?php echo $this->data[0]["frecuencia"]; ?> </p>
                            </div>

                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="horaInicio"> <?php echo $strings['horaInicio']; ?>: </label>
                                <p class="control-label col-md-3" for="horaInicio"> <?php echo $this->data[0]["horaInicio"]; ?> </p>

                                <label class="control-label col-md-3" for="horaFin"> <?php echo $strings['horaFin']; ?>: </label>
                                <p class="control-label col-md-3" for="horaFin"> <?php echo $this->data[0]["horaFin"]; ?> </p>
                            </div>

                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="fechaInicio"> <?php echo $strings['fechaInicio']; ?>: </label>
                                <p class="control-label col-md-3" for="fechaInicio"> <?php echo $this->data[0]["fechaInicio"]; ?> </p>

                                <label class="control-label col-md-3" for="fechaFin"> <?php echo $strings['fechaFin']; ?>: </label>
                                <p class="control-label col-md-3" for="fechaFin"> <?php echo $this->data[0]["fechaFin"]; ?> </p>
                            </div>

                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="tipo"> <?php echo $strings['tipo']; ?>: </label>
                                <p class="control-label col-md-9" for="tipo"> <?php echo $this->data[0]["tipo"]; ?> </p>
                            </div>

                            <div class="col-md-8">
                                <label class="control-label col-md-3" for="numMaxParticipantes"> <?php echo $strings['numMaxParticipantes']; ?>: </label>
                                <p class="control-label col-md-9" for="numMaxParticipantes"> <?php echo $this->data[0]["numMaxParticipantes"]; ?> </p>
                            </div>
                        </div>
                        </div>

                        <!-- End of the view -->
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