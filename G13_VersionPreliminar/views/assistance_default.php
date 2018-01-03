<!-- Assistance default view -->

<?php
class AssistanceDefault
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
        <title> <?php echo $strings['Assistance']; ?> </title>

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
                                generateOrderAndSearch($listOrder, 'assistance');
                            ?>
                        </div>
                        <!-- End of the squares -->
                        <?php showMessage($this->message); ?>
                        <div class="row">

                            <!-- End of the operation message -->

                            <div class="col-md-12">
                                <!-- List -->
                                <?php
                                $titles = array('nombre');

                                for ($i = 0; $i < count($this->data); $i++)
                                {
                                    echo '<a href="../controllers/' . 'assistance' . '_controller.php?id=' . $this->data[$i]['id'] . '&action=' . $strings['See'] . '" class="list-group-item">';
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



