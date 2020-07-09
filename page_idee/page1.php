<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";
?>




<body>
    <button onclick="remplirFormSuppr('ADAM antonin','antonin.adam@example.com','58128d270bd1d');"
        class="btn btn-danger" data-toggle="modal" data-target="#deleteUser">
        <span class="glyphicon glyphicon-remove"></span>
    </button>



    <script type="text/javascript">
    function remplirFormSuppr(name, mail, id) {
        var id = id;
        $(".modal-body").html("Voulez vous vraiment supprimer l'utilisateur <b>" + name + "</b> ayant pour Email <b>" +
            mail + "</b> ?");
    }

    var id;
    </script>

</body>




<!-- Modal -->
<div class="modal fade" id="newPatient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<?php
require "../footer/footer.php";
require "../footer/modal.php";
?>