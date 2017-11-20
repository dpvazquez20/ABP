<!-- Inscription default view -->

<?php
class InscriptionDefault
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
        <title> <?php echo $strings['Inscription']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Order and search squares -->
                        <div class="row" id="order_search">
                            <?php
                                $listOrder = array('Name A-Z', 'Name Z-A');
                                generateOrderAndSearch($listOrder, 'inscription');
                            ?>

                        </div>
                        <!-- End of the squares -->

                        <div class="row">
                            <!-- Operation message -->
                            <?php showMessage($this->message); ?>

                            <!-- End of the operation message -->


                            <div id ="def" class="col-md-12">
                                <label class="control-label col-md-8"> <?php echo $strings['registeredSportsmen']; ?> </label>
                            </div>
                            <div class="col-md-12">
                                <!-- List -->

                                <?php
                                    $titles = array('nombre', 'apellidos');

                                    //generateListGroup ($this->data, 'inscription', $titles,false, $strings['See'],$strings['See']);
                                    for ($i = 0; $i < count($this->data); $i++)
                                    {
                                        echo '<a href="../controllers/' . 'inscription' . '_controller.php?id=' . $this->data[$i]['id'] . '&action=' . $strings['See'] . '" class="list-group-item">';
                                        $text = '';

                                        for ($j = 0; $j < count($titles); $j++)
                                        {
                                            $text = $text . ' ' .  $this->data[$i]["$titles[$j]"];
                                        }

                                        echo    '<strong>'. $text . '</strong>';
                                        echo '</a>';
                                    }
                                ?>
                                <!-- End of the list -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of the body -->

            <!-- Footer -->
            <?php include  '../views/footer.php'; ?>
            <!-- End of the footer -->
        </body>
    </html>
<?php
    }
}
?>



