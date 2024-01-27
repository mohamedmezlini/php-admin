<?php
session_start();
include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
} else {
    $action = $_REQUEST['action'] ?? '';

    if ( 'addMoniteur' == $action ) {
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $ville = $_REQUEST['ville'] ?? '';
        $password = $_REQUEST['password'] ?? '';

        if ( $fname && $lname && $lname && $phone && $password ) {
            $hashPassword = password_hash( $password, PASSWORD_BCRYPT );
            $query = "INSERT INTO moniteurs(fname,lname,email,phone,ville,password) VALUES ('{$fname}','$lname','$email','$phone','$ville','$hashPassword')";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allMoniteur" );
        }

    } elseif ( 'updateMoniteur' == $action ) {
        $id = $_REQUEST['id'] ?? '';
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $ville = $_REQUEST['ville'] ?? '';

        if ( $fname && $lname && $lname && $phone ) {
            $query = "UPDATE moniteurs SET fname='{$fname}', lname='{$lname}', email='$email', phone='$phone', ville='$ville' WHERE id='{$id}'";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allMoniteur" );
        }
    } elseif ( 'addAdherent' == $action ) {
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $ville = $_REQUEST['ville'] ?? '';
        $password = $_REQUEST['password'] ?? '';

        if ( $fname && $lname && $lname && $phone && $password ) {
            $hashPassword = password_hash( $password, PASSWORD_BCRYPT );
            $query = "INSERT INTO adherents(fname,lname,email,phone,ville,password) VALUES ('{$fname}','$lname','$email','$phone','$ville','$hashPassword')";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allAdherent" );
        }
    } elseif ( 'updateAdherent' == $action ) {
        $id = $_REQUEST['id'] ?? '';
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $ville = $_REQUEST['ville'] ?? '';

        if ( $fname && $lname && $lname && $phone ) {
            $query = "UPDATE adherents SET fname='{$fname}', lname='{$lname}', email='$email', phone='$phone', ville='$ville' WHERE id='{$id}'";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allAdherent" );
        }
    } elseif ( 'addSeance' == $action ) {
        $idM = $_REQUEST['idM'] ?? '';
        $idA = $_REQUEST['idA'] ?? '';
        $dateS = $_REQUEST['dateS'] ?? '';
        $heureS = $_REQUEST['heureS'] ?? '';
        $nbHeures = $_REQUEST['nbHeures'] ?? '';



        if ( $idM && $idA && $dateS && $heureS && $nbHeures ) {
            $query = "INSERT INTO seances(idM,idA,dateS,heureS,nbHeures) VALUES ('{$idM}','$idA','$dateS','$heureS','$nbHeures')";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allSeance" );
        }
    } elseif ( 'updateSeance' == $action ) {
        $id = $_REQUEST['id'] ?? '';
        $idM = $_REQUEST['idM'] ?? '';
        $idA = $_REQUEST['idA'] ?? '';
        $dateS = $_REQUEST['dateS'] ?? '';
        $heureS = $_REQUEST['heureS'] ?? '';
        $nbHeures = $_REQUEST['nbHeures'] ?? '';

        if ( $idM && $idA && $dateS) {
            $query = "UPDATE seances SET idM='{$idM}', idA='{$idA}', dateS='$dateS', heureS='$heureS', nbHeures='$nbHeures' WHERE id='{$id}'";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allSeance" );
        }
    } elseif ( 'updateProfile' == $action ) {

        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $ville = $_REQUEST['ville'] ?? '';
        $oldPassword = $_REQUEST['oldPassword'] ?? '';
        $newPassword = $_REQUEST['newPassword'] ?? '';
        $sessionId = $_SESSION['id'] ?? '';
        $sessionRole = $_SESSION['role'] ?? '';
        $avatar = $_FILES['avatar']['name'] ?? "";

        if ( $fname && $lname && $email && $phone && $oldPassword && $newPassword ) {
            $query = "SELECT password,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
            $result = mysqli_query( $connection, $query );

            if ( $data = mysqli_fetch_assoc( $result ) ) {
                $_password = $data['password'];
                $_avatar = $data['avatar'];
                $avatarName = '';
                if ( $_FILES['avatar']['name'] !== "" ) {
                    $allowType = array(
                        'image/png',
                        'image/jpg',
                        'image/jpeg'
                    );
                    if ( in_array( $_FILES['avatar']['type'], $allowType ) !== false ) {
                        $avatarName = $_FILES['avatar']['name'];
                        $avatarTmpName = $_FILES['avatar']['tmp_name'];
                        move_uploaded_file( $avatarTmpName, "assets/img/$avatar" );
                    } else {
                        header( "location:index.php?id=userProfileEdit&avatarError" );
                        return;
                    }
                } else {
                    $avatarName = $_avatar;
                }
                if ( password_verify( $oldPassword, $_password ) ) {
                    $hashPassword = password_hash( $newPassword, PASSWORD_BCRYPT );
                    $updateQuery = "UPDATE {$sessionRole}s SET fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}', ville='{$ville}' password='{$hashPassword}', avatar='{$avatarName}' WHERE id='{$sessionId}'";
                    mysqli_query( $connection, $updateQuery );

                    header( "location:index.php?id=userProfile" );
                }

            }

        } else {
            echo mysqli_error( $connection );
        }

    }

}
