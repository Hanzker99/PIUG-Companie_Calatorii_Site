<?php
	session_start();

	// verifica daca cosul de cumparaturi exista deja in sesiune
	if (!isset($_SESSION['cos'])) {
		$_SESSION['cos'] = array();
	}

	// adauga produsul in cos
	$produs = array(
		'nume' => $_POST['nume'],
		'pret' => $_POST['pret'],
		'cantitate' => $_POST['cantitate']
	);
	array_push($_SESSION['cos'], $produs);

	// redirectioneaza utilizatorul la pagina coșului
	header('Location: cos.php');
	exit();
?>
