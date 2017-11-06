<?php session_start(); ?>
<!DOCTYPE html>
	<html>
		<head>
			<title> Pintar matriz</title>
		</head>
		  <style type="text/css">
		  table{
		  		margin:0 auto;
		  	}
		  	td{
		  		width: 55px;
		  		height: 55px;
		  		border:1px solid black;
		  		text-align: center;
		  	}
			.fil{
				background-color: black;
			}
			.col{
				background-color: white;
			}
			#imagen{
				width: 55px;
		  		height: 55px;
			}
		</style>
		<body>
			<a href="destroy.php">Reiniciar Sesión</a>	
			<br>
			<form style="text-align:center;" method="POST" action="ajedrez.php">
				<label>Escribe la posicion</label>
				<input type="text" name="posicion"/>
				<input type="submit">
			</form>
			<br>
			<table>
				<?php 				
					if(!isset($_SESSION['rei_n']) != "" ){ //si no hay nada
						$posicion = 'D0'; //doy primera posicion
						$_SESSION['rei_n'] = $posicion;
						$inicio = 1;
					}else{	
							$rei = $_SESSION['rei_n'];							
							$vieja = ord($rei);							
							$posicion = strtoupper($_POST["posicion"]);
							$_SESSION['rei_n'] = $posicion;	
							$nueva = ord($posicion);
							$inicio = 0;	
							
							//compruebo que no este en la misma posicion
							if (($nueva == $vieja)&&($rei[1] == $posicion[1])) {
								echo '<script language="javascript">alert("Estas en la misma posicion");</script>';
							}
							if(($nueva <= $vieja-2) || ($nueva >= $vieja+2)||( $posicion[1] > $rei[1]+1)||( $posicion[1] < $rei[1]-1)){
								$posicion = $rei;
								$_SESSION['rei_n'] = $rei;
								echo '<script language="javascript">alert("NO se puede realizar este movimiento.");</script>';
								
							}
							if(($posicion[1] > 8)||($nueva > 72)){ // para que no se salga del tablero
								$_SESSION['rei_n'] = $rei;
								echo '<script language="javascript">alert("NO se puede, debes volver hacia atrás.");</script>';
							}
						}
						$fil =  7;
						$col =  7;	

						for ($x = 0; $x <= $fil+1; $x++) {						
							echo "<tr>"; 		
										
							for ($y = 0; $y <= $col+1; $y++) {
								if($y == 0){
									$codigo = chr(64+$x);
									echo "<td>$codigo</td>"; //linea de letras
								}
								if($x == 0){
									echo "<td>$y</td>"; // primera linea de numeros
								}
								else {	
									if(($x+$y) %2 == 0){	
										if($inicio == 1) {							
											echo "<td id='$codigo.$y' class='col'>";
												if (($codigo =='D') && ($y == 0)) {
													echo "<image id='imagen' src='rei.png'/>";
												}											
											echo"</td>"; //blanco
										}
										elseif($inicio == 0) {							
											echo "<td id='$codigo.$y' class='col'>";
												if (($codigo == $posicion[0]) && ($y == $posicion[1])) {
													echo "<image style='background-color:white;' id='imagen' src='rei.png'/>";
												}
												
											echo"</td>"; //blanco
										}
									}
									else{
										echo "<td id='$codigo.$y'  class='fil'>";
										if (($codigo == $posicion[0]) && ($y == $posicion[1])) {
													echo "<image style='background-color:white;' id='imagen' src='rei.png'/>";
												}
										echo "</td>"; //negro
									}									
								}														
							}
							echo "</tr>";
						}
					?>
			</table>					
		</body>
</html>
