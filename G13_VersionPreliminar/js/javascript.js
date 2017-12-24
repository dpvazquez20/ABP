//FUNCTIONS

$(document).ready( function() { 

    // Form to recover the account
    $("#forget").click( function() {                
		$("#login").delay(500).fadeIn("slow");
    });

    // Form for showing the profile modification form */
    $("#modifyEP").click( function() {
        $("#profileForm").delay(500).fadeIn("slow");
    });

    // Form to hide the profile modification form */
    $("#cancelEP").click( function() {
        $("#profileForm").delay(500).fadeOut("slow");
    });

    // Custom alerts
    window.alert = function (message) {
        alertify.alert('¡ATENCION!', message,
            function()
            {
                //alertify.success('Ok');
            });
    };

});


// Function to allow or not the removal of something
function delete_elem(page_name, id)
{
    var redirect = '../controllers/' + page_name + '_controller.php?id=' + id + '&action=Eliminar';

    // Using the default confirm
    /*var result = window.confirm('¿Está seguro?');
    if (result)
    {
		window.open(redirect, "_self");
    }
    else
    {
		// Do nothing
    }*/

    // Using alertify
    alertify.confirm('¡ADVERTENCIA!', '¿Está seguro de realizar la eliminación?',
        function()
        {
            window.open(redirect, "_self");
        },
        function()
        {
            // Do nothing
        }
    );
}


// Function to allow or not the removal of something in the table management
function delete_elem2(page_name, id, idTabla)
{
    var redirect = '../controllers/' + page_name + '_controller.php?id=' + id + '&idTabla=' + idTabla + '&action=Eliminar';

    // Using alertify
    alertify.confirm('¡ADVERTENCIA!', '¿Está seguro de realizar la eliminación?',
        function()
        {
            window.open(redirect, "_self");
        },
        function()
        {
            // Do nothing
        }
    );
}


// Function for ending the adding of table lines
function end_elem(idTabla)
{
    var redirect = '../controllers/table_line_controller.php?idTabla=' + idTabla + '&action=Ver';

    alertify.confirm('!ADVERTENCIA!', '¿Está seguro de que desea terminar?',
        function()
        {
            window.open(redirect, "_self");
        },
        function()
        {
            // Do nothing
        }
    );
}


// Function for ending the adding of tables
function end_elem2(entrenamiento_id)
{
    var redirect = '../controllers/training_controller.php?entrenamiento_id=' + entrenamiento_id + '&action=Ver';
    
    // Using alertify
    alertify.confirm('!ADVERTENCIA!', '¿Está seguro de que desea terminar?',
        function()
        {
            window.open(redirect, "_self");
        },
        function()
        {
            // Do nothing
        }
    );
}

