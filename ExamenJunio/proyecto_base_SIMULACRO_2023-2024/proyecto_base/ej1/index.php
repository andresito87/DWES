<?php
$videojuegos = array(
	array("titulo" => "Animal Crossing: New Horizons", "desarrollador" => "Nintendo", "anio_publicacion" => 2020),
	array("titulo" => "Assassin's Creed", "anio_publicacion" => "2007", "desarrollador" => "Patrice Désilets"),
	array("titulo" => "BioShock", "anio_publicacion" => "2007", "desarrollador" => "Ken Levine"),
	array("titulo" => "Call of Duty", "anio_publicacion" => "2003", "desarrollador" => "Infinity Ward"),
	array("titulo" => "Dark Souls", "anio_publicacion" => "2011", "desarrollador" => "Hidetaka Miyazaki"),
	array("titulo" => "Elder Scrolls V: Skyrim", "anio_publicacion" => "2011", "desarrollador" => "Todd Howard"),
	array("titulo" => "Fallout 4", "anio_publicacion" => "2015", "desarrollador" => "Todd Howard"),
	array("titulo" => "Grand Theft Auto V", "anio_publicacion" => "2013", "desarrollador" => "Rockstar North"),
	array("titulo" => "Halo: Combat Evolved", "anio_publicacion" => "2001", "desarrollador" => "Bungie"),
	array("titulo" => "Mario Kart 8 Deluxe", "desarrollador" => "Nintendo", "anio_publicacion" => 2017),
	array("titulo" => "Mario Party Superstars", "desarrollador" => "Nintendo", "anio_publicacion" => 2021),
	array("titulo" => "Metroid Dread", "desarrollador" => "Nintendo", "anio_publicacion" => 2021),
	array("titulo" => "Minecraft", "anio_publicacion" => "2011", "desarrollador" => "Markus Persson"),
	array("titulo" => "Pokemon Sword and Shield", "desarrollador" => "Nintendo", "anio_publicacion" => 2019),
	array("titulo" => "Pokémon Brilliant Diamond and Shining Pearl", "desarrollador" => "Nintendo", "anio_publicacion" => 2021),
	array("titulo" => "Portal", "anio_publicacion" => "2007", "desarrollador" => "Valve Corporation"),
	array("titulo" => "Splatoon 2", "desarrollador" => "Nintendo", "anio_publicacion" => 2017),
	array("titulo" => "Super Mario 3D World + Bowser's Fury", "desarrollador" => "Nintendo", "anio_publicacion" => 2021),
	array("titulo" => "Super Mario Odyssey", "desarrollador" => "Nintendo", "anio_publicacion" => 2017),
	array("titulo" => "Super Smash Bros. Ultimate", "desarrollador" => "Nintendo", "anio_publicacion" => 2018),
	array("titulo" => "The Legend of Zelda: Breath of the Wild", "desarrollador" => "Nintendo", "anio_publicacion" => 2017),
	array("titulo" => "The Legend of Zelda: Link's Awakening", "desarrollador" => "Nintendo", "anio_publicacion" => 2019),
	array("titulo" => "The Legend of Zelda: Skyward Sword HD", "desarrollador" => "Nintendo", "anio_publicacion" => 2021)
);


?>
<!DOCTYPE html>
<html>

<head>
	<title>Filtrar videojuegos por iniciales</title>
</head>

<body>
	<h1>Videojuegos por inicial</h2>
		<form method="post" action="./">
			<h2>Elige las iniciales para filtrar:</h2>
			<?php foreach (range('A', 'Z') as $letra) : ?>
				<input type="checkbox" name="letra[]" value="<?= $letra ?>"> <?= $letra ?>
			<?php endforeach ?>
			<br><br>
			<?php //Completa aquí con los atributos que consideres ?>
			<input type="submit" value="Filtrar">
			<a href="index.php">Reiniciar</a>
		</form>
		<br>

		<table>
			<thead>
				<tr>
					<th>Titulo</th>
					<th>Año publicación</th>
					<th>Desarrollador</th>
				</tr>
			</thead>
			<tbody>
				<?php

				//Aquí la lógica para mostrar/filtrar la tabla de videojuegos
				if (isset($_POST['letra']) && ! empty($_POST['letra'])) {
					foreach ($videojuegos as $videojuego) {
						if (in_array(strtoupper($videojuego['titulo'][0]), $_POST['letra'])) { ?>
							<tr>
								<td><?= $videojuego['titulo'] ?></td>
								<td><?= $videojuego['anio_publicacion'] ?></td>
								<td><?= $videojuego['desarrollador'] ?></td>
							</tr>
							<?php
						}
					}
				} else {
					foreach ($videojuegos as $videojuego) {
						?>
						<tr>
							<td><?= $videojuego['titulo'] ?></td>
							<td><?= $videojuego['anio_publicacion'] ?></td>
							<td><?= $videojuego['desarrollador'] ?></td>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
</body>

</html>