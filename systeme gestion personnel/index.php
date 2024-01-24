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
                    } elseif ( 'addManager' == $id ) {
                        echo "Ajouter un nouveau manager";
                    } elseif ( 'allManager' == $id ) {
                        echo "Managers";
                    } elseif ( 'addProfesseur' == $id ) {
                        echo "Ajouter un nouveau professeur";
                    } elseif ( 'allProfesseur' == $id ) {
                        echo "Professeurs";
                    } elseif ( 'addEtudiant' == $id ) {
                        echo "Ajouter un nouveau etudiant";
                    } elseif ( 'allEtudiant' == $id ) {
                        echo "Etudiants";
                    } elseif ( 'userProfile' == $id ) {
                        echo "Votre Profil";
                    } elseif ( 'editManager' == $action ) {
                        echo "Modifier Manager";
                    } elseif ( 'editProfesseur' == $action ) {
                        echo "Modifier Professeur";
                    } elseif ( 'editEtudiant' == $action ) {
                        echo "Modifier Etudiant";
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
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addManager' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="index.php?id=addManager"><i id="left" class="fas fa-user-plus"></i></i>Ajouter Manager</a>
                </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allManager' == $id ) {
    echo " active";
}?>">
                <a href="index.php?id=allManager"><i id="left" class="fas fa-user"></i>Tous les Manager</a>
            </li>
            <?php if ( 'admin' == $sessionRole || 'manager' == $sessionRole ) {?>
                <!-- For Admin, Manager -->
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addProfesseur' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="index.php?id=addProfesseur"><i id="left" class="fas fa-user-plus"></i></i>Ajouter  
                        Professeur</a>
                </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allProfesseur' == $id ) {
    echo " active";
}?>">
                <a href="index.php?id=allProfesseur"><i id="left" class="fas fa-user"></i>Tous les professeurs</a>
            </li>
            <?php if ( 'admin' == $sessionRole || 'manager' == $sessionRole || 'professeur' == $sessionRole ) {?>
                <!-- For Admin, Manager, Professeur-->
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addEtudiant' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="index.php?id=addEtudiant"><i id="left" class="fas fa-user-plus"></i>Ajouter  Etudiant</a>
                </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allEtudiant' == $id ) {
    echo " active";
}?>">
                <a href="index.php?id=allEtudiant"><i id="left" class="fas fa-user"></i>Tous les etudiants</a>
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
                                            $query = "SELECT COUNT(*) totalManager FROM managers;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalManager = mysqli_fetch_assoc( $result );

                                                $query = "SELECT COUNT(*) totalProfesseur FROM professeurs;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalProfesseur = mysqli_fetch_assoc( $result );
                                               
                                                $query = "SELECT COUNT(*) totalEtudiant FROM etudiants;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalEtudiant = mysqli_fetch_assoc( $result );
                                            

                                                echo $totalManager['totalManager'] + $totalProfesseur['totalProfesseur'] + $totalEtudiant['totalEtudiant'];
                                            ?>
                                    </h1>
                                    <h3>Effectif total</h3>
                                </div>
                            </div> 

                            <div class="col-3">
                                <div class="total__box__manager text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalManager FROM managers;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalManager = mysqli_fetch_assoc( $result );
                                                echo $totalManager['totalManager'];
                                            ?>
                                    </h1>
                                    <h3>Managers </h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="total__box__prof text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalProfesseur FROM professeurs;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalProfesseur = mysqli_fetch_assoc( $result );
                                                echo $totalProfesseur['totalProfesseur'];
                                            ?>

                                    </h1>
                                    <h3>Professeurs</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="total__box__etudiant text-center">
                                    <h1><?php
                                            $query = "SELECT COUNT(*) totalEtudiant FROM etudiants;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalEtudiant = mysqli_fetch_assoc( $result );
                                            echo $totalEtudiant['totalEtudiant'];
                                            ?></h1>
                                    <h3>Etudiants</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- Dashboard ------------------------ -->

            <!-- ---------------------- Manager ------------------------ -->
            <div class="manager">
                <?php if ( 'allManager' == $id ) {?>
                    <div class="allManager">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <?php if ( 'admin' == $sessionRole ) {?>
                                            <!-- Only For Admin -->
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getManagers = "SELECT * FROM managers";
                                            $result = mysqli_query( $connection, $getManagers );

                                        while ( $manager = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $manager['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $manager['fname'], $manager['lname'] );?></td>
                                            <td><?php printf( "%s", $manager['email'] );?></td>
                                            <td><?php printf( "%s", $manager['phone'] );?></td>
                                            <?php if ( 'admin' == $sessionRole ) {?>
                                                <!-- Only For Admin -->
                                                <td><?php printf( "<a href='index.php?action=editManager&id=%s'><i class='fas fa-edit'></i></a>", $manager['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteManager&id=%s'><i class='fas fa-trash'></i></a>", $manager['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addManager' == $id ) {?>
                    <div class="addManager">
                        <div class="main__form">
                            <div class="main__form--title text-center">Ajouter un nouveau manager</div>
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
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Mot de passe" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addManager">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editManager' == $action ) {
                        $managerId = $_REQUEST['id'];
                        $selectManagers = "SELECT * FROM managers WHERE id='{$managerId}'";
                        $result = mysqli_query( $connection, $selectManagers );

                    $manager = mysqli_fetch_assoc( $result );?>
                    <div class="addManager">
                        <div class="main__form">
                            <div class="main__form--title text-center">Mettre à jour  Manager</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="Nom" value="<?php echo $manager['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Prénom" value="<?php echo $manager['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $manager['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $manager['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateManager">
                                    <input type="hidden" name="id" value="<?php echo $managerId; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteManager' == $action ) {
                        $managerId = $_REQUEST['id'];
                        $deleteManager = "DELETE FROM managers WHERE id ='{$managerId}'";
                        $result = mysqli_query( $connection, $deleteManager );
                        header( "location:index.php?id=allManager" );
                }?>
            </div>
            <!-- ---------------------- Manager ------------------------ -->

            <!-- ---------------------- Professeur ------------------------ -->
            <div class="professeur">
                <?php if ( 'allProfesseur' == $id ) {?>
                    <div class="allProfesseur">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <?php if ( 'admin' == $sessionRole || 'manager' == $sessionRole ) {?>
                                            <!-- For Admin, Manager -->
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getProfesseur = "SELECT * FROM professeurs";
                                            $result = mysqli_query( $connection, $getProfesseur );

                                        while ( $professeur = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $professeur['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $professeur['fname'], $professeur['lname'] );?></td>
                                            <td><?php printf( "%s", $professeur['email'] );?></td>
                                            <td><?php printf( "%s", $professeur['phone'] );?></td>
                                            <?php if ( 'admin' == $sessionRole || 'manager' == $sessionRole ) {?>
                                                <!-- For Admin, Manager -->
                                                <td><?php printf( "<a href='index.php?action=editProfesseur&id=%s'><i class='fas fa-edit'></i></a>", $professeur['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteProfesseur&id=%s'><i class='fas fa-trash'></i></a>", $professeur['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addProfesseur' == $id ) {?>
                    <div class="addProfesseur">
                        <div class="main__form">
                            <div class="main__form--title text-center">Ajouter un nouveau professeur</div>
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
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addProfesseur">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editProfesseur' == $action ) {
                        $professeurID = $_REQUEST['id'];
                        $selectProfesseur = "SELECT * FROM professeurs WHERE id='{$professeurID}'";
                        $result = mysqli_query( $connection, $selectProfesseur );

                    $professeur = mysqli_fetch_assoc( $result );?>
                    <div class="addManager">
                        <div class="main__form">
                            <div class="main__form--title text-center">Mettre à jour  Professeur</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="Nom" value="<?php echo $professeur['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Prénom" value="<?php echo $professeur['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $professeur['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $professeur['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateProfesseur">
                                    <input type="hidden" name="id" value="<?php echo $professeurID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteProfesseur' == $action ) {
                        $professeurID = $_REQUEST['id'];
                        $deleteProfesseur = "DELETE FROM professeurs WHERE id ='{$professeurID}'";
                        $result = mysqli_query( $connection, $deleteProfesseur );
                        header( "location:index.php?id=allProfesseur" );
                }?>
            </div>
            <!-- ---------------------- Professeur ------------------------ -->

            <!-- ---------------------- Etudiant ------------------------ -->
            <div class="etudiant">
                <?php if ( 'allEtudiant' == $id ) {?>
                    <div class="allEtudiant">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <?php if ( 'admin' == $sessionRole || 'manager' == $sessionRole || 'professeur' == $sessionRole ) {?>
                                            <!-- For Admin, Manager, Professeur-->
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getEtudiant = "SELECT * FROM etudiants";
                                            $result = mysqli_query( $connection, $getEtudiant );

                                        while ( $etudiant = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                             <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $etudiant['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $etudiant['fname'], $etudiant['lname'] );?></td>
                                            <td><?php printf( "%s", $etudiant['email'] );?></td>
                                            <td><?php printf( "%s", $etudiant['phone'] );?></td>
                                            <?php if ( 'admin' == $sessionRole || 'manager' == $sessionRole || 'professeur' == $sessionRole ) {?>
                                                <!-- For Admin, Manager, Professeur-->
                                                <td><?php printf( "<a href='index.php?action=editEtudiant&id=%s'><i class='fas fa-edit'></i></a>", $etudiant['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteEtudiant&id=%s'><i class='fas fa-trash'></i></a>", $etudiant['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addEtudiant' == $id ) {?>
                    <div class="addEtudiant">
                        <div class="main__form">
                            <div class="main__form--title text-center">Ajouter un nouveau etudiant</div>
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
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addEtudiant">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editEtudiant' == $action ) {
                        $etudiantID = $_REQUEST['id'];
                        $selectEtudiant = "SELECT * FROM etudiants WHERE id='{$etudiantID}'";
                        $result = mysqli_query( $connection, $selectEtudiant );

                    $etudiant = mysqli_fetch_assoc( $result );?>
                    <div class="addManager">
                        <div class="main__form">
                            <div class="main__form--title text-center">Mettre à jour  Etudiant</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="Nom" value="<?php echo $etudiant['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Prénom" value="<?php echo $etudiant['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $etudiant['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $etudiant['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateEtudiant">
                                    <input type="hidden" name="id" value="<?php echo $etudiantID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteEtudiant' == $action ) {
                        $etudiantID = $_REQUEST['id'];
                        $deleteEtudiant = "DELETE FROM etudiants WHERE id ='{$etudiantID}'";
                        $result = mysqli_query( $connection, $deleteEtudiant );
                        header( "location:index.php?id=allEtudiant" );
                        ob_end_flush();
                }?>
            </div>
            <!-- ---------------------- Etudiant ------------------------ -->

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
                                            echo "<p style='color:red;' class='text-center'>Please make sure this file is jpg, png or jpeg</p>";
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