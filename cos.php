<?php
  session_start();

  // Verificăm dacă utilizatorul a adăugat un produs în coș
  if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    // Adăugăm produsul în coșul de cumpărături
    $_SESSION['cart'][$product_id] = [
      'name' => $product_name,
      'price' => $product_price,
      'quantity' => $product_quantity
    ];
  }

  // Verificăm dacă utilizatorul a eliminat un produs din coș
  if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Cos de cumparaturi</title>
</head>
<body>

  <h1>Cos de cumparaturi</h1>

  <table>
    <thead>
      <tr>
        <th>Nume produs</th>
        <th>Pret</th>
        <th>Cantitate</th>
        <th>Total</th>
        <th>Elimina</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Afisam produsele din cos
        $total_price = 0;
        foreach ($_SESSION['cart'] as $product_id => $product) {
          $product_name = $product['name'];
          $product_price = $product['price'];
          $product_quantity = $product['quantity'];
          $product_total = $product_price * $product_quantity;
          $total_price += $product_total;
          echo "<tr>";
          echo "<td>$product_name</td>";
          echo "<td>$product_price</td>";
          echo "<td>$product_quantity</td>";
          echo "<td>$product_total</td>";
          echo "<td><form method='post'><input type='hidden' name='product_id' value='$product_id'><input type='submit' name='remove_from_cart' value='Elimina'></form></td>";
          echo "</tr>";
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3">Total:</td>
        <td><?php echo $total_price; ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>

  <h2>Adauga in cos</h2>

  <form method="post">
    <label for="product_name">Nume produs
	<ul>
	<?php foreach ($cosCumparaturi->produse as $idPachet) { ?>
		<li>
			<h3>Nume pachet: <?php echo $pacheteTuristice[$idPachet]->nume; ?></h3>
			<p>Preț: <?php echo $pacheteTuristice[$idPachet]->pret; ?> RON</p>
			<form method="post" action="cos.php?action=actualizare">
				<input type="hidden" name="id_pachet" value="<?php echo $idPachet; ?>">
				<label for="cantitate_<?php echo $idPachet; ?>">Cantitate:</label>
				<input type="number" id="cantitate_<?php echo $idPachet; ?>" name="cantitate" value="<?php echo $cosCumparaturi->cantitati[$idPachet]; ?>">
				<button type="submit">Actualizează</button>
			</form>
			<form method="post" action="cos.php?action=eliminare">
				<input type="hidden" name="id_pachet" value="<?php echo $idPachet; ?>">
				<button type="submit">Elimină</button>
			</form>
		</li>
	<?php } ?>
</ul>
<p>Total: <?php echo $cosCumparaturi->total; ?> RON</p>
<form method="post" action="cos.php?action=golire">
	<button type="submit">Golește coșul</button>
</form>
<form method="post" action="cos.php?action=finalizare">
	<label for="nume">Nume:</label>
	<input type="text" id="nume" name="nume" required>
	<label for="adresa">Adresă:</label>
	<input type="text" id="adresa" name="adresa" required>
	<label for="telefon">Telefon:</label>
	<input type="tel" id="telefon" name="telefon" required>
	<label for="email">Email:</label>
	<input type="email" id="email" name="email" required>
	<button type="submit">Finalizează comanda</button>
</form>
</body>
</html>
