<?php
	require_once("../../adatbazis.php");
	require_once("../session.php");


//Csapat rögzítés eleje

if(isset($_POST["Cs_nev"]) && isset($_POST["Cs_gyorsasag"]) && isset($_POST["Cs_vedekezes"]) && isset($_POST["Cs_kozeppalya"]) && isset($_POST["Cs_tamadas"]) && isset($_POST["Cs_moralitas"]) && isset($_POST["Cs_forma"])) {
    $Nev = mysqli_real_escape_string($conn, $_POST["Cs_nev"]);
    $Gyorsasag = mysqli_real_escape_string($conn, $_POST["Cs_gyorsasag"]);
    $Vedekezes = mysqli_real_escape_string($conn, $_POST["Cs_vedekezes"]);
    $Kozeppalya = mysqli_real_escape_string($conn, $_POST["Cs_kozeppalya"]);
    $Tamadas = mysqli_real_escape_string($conn, $_POST["Cs_tamadas"]);
    $Moralitas = mysqli_real_escape_string($conn, $_POST["Cs_moralitas"]);
    $Forma = mysqli_real_escape_string($conn, $_POST["Cs_forma"]);
    if($Nev != "" && $Gyorsasag != "" && $Vedekezes != "" && $Kozeppalya != "" && $Tamadas != "" && $Moralitas != "" && $Forma != "") {
        $vane = mysqli_query($conn,"
        SELECT Id FROM csapatok WHERE Nev='".$Nev."';
        ");
    
        if(mysqli_num_rows($vane) == 0) {
            mysqli_query($conn, "INSERT INTO csapatok(Nev, Gyorsasag, Vedekezes, Kozeppalya, Tamadas, Moralitas, Forma)
                                VALUES('".$Nev."', ".$Gyorsasag.", ".$Vedekezes.", ".$Kozeppalya.", ".$Tamadas.", 
                                ".$Moralitas.", ".$Forma.");");
                                print 1;
        } else {
            mysqli_query($conn, "UPDATE csapatok 
                                SET Gyorsasag = ".$Gyorsasag.", Vedekezes = ".$Vedekezes.", Kozeppalya = ".$Kozeppalya.", Tamadas = ".$Tamadas.",
                                Moralitas = ".$Moralitas.", Forma = ".$Forma." 
                                WHERE nev = '".$Nev."';");
                                print 2;
        } 
    } else {
        print "Minden mezőt ki kell töltened!";
    }
}

//Csapat rögzítés vége

//Csapat bajnoksághöz kötésének eleje
if(isset($_POST["Cs_Csapat_id"]) && isset($_POST["Cs_Bajnoksag_id"]) /*&& isset($_POST["Bcs_submit"])*/) {
    $Csapat_id = mysqli_real_escape_string($conn, $_POST["Cs_Csapat_id"]);
    $Bajnoksag_id = mysqli_real_escape_string($conn, $_POST["Cs_Bajnoksag_id"]);
    $vane = mysqli_query($conn, "SELECT csapat_id
                                FROM bajnoksagok_csapatok
                                WHERE csapat_id = ".$Csapat_id.";");
                                
    if(mysqli_num_rows($vane) == 0) {
        mysqli_query($conn, "INSERT INTO bajnoksagok_csapatok(bajnoksag_id,  csapat_id)
                            VALUES(".$Bajnoksag_id.", ".$Csapat_id.");");
        print 1;
    } else {
        mysqli_query($conn, "UPDATE bajnoksagok_csapatok 
                                SET bajnoksag_id = ".$Bajnoksag_id."
                                WHERE csapat_id = ".$vane.";");
        print 2;
}
}
//Csapat bajnoksághöz kötésének vége

//Csapat törlés eleje
if(isset($_POST["Torol"])) {
    $Torol = mysqli_real_escape_string($conn, $_POST["Torol"]);
    mysqli_query($conn, "DELETE FROM `bajnoksagok_csapatok` WHERE csapat_id = '".$Torol."';");
    mysqli_query($conn, "DELETE FROM `csapatok` WHERE Id = '".$Torol."';");
    print 1;
}
//Csapat törlés vége
?>

