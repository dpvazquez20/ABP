<!-- Application login page -->

<?php
class LogIn
{
    private $message;

    function __construct($message)
    {
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
        <title> <?php echo $strings['Log In']; ?> </title>

        <body id="login-body">
             <div id="head-login" class="container">
                <div class="col-md-6 col-md-offset-4">
                    <div class="col-md-6 col-md-offset-1">
                        <h1 id="headname"> <img id="logo" src="../images/logo.png" width="250" height="80"> </h1><br>
                    </div>

                    <!-- Login -->
                    <div class="row" id="login-form">
                        <div class="col-md-6 col-md-offset-1">
                            <div class="form">
                                <form role="form" action="../functions/login_functions.php" method="post" class="login-form">
                                    <div class="form-group">
                                        <input type="text" name="login" placeholder=" <?php echo $strings['Enter an username']; ?> " class="form-username form-control" id="log" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="contrasenha" placeholder=" <?php echo $strings['Enter a password']; ?> " class="form-password form-control" id="contraseña" required>
                                    </div>
                                        <button type="submit" name="action" value="<?php echo $strings['Enter']; ?>" class="btn btn-md btn-success btn-group-justified"> <?php echo $strings['Enter']; ?> </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of the login -->

                    <!-- Operation message -->
                    <div class="col-md-8">
                        <?php showMessage($this->message); ?>
                    </div>
                    <!-- End of the operation message -->

                    <!-- Form to recover your username and password -->
                    <div class="col-md-8" id="forget-text">
                        <p> <?php echo $strings['If you have forgotten your username or password press']; ?> <a href="#" id="forget"> <?php echo $strings['Here']; ?> </a></p>
                    </div>

                    <div class="row">
                        <div id="login" class="col-md-6">
                            <form class="form-horizontal" role="form" method="post">
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-2">
                                        <input type="email" name="email" class="form-control" id="email" placeholder=" <?php echo $strings['Enter an email']; ?> " required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-6 col-md-12">
                                        <button type="submit" class="btn btn-md btn-default"> <?php echo $strings['Send']; ?> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End of the form -->
                </div>
            </div>
        </body>
    </html>
<?php
    }
}
?>