<?php
    session_start();
    $sessionId = $_SESSION['id'] ?? '';
    $sessionRole = $_SESSION['role'] ?? '';
    echo "$sessionId $sessionRole";
    if ( !$sessionId && !$sessionRole ) {
        header( "location:login.php" );
        die();
    }

    ob_start();

    include_once "config.php";
    $connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( !$connection ) {
        echo mysqli_error( $connection );
        throw new Exception( "Database cannot Connect" );
    }

    $id = $_REQUEST['id'] ?? 'dashboard';
    $action = $_REQUEST['action'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard</title>
</head>

<body>
    <!--------------------------------- Secondary Navber -------------------------------->
    <section class="topber">
        <div class="topber__title">
            <span class="topber__title--text">
                <?php
                    if ( 'dashboard' == $id ) {
                        echo "Dashboard";
                    } elseif ( 'addMoniteur' == $id ) {
                        echo "Ajouter un nouveau moniteur";
                    } elseif ( 'allMoniteur' == $id ) {
                        echo "Moniteurs";
                    } elseif ( 'addAdherent' == $id ) {
                        echo "Ajouter un nouveau adherent";
                    } elseif ( 'allAdherent' == $id ) {
                        echo "Adherents";
                    } elseif ( 'addSeance' == $id ) {
                        echo "Ajouter un nouveau seance";
                    } elseif ( 'allSeance' == $id ) {
                        echo "Seances";
                    } elseif ( 'userProfile' == $id ) {
                        echo "Votre Profil";
                    } elseif ( 'editMoniteur' == $action ) {
                        echo "Modifier Moniteur";
                    } elseif ( 'editAdherent' == $action ) {
                        echo "Modifier Adherent";
                    } elseif ( 'editSeance' == $action ) {
                        echo "Modifier Seance";
                    }
                ?>

            </span>
        </div>

        <div class="topber__profile">
            <?php
                $query = "SELECT fname,lname,role,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query( $connection, $query );

                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $fname = $data['fname'];
                    $lname = $data['lname'];
                    $role = $data['role'];
                    $avatar = $data['avatar'];
                ?>
                <img src="assets/img/<?php echo "$avatar"; ?>" height="25" width="25" class="rounded-circle" alt="profil">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo "$fname $lname (" . ucwords( $role ) . " )";
                        }
                    ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="index.php">Dashboard</a>
                        <a class="dropdown-item" href="index.php?id=userProfile">Profil</a>
                        <a class="dropdown-item" href="logout.php">Se déconnecter</a>
                    </div>
                </div>
        </div>
    </section>
    <!--------------------------------- Secondary Navber -------------------------------->


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
            <h3 class="sideber__panel"><i id="left" class="fas fa-laugh-wink"></i> SGP</h3>
            <li id="left" class="sideber__item<?php if ( 'dashboard' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=dashboard"><i id="left" class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <?php if ( 'admin' == $sessionRole ) {?>
                <!-- Only For Admin -->
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addMoniteur' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="index.php?id=addMoniteur"><i id="left" class="fas fa-user-plus"></i></i>Ajouter Moniteur</a>
                </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allMoniteur' == $id ) {
    echo " active";
}?>">
                <a href="index.php?id=allMoniteur"><i id="left" class="fas fa-user"></i>Tous les Moniteur</a>
            </li>
            <?php if ( 'admin' == $sessionRole || 'moniteur' == $sessionRole ) {?>
                <!-- For Admin, Moniteur -->
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addAdherent' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="index.php?id=addAdherent"><i id="left" class="fas fa-user-plus"></i></i>Ajouter  
                        Adherent</a>
                </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allAdherent' == $id ) {
    echo " active";
}?>">
                <a href="index.php?id=allAdherent"><i id="left" class="fas fa-user"></i>Tous les adherents</a>
            </li>
            <?php if ( 'admin' == $sessionRole || 'moniteur' == $sessionRole || 'adherent' == $sessionRole ) {?>
                <!-- For Admin, Moniteur, Adherent-->
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addSeance' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="index.php?id=addSeance"><i id="left" class="fas fa-user-plus"></i>Ajouter  Seance</a>
                </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allSeance' == $id ) {
    echo " active";
}?>">
                <a href="index.php?id=allSeance"><i id="left" class="fas fa-user"></i>Toutes les seances</a>
            </li>
        </ul>
        <footer class="text-center"><span>SGP</span><br>©2024 Tous droits réservés.</footer>
    </section>
    <!--------------------------------- #Sideber -------------------------------->


    <!--------------------------------- Main section -------------------------------->
    <section class="main">
        <div class="container">

            <!-- ---------------------- Dashboard ------------------------ -->
            <?php if ( 'dashboard' == $id ) {?>
                <div class="dashboard">
                    <div class="total">
                        <div class="row">
                            <div class="col-3">
                                <div class="total__box text-center" >
                                    <h1>                                        
                                    <?php
                                            $query = "SELECT COUNT(*) totalMoniteur FROM moniteurs;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalMoniteur = mysqli_fetch_assoc( $result );

                                                $query = "SELECT COUNT(*) totalAdherent FROM adherents;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalAdherent = mysqli_fetch_assoc( $result );
                                               

                                                echo $totalMoniteur['totalMoniteur'] + $totalAdherent['totalAdherent'] ;
                                            ?>
                                    </h1>
                                    <h3>Effectif total</h3>
                                </div>
                            </div> 

                            <div class="col-3">
                                <div class="total__box__moniteur text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalMoniteur FROM moniteurs;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalMoniteur = mysqli_fetch_assoc( $result );
                                                echo $totalMoniteur['totalMoniteur'];
                                            ?>
                                    </h1>
                                    <h3>Moniteurs </h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="total__box__prof text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalAdherent FROM adherents;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalAdherent = mysqli_fetch_assoc( $result );
                                                echo $totalAdherent['totalAdherent'];
                                            ?>

                                    </h1>
                                    <h3>Adherents</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="total__box__seance text-center">
                                    <h1><?php
                                            $query = "SELECT COUNT(*) totalSeance FROM seances;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalSeance = mysqli_fetch_assoc( $result );
                                            echo $totalSeance['totalSeance'];
                                            ?></h1>
                                    <h3>Seances</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- Dashboard ------------------------ -->

            <!-- ---------------------- Moniteur ------------------------ -->
            <div class="moniteur">
                <?php if ( 'allMoniteur' == $id ) {?>
                    <div class="allMoniteur">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Ville</th>
                                        <?php if ( 'admin' == $sessionRole ) {?>
                                            <!-- Only For Admin -->
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getMoniteurs = "SELECT * FROM moniteurs";
                                            $result = mysqli_query( $connection, $getMoniteurs );

                                        while ( $moniteur = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $moniteur['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $moniteur['fname'], $moniteur['lname'] );?></td>
                                            <td><?php printf( "%s", $moniteur['email'] );?></td>
                                            <td><?php printf( "%s", $moniteur['phone'] );?></td>
                                            <td><?php printf( "%s", $moniteur['ville'] );?></td>
                                            <?php if ( 'admin' == $sessionRole ) {?>
                                                <!-- Only For Admin -->
                                                <td><?php printf( "<a href='index.php?action=editMoniteur&id=%s'><i class='fas fa-edit'></i></a>", $moniteur['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteMoniteur&id=%s'><i class='fas fa-trash'></i></a>", $moniteur['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addMoniteur' == $id ) {?>
                    <div class="addMoniteur">
                        <div class="main__form">
                            <div class="main__form--title text-center">Ajouter un nouveau moniteur</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="Nom" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Prénom" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-city"></i>
                                            <input type="text" name="ville" placeholder="Ville"  required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Mot de passe" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addMoniteur">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editMoniteur' == $action ) {
                        $moniteurId = $_REQUEST['id'];
                        $selectMoniteurs = "SELECT * FROM moniteurs WHERE id='{$moniteurId}'";
                        $result = mysqli_query( $connection, $selectMoniteurs );

                    $moniteur = mysqli_fetch_assoc( $result );?>
                    <div class="addMoniteur">
                        <div class="main__form">
                            <div class="main__form--title text-center">Mettre à jour  Moniteur</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="Nom" value="<?php echo $moniteur['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Prénom" value="<?php echo $moniteur['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $moniteur['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $moniteur['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-city"></i>
                                            <input type="text" name="ville" placeholder="Ville" value="<?php echo $moniteur['ville']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateMoniteur">
                                    <input type="hidden" name="id" value="<?php echo $moniteurId; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteMoniteur' == $action ) {
                        $moniteurId = $_REQUEST['id'];
                        $deleteMoniteur = "DELETE FROM moniteurs WHERE id ='{$moniteurId}'";
                        $result = mysqli_query( $connection, $deleteMoniteur );
                        header( "location:index.php?id=allMoniteur" );
                }?>
            </div>
            <!-- ---------------------- Moniteur ------------------------ -->

            <!-- ---------------------- Adherent ------------------------ -->
            <div class="adherent">
                <?php if ( 'allAdherent' == $id ) {?>
                    <div class="allAdherent">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Ville</th>
                                        <?php if ( 'admin' == $sessionRole || 'moniteur' == $sessionRole ) {?>
                                            <!-- For Admin, Moniteur -->
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getAdherent = "SELECT * FROM adherents";
                                            $result = mysqli_query( $connection, $getAdherent );

                                        while ( $adherent = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $adherent['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $adherent['fname'], $adherent['lname'] );?></td>
                                            <td><?php printf( "%s", $adherent['email'] );?></td>
                                            <td><?php printf( "%s", $adherent['phone'] );?></td>
                                            <td><?php printf( "%s", $adherent['ville'] );?></td>
                                            <?php if ( 'admin' == $sessionRole || 'moniteur' == $sessionRole ) {?>
                                                <!-- For Admin, Moniteur -->
                                                <td><?php printf( "<a href='index.php?action=editAdherent&id=%s'><i class='fas fa-edit'></i></a>", $adherent['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteAdherent&id=%s'><i class='fas fa-trash'></i></a>", $adherent['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addAdherent' == $id ) {?>
                    <div class="addAdherent">
                        <div class="main__form">
                            <div class="main__form--title text-center">Ajouter un nouveau adherent</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="Nom" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Prénom" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-city"></i>
                                            <input type="text" name="ville" placeholder="Ville"  required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addAdherent">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editAdherent' == $action ) {
                        $adherentID = $_REQUEST['id'];
                        $selectAdherent = "SELECT * FROM adherents WHERE id='{$adherentID}'";
                        $result = mysqli_query( $connection, $selectAdherent );

                    $adherent = mysqli_fetch_assoc( $result );?>
                    <div class="addMoniteur">
                        <div class="main__form">
                            <div class="main__form--title text-center">Mettre à jour  Adherent</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="Nom" value="<?php echo $adherent['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Prénom" value="<?php echo $adherent['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $adherent['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $adherent['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-city"></i>
                                            <input type="text" name="ville" placeholder="Ville" value="<?php echo $adherent['ville']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateAdherent">
                                    <input type="hidden" name="id" value="<?php echo $adherentID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteAdherent' == $action ) {
                        $adherentID = $_REQUEST['id'];
                        $deleteAdherent = "DELETE FROM adherents WHERE id ='{$adherentID}'";
                        $result = mysqli_query( $connection, $deleteAdherent );
                        header( "location:index.php?id=allAdherent" );
                }?>
            </div>
            <!-- ---------------------- Adherent ------------------------ -->

            <!-- ---------------------- Seance ------------------------ -->
            <div class="seance">
                <?php if ( 'allSeance' == $id ) {?>
                    <div class="allSeance">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Moniteur</th>
                                        <th scope="col">Adhérent</th>
                                        <th scope="col">Date séance </th>
                                        <th scope="col">Heure  séance</th>
                                        <th scope="col">Nombre Heures</th>
                                        <?php if ( 'admin' == $sessionRole || 'moniteur' == $sessionRole || 'adherent' == $sessionRole ) {?>
                                            <!-- For Admin, Moniteur, Adherent-->
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                        $getSeance = "SELECT seances.id, 
                                        moniteurs.fname AS moniteurFName, moniteurs.lname AS moniteurLName, 
                                        adherents.fname AS adherentFName, adherents.lname AS adherentLName, 
                                        dateS, heureS, nbHeures
                                        FROM seances
                                        JOIN moniteurs ON seances.idM = moniteurs.id
                                        JOIN adherents ON seances.idA = adherents.id" ;
                                            $result = mysqli_query( $connection, $getSeance );

                                        while ( $seance = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td><?php printf( "%s", $seance['moniteurFName'] .  " ". $seance['moniteurLName'] );?></td>
                                            <td><?php printf( "%s",  $seance['adherentFName'] .  " ". $seance['adherentLName'] );?></td>
                                            <td><?php printf( "%s", $seance['dateS'] );?></td>
                                            <td><?php printf( "%s", $seance['heureS'] );?></td>
                                            <td><?php printf( "%s", $seance['nbHeures'] );?></td>
                                            <?php if ( 'admin' == $sessionRole || 'moniteur' == $sessionRole || 'adherent' == $sessionRole ) {?>
                                                <!-- For Admin, Moniteur, Adherent-->
                                                <td><?php printf( "<a href='index.php?action=editSeance&id=%s'><i class='fas fa-edit'></i></a>", $seance['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteSeance&id=%s'><i class='fas fa-trash'></i></a>", $seance['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addSeance' == $id ) {
                    
                    
                    // Retrieve existing moniteurs for the dropdown list
                    $moniteurQuery = "SELECT id, fname, lname FROM moniteurs";
                    $moniteurResult = mysqli_query( $connection, $moniteurQuery );
                  

                    // Retrieve existing adherents for the dropdown list
                    $adherentQuery = "SELECT id, fname, lname FROM adherents";
                    $adherentResult = mysqli_query( $connection, $adherentQuery );
                   
                    
                    ?>
                    <div class="addSeance">
                        <div class="main__form">
                            <div class="main__form--title text-center">Ajouter un nouveau seance</div>
                           
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <select name="idM" required placeholder="Moniteur">
                                                <?php
                                                // Populate the dropdown with existing moniteurs
                                                while ($row = $moniteurResult->fetch_assoc()) {
                                                    echo "<option value='{$row['id']}' $selected>{$row['fname']} {$row['lname']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <select name="idA" required placeholder="Adhérent">
                                                <?php
                                                // Populate the dropdown with existing adherents
                                                while ($row = $adherentResult->fetch_assoc()) {
                                                    echo "<option value='{$row['id']}' $selected>{$row['fname']} {$row['lname']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>  

                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-calendar-alt"></i>
                                            <input type="date" name="dateS" placeholder="Date séance"  required>
                                        </label>
                                    </div>  
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-clock"></i>
                                            <input type="time" name="heureS" placeholder="Heure"  required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-hourglass-half"></i>
                                            <input type="number" name="nbHeures" placeholder="Nombre d'heures"  required>
                                    </label>
                                    </div>

                                    <input type="hidden" name="action" value="addSeance">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editSeance' == $action ) {
                        $seanceID = $_REQUEST['id'];
                        $selectSeance = "SELECT * FROM seances WHERE id='{$seanceID}'";
                        $result = mysqli_query( $connection, $selectSeance );
                        $seance = mysqli_fetch_assoc( $result );
                    

                    // Retrieve existing moniteurs for the dropdown list
                    $moniteurQuery = "SELECT id, fname, lname FROM moniteurs";
                    $moniteurResult = mysqli_query( $connection, $moniteurQuery );
                  

                    // Retrieve existing adherents for the dropdown list
                    $adherentQuery = "SELECT id, fname, lname FROM adherents";
                    $adherentResult = mysqli_query( $connection, $adherentQuery );
                   


                    
                    ?>
                    <div class="addMoniteur">
                        <div class="main__form">
                            <div class="main__form--title text-center">Mettre à jour  Seance</div>
                            
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <select name="idM" required placeholder="Moniteur">
                                                <?php
                                                // Populate the dropdown with existing moniteurs
                                                while ($row = $moniteurResult->fetch_assoc()) {
                                                    $selected = ($seanceData['idM'] == $row['id']) ? 'selected' : '';
                                                    echo "<option value='{$row['id']}' $selected>{$row['fname']} {$row['lname']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <select name="idA" required placeholder="Adhérent">
                                                <?php
                                                // Populate the dropdown with existing adherents
                                                while ($row = $adherentResult->fetch_assoc()) {
                                                    $selected = ($seanceData['idA'] == $row['id']) ? 'selected' : '';
                                                    echo "<option value='{$row['id']}' $selected>{$row['fname']} {$row['lname']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>  

                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-calendar-alt"></i>
                                            <input type="date" name="dateS" placeholder="Date séance" value="<?php echo $seance['dateS']; ?>" required>
                                        </label>
                                    </div>  
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-clock"></i>
                                            <input type="time" name="heureS" placeholder="Heure" value="<?php echo $seance['heureS']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-hourglass-half"></i>
                                            <input type="number" name="nbHeures" placeholder="Nombre d'heures" value="<?php echo $seance['nbHeures']; ?>" required>
                                       </label>
                                    </div>

                                    <input type="hidden" name="action" value="updateSeance">
                                    <input type="hidden" name="id" value="<?php echo $seanceID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteSeance' == $action ) {
                        $seanceID = $_REQUEST['id'];
                        $deleteSeance = "DELETE FROM seances WHERE id ='{$seanceID}'";
                        $result = mysqli_query( $connection, $deleteSeance );
                        header( "location:index.php?id=allSeance" );
                        ob_end_flush();
                }?>
            </div>
            <!-- ---------------------- Seance ------------------------ -->

            <!-- ---------------------- User Profile ------------------------ -->
            <?php if ( 'userProfile' == $id ) {
                    $query = "SELECT * FROM {$sessionRole}s WHERE id='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>
                <div class="userProfile">
                    <div class="main__form myProfile">
                        <form action="index.php">
                            <div class="main__form--title myProfile__title text-center">Mon Profile</div>
                            <div class="form-row text-center">
                                <div class="col col-12 text-center pb-3">
                                    <img src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="col col-12">
                                    <h4><b>Nom  : </b><?php printf( "%s %s", $data['fname'], $data['lname'] );?></h4>
                                </div>
                                <div class="col col-12">
                                    <h4><b>Email : </b><?php printf( "%s", $data['email'] );?></h4>
                                </div>
                                <div class="col col-12">
                                    <h4><b>Phone : </b><?php printf( "%s", $data['phone'] );?></h4>
                                </div>
                                <input type="hidden" name="id" value="userProfileEdit">
                                <div class="col col-12">
                                    <input class="updateMyProfile" type="submit" value="Mettre à jour  Profil">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }?>

            <?php if ( 'userProfileEdit' == $id ) {
                    $query = "SELECT * FROM {$sessionRole}s WHERE id='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>


                <div class="userProfileEdit">
                    <div class="main__form">
                        <div class="main__form--title text-center">Mettre à jour mon Profil</div>
                        <form enctype="multipart/form-data" action="add.php" method="POST">
                            <div class="form-row">
                                <div class="col col-12 text-center pb-3">
                                    <img id="pimg" src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                    <i class="fas fa-pen pimgedit"></i>
                                    <input onchange="document.getElementById('pimg').src = window.URL.createObjectURL(this.files[0])" id="pimgi" style="display: none;" type="file" name="avatar">
                                </div>
                                <div class="col col-12">
                                <?php if ( isset( $_REQUEST['avatarError'] ) ) {
                                            echo "<p style='color:red;' class='text-center'>Veuillez vous assurer que ce fichier est is jpg, png or jpeg</p>";
                                    }?>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="fname" placeholder="Nom" value="<?php echo $data['fname']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="lname" placeholder="Prénom" value="<?php echo $data['lname']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-envelope"></i>
                                        <input type="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-phone-alt"></i>
                                        <input type="number" name="phone" placeholder="Phone" value="<?php echo $data['phone']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-city"></i>
                                            <input type="text" name="ville" placeholder="Ville" value="<?php echo $data['ville']; ?>" required>
                                        </label>
                                    </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-key"></i>
                                        <input id="pwdinput" type="password" name="oldPassword" placeholder=" Ancien mot de passe" required>
                                        <i id="pwd" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-key"></i>
                                        <input id="pwdinput" type="password" name="newPassword" placeholder="Nouveau mot de passe" required>
                                        <p>Tapez l'ancien mot de passe si vous ne voulez pas changer</p>
                                        <i id="pwd" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <input type="hidden" name="action" value="updateProfile">
                                <div class="col col-12">
                                    <input type="submit" value="Enregistrer">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- User Profil ------------------------ -->

        </div>

    </section>

    <!--------------------------------- #Main section -------------------------------->



    <!-- Optional JavaScript -->
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="./assets/js/app.js"></script>
</body>

</html>