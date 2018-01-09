<!-- Table add view -->

<?php
class NotificationAdd
{
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
        <title> <?php echo $strings['Notification']; ?> </title>

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
                            <h1 id="headname"> <?php echo $strings['Notification']; ?> </h1>
                        </div>

                        <div class="row">

                            <?php showMessage($this->message); ?>

                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" action='../controllers/notification_controller.php' method='post'>

                                <?php
                                if($_SESSION['userType'] <> $strings['coach'])
                                {
                                ?>

                                    <div class="form-group">
                                        <label for="destino" class="col-md-2 control-label"> <?php echo $strings['Addressees']; ?>* </label>
                                        <div class="col-md-10">
                                            <select class="selectpicker form-control" name="destino" id="destino" required>
                                                <option value="<?php echo $strings['sportsman']; ?>"> <?php echo $strings['sportsmans']; ?> </option>
                                                <option value="<?php echo $strings['coach']; ?>"> <?php echo $strings['coachs']; ?> </option>
                                                <option value="<?php echo $strings['secretary']; ?>"> <?php echo $strings['secretarys']; ?> </option>
                                                <option value="<?php echo $strings['admin']; ?>"> <?php echo $strings['admins']; ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="sujeto"> <?php echo $strings['Subject']; ?>* </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="sujeto" id="sujeto" placeholder=" <?php echo $strings['Subject']; ?> " maxlength="60" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12" id="new">
                                            <label class="control-label col-md-2" for="mensaje"> <?php echo $strings['Message']; ?>* </label>
                                            <textarea name="mensaje" style="width:83%;" rows="10" placeholder=" <?php echo $strings['Message']; ?> " required><?php /*echo $strings['Message'];*/ ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8" id="addEditButtons">
                                            <button type="submit" class="btn btn-md btn-success" name="action" value="<?php echo $strings['Send']; ?>"> <?php echo $strings['Send']; ?> </button>
                                            <a href="../controllers/notification_controller.php" class="btn btn-md btn-danger"> <?php echo $strings['Cancel']; ?> </a>
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