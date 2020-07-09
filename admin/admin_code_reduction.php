<?php
ob_start();
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

if ($_SESSION["niv"] != 1) {
    header('Location: login.php');
}

if (isset($_POST)) {

    $Code = htmlspecialchars($_POST["Code"]);
    $id_type = htmlspecialchars($_POST["id_type"]);
    $Valeur = htmlspecialchars($_POST["Valeur"]);
    $montant_mini_achat = htmlspecialchars($_POST["montant_mini_achat"]);
    $date_de_debut = htmlspecialchars($_POST["date_de_debut"]);
    $date_de_fin = htmlspecialchars($_POST["date_de_fin"]);
    $envoyer = htmlspecialchars($_POST["envoyer"]);

    $id_promo = htmlspecialchars($_POST["id_promo"]);
    $supprimer = htmlspecialchars($_POST["supprimer"]);





    //  add code promo
    if ($envoyer) {
        $add_code_promo = add_code_promo($Code, $id_type, $Valeur, $montant_mini_achat, $date_de_debut, $date_de_fin);

        header('location:https://www.mtevent44.fr/admin/admin_code_reduction.php?message_code_promo=true');
        ob_end_flush();
        exit();
    }


    // supp code promo
    if ($supprimer) {
        delete_code_promo($id_promo);

        header('location:https://www.mtevent44.fr/admin/admin_code_reduction.php?delete_code_promo=true');
        ob_end_flush();
        exit();
    }
}

//var_dump($_POST);

// permet d'afficher les promos
$show_promo = show_promo();


//if($date_du_jour <= $date_de_debut)

$i = 1;
?>

<div class="container mt-3">

    <!-------------------------------------------->
    <!------------------Title--------------------->
    <!-------------------------------------------->

    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Création code promotion
    </h1>

    <br>

    <!--------------------------------------------------------->
    <!------------------Tableau des promos--------------------->
    <!--------------------------------------------------------->
    <div class="table-responsive">
        <table class="table">

            <thead class="thead_tableau_client">
                <tr>
                    <th id="tableau_client" scope="col">#</th>
                    <th id="tableau_client" scope="col">Code promo</th>
                    <th id="tableau_client" scope="col">Date de début</th>
                    <th id="tableau_client" scope="col">Date de fin</th>
                    <th id="tableau_client" scope="col">type de promotion</th>
                    <th id="tableau_client" scope="col">Valeur</th>
                    <th id="tableau_client" scope="col">Montant minimum d'achat</th>
                    <th id="tableau_client" scope="col">action promo</th>

                </tr>
            </thead>

            <tbody>

                <?php foreach ($show_promo as $row_promo) { ?>
                <?php if ($row_promo->actif == 1) { ?>
                <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><?php echo $row_promo->nom_promo; ?></td>
                    <td><?php echo $row_promo->date_debut; ?></td>
                    <td><?php echo $row_promo->date_fin; ?></td>

                    <td><?php if ($row_promo->type_promo == 1) {
                                    echo "montant en %";
                                } elseif ($row_promo->type_promo == 2) {
                                    echo "montant en valeur";
                                }; ?></td>

                    <td><?php echo $row_promo->valeur_promo; ?>€</td>
                    <td><?php echo $row_promo->montant_mini; ?>€</td>
                    <td>
                        <form action="admin_code_reduction.php" method="POST">

                            <input hidden class="" name="id_promo" value="<?php echo $row_promo->id_promo; ?>">

                            <input name="supprimer" type="submit" class="btn btn-outline-danger btn-sm"
                                value="supprimer"></input>

                        </form>
                    </td>
                </tr>
                <?php } ?>
                <?php } ?>

            </tbody>
        </table>
    </div>


    <!-------------------------------------------->
    <!------------------Code promo --------------->
    <!-------------------------------------------->


    <form action="admin_code_reduction.php" method="POST">



        <!------------------------------------------>
        <!---------------------Code  --------------->
        <!------------------------------------------>

        <label for="" class="badge-pill badge-info">Nom du code promo</label><br>
        <!-- permet de forcer les lettres en majuscule -->
        <input class="form-control" type="text" name="Code" onkeyup="this.value=this.value.toUpperCase()">

        <!------------------------------------------>
        <!---------------------Type---------------->
        <!------------------------------------------>

        <label class="badge-pill badge-info">type de promotion</label>
        <select name="id_type" class="form-control">

            <option value="">type de promotion</option>
            <option value="1">% du prix</option>
            <option value="2">montant</option>

        </select>

        <!-------------------------------------------------------->
        <!-------------------Valeur de la promotiont--------------->
        <!-------------------------------------------------------->

        <label for="" class="badge-pill badge-info">Valeur</label><br>
        <input type="number" name="Valeur" value="Valeur" class="form-control" required>

        <!-------------------------------------------------------->
        <!-------------------montant mini d'achat----------------->
        <!-------------------------------------------------------->

        <label for="" class="badge-pill badge-info">montant mini d'achat</label><br>
        <input type="number" name="montant_mini_achat" value="montant_mini_achat" class="form-control" required>


        <!-------------------------------------------------------->
        <!----------------------date de début--------------------->
        <!-------------------------------------------------------->

        <label for="" class="badge-pill badge-info">date de début</label><br>
        <input type="date" name="date_de_debut" value="date_de_debut" class="form-control" required>

        <!-------------------------------------------------------->
        <!------------------------date de fin--------------------->
        <!-------------------------------------------------------->

        <label for="" class="badge-pill badge-info">date de fin</label><br>
        <input type="date" name="date_de_fin" value="date_de_fin" class="form-control" required>

        <input name="envoyer" type="submit" class="btn btn-primary" value="envoyer"></input>

    </form>


</div>



<?php require "../footer/footer.php" ?>
<?php require "../footer/modal.php" ?>