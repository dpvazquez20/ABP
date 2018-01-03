<!-- Inscription consult view -->

<?php
class InscriptionConsult
{
    private $data;

    function __construct($data1,$data2,$id_usu,$reply)
    {
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->id_usu = $id_usu;
        $this->message = $reply;
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
        <title> <?php echo $strings['Consult inscription']; ?> </title>

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
                            ?>
                           <div class="col-md-5 col-md-offset-1">
                               <form class="form-horizontal" action="inscription_controller.php?id_u=<?php echo $this->id_usu . '&action=' . $strings['Order'] ?>" method="post">
                                   <div class="form-group">
                                       <label for="order" class="col-md-2 control-label"><?php echo  $strings['Order'] ?></label>
                                       <div class="col-md-10">
                                           <select class="selectpicker form-control" name="orderfield" id="order" onchange="this.form.submit()">
                                                <option data-hidden="true"><?php echo $strings['Nothing selected'] ?></option>
                                                <?php
                                                $cont = 1;
                                                for ($i = 0; $i < count($listOrder); $i++)
                                                {
                                                echo '<option value="' . $cont . '">' . $strings[$listOrder[$i]] . '</option>';
                                                $cont++;
                                                }
                                                ?>
                                           </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                           <div class="col-md-5 col-md-offset-1">
                                   <form class="form-inline" action="inscription_controller.php?id_u=<?php echo $this->id_usu . '&action=' . $strings['Search'] ?>" method="post">
                                          <div class="form-group">
                                                   <input type="text" class="form-control" name="searchfield" placeholder="<?php echo $strings['Search'] ?>">
                                              </div>
                                          <button type="submit" name="action" value=<?php echo $strings['Search'] ?> id="search" class="btn btn-md btn-default"> <span class="glyphicon glyphicon-search" aria-hidden="true" id="searchButton"></span> </button>
                                       </form>
                            </div>
                        </div>

                        <?php showMessage($this->message); ?>

                        <!-- End of the squares -->

                        <div class="col-md-12" id="def">
                            <label class="control-label col-md-8"> <?php echo $strings['registeredActivities']; ?> </label>

                            <?php
                            $titles= array('nombre','frecuencia','horaInicio');
                            generateInscriptionList($this->data1,'inscription',$titles,false,$strings['Delete'],$strings['Delete']);
                            ?>
                        </div>


                        <div class="col-md-12" id="def">
                            <label class="control-label col-md-8"> <?php echo $strings['nonRegisteredActivities']; ?> </label>

                            <?php
                            $titles= array('nombre','frecuencia','horaInicio');
                            generateInscriptionList($this->data2,'inscription',$titles,true,$strings['Insert'],$strings['Insert']);
                            ?>
                        </div>

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
