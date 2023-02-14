<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" type="image/x-icon" href="./favicon.ico">
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles/main_backend.css">
		<style>
			
		</style>
	</head>
	<body>
		<h1>AGs</h1>
		<?php
			require 'DBconnect.php';
		?>
		<form name="test", id='customers'>
			<table>
			  <tr>
				<th>Name der AG</th> <th>Ab Jahrgang</th> <th>Bis Jahrgang</th> <th>Maximale Teilnehmerzahl</th> <th>Geschlecht</th> <th>Lehrer</th> <th>Wird angeboten</th>
			  </tr>
				<?php
					$i = 0;
					
					foreach ($DBASE->query('SELECT * from AGs') as $row) {
						echo '	<tr> <input type="hidden" name="id'.$i.'" value="'.$row["ID"].'"/>
								<td> <input type="text" name="nameag'.$i.'" value="'.$row["Name"].'"/>
								</td>
								<td>';
						for($x = 5; $x <= 10; $x = $x +1){
							echo '<input type="radio" name="ujgstag'.$i.'" value="'.$x.'" ' . ($row["AbJg"] == $x ? "checked" : "" ) . '/>'.$x.'';
						}
						echo '	</td>
								<td>';
						for($x = 5; $x <= 10; $x = $x + 1){
							echo '<input type="radio" name="ojgstag'.$i.'" value="'.$x.'" ' . ($row["BisJg"] == $x ? "checked" : "" ) . '/>'.$x.'';
						}
						echo '</td>
							<td> <input type="number" min="0" max="50" name="tzahlag'.$i.'" value="'. $row["MaxTeilnZahl"] .'"/> </td>
							<td> <input type="text" name="geschlechtag'.$i.'" value="'.$row["VorgGeschlecht"].'"/> </td>
							<td> <input type="text" name="lehrerag'.$i.'" value="'.$row["Lehrer"].'"/> </td>
							<td> <input type="checkbox" name="aktivag'.$i.'" value="true"'.($row["Aktiv"] ? "checked" : "").'/> </td>
							<td> <button type="button" onClick="deleteAG(this.id)" id="'.$row["ID"].'">X</button>
							</td> <input type="hidden" name="end'.$i.'" value="0xDEADBEEF"/> </tr>';
						$i = $i + 1;
				   }
				?>	  
			</table>
			<input type="submit"/>
		</form>
		<!-- 
		wir öffnen einen neuen Tab, lassen dort die erforderlichen 
		Daten eintragen und laden, wenn der Tab geschlossen wird, neu
		-->
		<button id="adder" onClick="AddAG()">AG hinzuf&uuml;gen</button>
		<script type="text/javascript">
			
			async function sendData() {
				
				const XHR = new XMLHttpRequest();
				// Bind the FormData object and the form element
				const FD = new FormData(form);
				let request = "";
				
				// Define what happens on successful data submission
				XHR.addEventListener("load", (event) => {
				  //alert(event.target.response);
				  let x = 0;
				});

				// was machen wir wenn kaputt?
				XHR.addEventListener("error", (event) => {
				  alert('Etwas ist schiefgelaufen!');
				});

				// Wohin wollen wir senden?
				XHR.open("POST", "saveAGs.php", true);
				XHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				 
				for (const pair of FD.entries()) {
					request += (pair[0] + '=' + pair[1]);
					request += '&';
				}
				
				console.log(request);
				// Wir senden
				XHR.send(request);
				
				return 0;
			 }
			
			const form = document.forms.AGs;
			addEventListener('submit', (event) => {
				event.preventDefault()
				
				const fields = form.elements;
				
				for(var i = 0; i <= (fields.length/19) - 1; i++) {
					console.log("ab: " + fields["ujgstag" + i].value + ", bis: " + fields["ojgstag" + i].value);
					
					//wenn die Untergrenze der Jahrgangsstufe über der Obergrenze liegt, setzten wir die Untergrenze auf die Obergrenze
					if(parseInt(fields["ujgstag" + i].value) > parseInt(fields["ojgstag" + i].value)) {
						fields["ujgstag" + i].value = fields["ojgstag" + i].value;
					}
				}
				
				sendData();
				setTimeout(() => { location.reload();  }, 500);
			});
			
			
				
			deleteAG = (id) => {	
				fetch('deleteAG.php?id=' + id)
					.then((response) => response.text())
					.then((text) => (text === '0') ?
						setTimeout(() => { location.reload();  }, 500)
						: alert('Ein unerwarter Fehler ist aufgetreten!'));
			}
			
			const AddAG = () => {
			const win = window.open('addAG.html');
			const timer = setInterval((win) => {
				if (win.closed) { clearInterval(timer); location.reload(); }
			}, 500, win);};
		</script>
	
	</body>
</html>