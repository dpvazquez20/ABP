<!-- Profile default view -->

<?php
class ProfileDefault
{
    private $data;
    private $message;

    function __construct($data, $message)
    {
        $this->data = $data;
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
        <title> <?php echo $strings['Profile']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Operation message -->
                        <?php showMessage($this->message); ?>
                        <!-- End of the operation message -->

                        <!-- Profile view -->
                        <?php
                        if($_SESSION['userType'] == $strings['sportsman'])
                        {
                            $titles = array('imagen', 'login', 'nombre', 'apellidos', 'sexo', 'dni', 'email', 'tipo', 'clase', 'entrenador_nombre');
                        }else{
                            $titles = array('imagen', 'login', 'nombre', 'apellidos', 'sexo', 'dni', 'email', 'tipo', 'clase');
                        }
                        generateProfile($this->data, $titles);
                        ?>
                        <!-- End of the view -->

                        <!-- Profile form -->
                        <div class="row">
                            <div class="col-md-5 col-md-offset-3">
                                <form enctype="multipart/form-data" class="form-horizontal" id="profileForm" action="../controllers/profile_controller.php?id=<?php echo $_SESSION['userId']; ?>" method='post'>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="log"> <?php echo $strings['login']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="login" id="log" placeholder=" <?php echo $this->data[0]['login']; ?> ">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="contrasenha"> <?php echo $strings['contrasenha']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="contrasenha" id="contrasenha" placeholder="<?php echo $strings['Enter a password']; ?> ">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="rcontrasenha"> <?php echo $strings['contrasenha']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="rcontrasenha" id="rcontrasenha" placeholder=" <?php echo $strings['Repeat password']; ?> " onchange="validarPassword()">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="nombre"> <?php echo $strings['nombre']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder=" <?php echo $this->data[0]['nombre']; ?> " onchange="validarAlfabetico(this),mostrarOpcion()">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="apellidos"> <?php echo $strings['apellidos']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder=" <?php echo $this->data[0]['apellidos']; ?> " onchange="validarAlfabetico(this)">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo" class="col-md-2 control-label"> <?php echo $strings['sexo']; ?>* </label>
                                        <div class="col-md-10">
                                            <select class="selectpicker form-control" name="sexo" id="sexo" required>
                                                <option value="" selected> <?php echo $this->data[0]['sexo']; ?> </option>
                                                <option value="<?php echo $strings['man']; ?>"> <?php echo $strings['man']; ?> </option>
                                                <option value="<?php echo $strings['woman']; ?>"> <?php echo $strings['woman']; ?> </option>
                                                <option value="<?php echo $strings['other']; ?>"> <?php echo $strings['other']; ?> </option>
                                            </select>
                                        </div>
                                    </div>
									
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="email"> <?php echo $strings['email']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control" name="email" id="email" placeholder=" <?php echo $this->data[0]['email']; ?> " onchange="validarEmail(this)">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="dni"> <?php echo $strings['dni']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="dni" id="dni" placeholder=" <?php echo $this->data[0]['dni']; ?> " onchange="validarDni(this)">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="imagen"> <?php echo $strings['imagen']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" placeholder=" <?php echo $strings['Nothing selected']; ?> ">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Modify']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <a type="reset" class="btn btn-md btn-danger" id="cancelEP"> <?php echo $strings['Cancel']; ?> </a>
                                            <button type="reset" class="btn btn-md btn-default"> <?php echo $strings['Reset']; ?> </button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10 col-md-offset-2">
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