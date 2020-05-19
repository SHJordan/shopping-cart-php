<?php

session_start();
$connect = new mysqli("localhost", "root", "", "cart");
if (isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if ( ! in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'       => $_GET["id"],
                'item_name'     => $_POST["hidden_name"],
                'item_price'    => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        $item_array = array(
            'item_id'       => $_GET["id"],
            'item_name'     => $_POST["hidden_name"],
            'item_price'    => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"],
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="index.php"</script>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping Cart In PHP and MySQL</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<br/>
<div class="container">
  <br/>
  <br/>
  <br/>
  <h3 style="text-align:center;">Shopping Cart With PHP And MySQL</h3><br/>
  <br/><br/>
    <?php
    $query = "select * from tbl_product order by id";
    $result = $connect->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) { ?>
          <div class="col-md-4">
            <form method="post" action="index.php?action=add&id=<?= $row->id; ?>">
              <div style="border:3px solid #5cb85c; background-color:whitesmoke; border-radius:5px; padding:16px; text-align:center; margin-top: 1.1em;">
                <img alt="Imagem" src="./images/<?= $row->image; ?>" class="img-responsive center-block"/><br/>
                <h4 class="text-info"><?= $row->name; ?></h4>
                <h4 class="text-danger">$ <?= $row->price; ?></h4>
                <input aria-label="Quantidade" type="number" name="quantity" value="1" class="form-control"/>
                <input type="hidden" name="hidden_name" value="<?= $row->name; ?>"/>
                <input type="hidden" name="hidden_price" value="<?= $row->price; ?>"/>
                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart"/>
              </div>
            </form>
          </div>
            <?php
        }
    } ?>
  <div style="clear:both"></div>
  <br/>
  <h3>Order Details</h3>
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th style="width: 40%;">Item Name</th>
        <th style="width: 10%;">Quantity</th>
        <th style="width: 20%;">Price</th>
        <th style="width: 15%;">Total</th>
        <th style="width: 5%;">Action</th>
      </tr>
        <?php
        if ( ! empty($_SESSION["shopping_cart"])) {
            $total = 0;
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                ?>
              <tr>
                <td><?= $values["item_name"]; ?></td>
                <td><?= $values["item_quantity"]; ?></td>
                <td>$ <?= $values["item_price"]; ?></td>
                <td>$ <?= number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                <td>
                  <a href="index.php?action=delete&id=<?= $values["item_id"]; ?>"><span class="text-danger">Remove</span></a>
                </td>
              </tr>
                <?php
                $total += $values["item_quantity"] * $values["item_price"];
            }
            ?>
          <tr>
            <td colspan="3" style="text-align:right;">Total</td>
            <td style="text-align:right;">$ <?= number_format($total, 2); ?></td>
            <td></td>
          </tr>
            <?php
        }
        ?>
    </table>
  </div>
</div>
<br/>
</body>
</html>