<!-- User's add view -->

<?php
class UserAdd
{
    function __construct($coaches)
    {
        //die("die: $coaches");
        $this->coaches = $coaches;
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
        <title> <?php echo $strings['New user']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- User form -->
                        <div class="col-md-12">
                            <h1 id="headname"> <?php echo $strings['New user']; ?> </h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form enctype="multipart/form-data" class="form-horizontal" action='../controllers/user_controller.php' onsubmit="return comprobarValidaciones()" method='post'>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="log"> <?php echo $strings['login']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="login" id="log" placeholder=" <?php echo $strings['Enter an username']; ?> " required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="contrasenha"> <?php echo $strings['contrasenha']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="contrasenha" id="contrasenha" placeholder=" <?php echo $strings['Enter a password']; ?> " required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="rcontrasenha"> <?php echo $strings['contrasenha']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="rcontrasenha" id="rcontrasenha" placeholder=" <?php echo $strings['Repeat password']; ?> " onchange="validarPassword()" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="nombre"> <?php echo $strings['nombre']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder=" <?php echo $strings['Enter a name']; ?> " onchange="validarAlfabetico(this),mostrarOpcion()" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="apellidos"> <?php echo $strings['apellidos']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder=" <?php echo $strings['Enter surnames']; ?> " onchange="validarAlfabetico(this)" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="email"> <?php echo $strings['email']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control" name="email" id="email" placeholder=" <?php echo $strings['Enter an email']; ?> " onchange="validarEmail(this)" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="dni"> <?php echo $strings['dni']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="dni" id="dni" placeholder=" <?php echo $strings['Enter a dni']; ?> " onchange="validarDni(this)" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo" class="col-md-2 control-label"> <?php echo $strings['tipo']; ?>* </label>
                                        <div class="col-md-10">
                                            <select class="selectpicker form-control" name="tipo" id="tipo" required>
                                                <!-- <option data-hidden="true"> <?php echo $strings['Nothing selected']; ?> </option> -->
                                                <option value="<?php echo $strings['sportsman']; ?>"> <?php echo $strings['sportsman']; ?> </option>
                                                <option value="<?php echo $strings['admin']; ?>"> <?php echo $strings['admin']; ?> </option>
                                                <option value="<?php echo $strings['secretary']; ?>"> <?php echo $strings['secretary']; ?> </option>
                                                <option value="<?php echo $strings['coach']; ?>"> <?php echo $strings['coach']; ?> </option>
                                                <!-- <option value="<?php echo $strings['sportsman']; ?>"> <?php echo $strings['sportsman']; ?> </option> -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo" class="col-md-2 control-label"> <?php echo $strings['clase']; ?> </label>
                                        <div class="col-md-10">
                                            <select class="selectpicker form-control" name="clase" id="clase">
                                                <!-- <option data-hidden="true"> <?php echo $strings['Nothing selected']; ?> </option> -->
                                                <option value="<?php echo $strings['tdu']; ?>"> <?php echo $strings['tdu']; ?> </option>
                                                <option value="<?php echo $strings['pef']; ?>"> <?php echo $strings['pef']; ?> </option>
                                                <option value="<?php echo $strings['other']; ?>"> <?php echo $strings['other']; ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                    <?php generateSelectCoachUser($this->coaches) ?>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="imagen"> <?php echo $strings['imagen']; ?> </label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" placeholder=" <?php echo $strings['Nothing selected']; ?> ">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Insert']; ?>"> <?php echo $strings['Accept']; ?> </button>
                                            <a href="../controllers/user_controller.php" class="btn btn-md btn-danger"> <?php echo $strings['Cancel']; ?> </a>
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