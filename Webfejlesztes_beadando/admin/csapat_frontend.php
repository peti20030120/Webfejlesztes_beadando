<?php
    require_once("../adatbazis.php");
    $csapatok = mysqli_query($conn, "SELECT * FROM csapatok;");
    $bajnoksagok = mysqli_query($conn, "SELECT * FROM bajnoksagok;");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Admin felület </title>
		<link rel="Stylesheet" type="text/css" href="/Webfejlesztes_beadando/css/bootstrap.css">
		<link rel="Stylesheet" type="text/css" href="/Webfejlesztes_beadando/css/osszes.css">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	</head>
	<body class="magyarvalogatotthatterkep">
		<div>
			<div class="container-fluid feherhatter oldalkitoltese">
			
				<!--Rögzítés eleje-->
				<div class="kozep felkover betumeret24">
					Csapat rögzítés
				</div>
				<form id="Csapat" action="/ajax/csapat_backend.php" method="post">
					<input type="text" placeholder="Név" id="Nev" name="Cs_nev"/>
					<input type="number" placeholder="Gyorsaság" id="Cs_gyorsasag" name="Cs_gyorsasag"/>
					<input type="number" placeholder="Védekezés" id="Cs_vedekezes" name="Cs_vedekezes"/>
					<input type="number" placeholder="Középpálya" id="Cs_kozeppalya" name="Cs_kozeppalya"/>
					<input type="number" placeholder="Támadás" id="Cs_tamadas" name="Cs_tamadas"/>
					<input type="number" placeholder="Moralitás" id="Cs_moralitas" name="Cs_moralitas"/>
					<input type="number" placeholder="Forma" id="Cs_forma" name="Cs_forma"/>
					<input type="submit" name="Cs_submit" value="Feltöltés" id="Csapat_gomb"/>
				</form>
				<!--Rögzítés vége-->
				
				</br>
				</br>
				
				<!--Csapat bajnoksághoz kötés eleje-->
				<div class="kozep felkover betumeret24">
					Kösd bajnoksághoz a csapatot
				</div>
				<form id="bcs_kotes" action="/ajax/csapat_backend.php" method="post">
					<select name="Cs_Csapat_id" id="Cs_Csapat_id">
					<option hidden value="">Válassz egy csapatot</option>
						<?php
							foreach($csapatok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<select name="Cs_Bajnoksag_id" id=Cs_Bajnoksag_id>
						<option hidden value="">Válassz egy bajnokságot</option>
						<?php
							foreach($bajnoksagok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<input type="submit" name="Bcs_submit" value="Feltöltés" id="Bcs_gomb">
				</form>
				<!--Csapat bajnoksághoz kötés vége-->
				
				</br>
				</br>

                <!--Törlés eleje-->
                <div class="kozep felkover betumeret24">
					Csapat törlés
				</div>
                <div class="kozep">
                    <form id="Delete" action="/ajax/csapat_backend.php" method="post">
                        <select name="Torol" id=Torol>
                            <option hidden value="">Válaszd ki a törölni kívánt csapat nevét</option>
                            <?php
                                foreach($csapatok as $ered){
                                    print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
                                }
                            ?>
                        </select>
                        <input type="submit" name="Delete" value="Törlés" id="Delete">
                    </form>
                </div>
                <!--Törlés vége-->
            </div>
        </div>
    </body>

    <script type="text/javascript">
        $(document).ready(function (e) {
            //Rögzítés eleje
			
			$("#Csapat").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Csapat_gomb').disabled = true;*/
				$.ajax({
					url: '/Webfejlesztes_beadando/admin/ajax/csapat_backend.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							if(data == 1) {
								//minden mező alaphelyzetbe állítása
								document.getElementById('Nev').value = "";
								document.getElementById('Cs_gyorsasag').value = "";
								document.getElementById('Cs_vedekezes').value = "";
								document.getElementById('Cs_kozeppalya').value = "";
								document.getElementById('Cs_tamadas').value = "";
								document.getElementById('Cs_moralitas').value = "";
								document.getElementById('Cs_forma').value = "";
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres feltöltés");
							} else {
								if(data == 2){
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres felülírás");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Nev').value = "";
								document.getElementById('Cs_gyorsasag').value = "";
								document.getElementById('Cs_vedekezes').value = "";
								document.getElementById('Cs_kozeppalya').value = "";
								document.getElementById('Cs_tamadas').value = "";
								document.getElementById('Cs_moralitas').value = "";
								document.getElementById('Cs_forma').value = "";
								} else {
									//notification kiküldése a sikertelen feltöltésről
									alert(data);
								}
							}
							document.getElementById('Csapat_gomb').disabled = false;
						},
				});
			}));
			
			//Rögzítés vége
			//Csapat bajnoksághoz kötésének eleje
			
			$("#bcs_kotes").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Bcs_gomb').disabled = true;*/
				$.ajax({
					url: '/Webfejlesztes_beadando/admin/ajax/csapat_backend.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							if(data == 1) {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres feltöltés");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Cs_Csapat_id').value = 'Válassz csapatot';
								document.getElementById('Cs_Bajnoksag_id').value = 'Válassz bajnokságot';
							} else {
								if(data == 2) {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres felülírás");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Cs_Csapat_id').value = 'Válassz csapatot';
								document.getElementById('Cs_Bajnoksag_id').value = 'Válassz bajnokságot';
								} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
								}
							}
							document.getElementById('Bcs_gomb').disabled = false;
						},
				});
			}));
			
			//Csapat bajnoksághoz kötésének vége

            //Törlés eleje
			
			$("#Delete").on('submit',(function(e) {
				e.preventDefault();
				$.ajax({
					url: '/Webfejlesztes_beadando/admin/ajax/csapat_backend.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							if(data == 1) {
								//notification kiküldése a sikeres törlésről
								alert("Sikeres törlés");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Torol').value = 'Válaszd ki a törölni kívánt csapat nevét';

							} else {
								//notification kiküldése a sikertelen törlésről
								alert(data);						
							}
							document.getElementById('Delete').disabled = false;
						},
				});
			}));
			
			//Törlés vége

        });
    </script>
</html>