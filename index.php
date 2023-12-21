<?php 
include 'header.php';
include 'config.php';

 ?>
<head>
    <style>
        /* Style pour le bouton 'Ajouter au panier' */
        .addItemBtn {
            background-color: #2D2D2D; /* Noir */
            color: #ADD8E6;            
            border: none;              
        }
        .addItemBtn:hover {
            background-color: #F5F5F5; 
            color: #2D2D2D;            
        }

        /* Style pour la case de 'Quantity' */
        .row.bg-warning {
            background-color: #ADD8E6 !important; 
        }
    </style>
</head>




  <!-- Affichage des produits début -->
  <div class="jumbotron jumbotron-fluid p-0">
    <img src="image/NBA.png" alt="NFL Image" style="width: 100%; height: auto;">
  </div>

    <div id="message"></div>
    <div class="row mt-2 pb-3">
    <?php 
    $result = mysqli_query($conn, 'SELECT * FROM product');
    while ($row = mysqli_fetch_assoc($result)):
    ?>
        <div class="col-6 col-sm-4 col-md-2-4 col-lg-2-4 col-xl-2 mb-2">
            <div class="card-deck">
                <div class="card p-2 border-secondary mb-2">
                    <img src="<?= $row['product_image'] ?>" class="card-img-top" height="250">
                    <div class="card-body p-1">
                        <h4 class="card-title text-center text-dark"><?= $row['product_name'] ?></h4>
                        <h5 class="card-text text-center text-success"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?>/-</h5>
                    </div>
                    <div class="card-footer p-1 bg-dark">
                        <form action="action.php" method="post">
                            <div class="row p-2 bg-warning">
                                <div class="col-md-6 py-1 pl-4">
                                    <b>Quantité</b>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="pqty" class="form-control" value="1">
                                </div>
                            </div>
                            <input type="hidden" name="action" value="add_to_cart">
                            <input type="hidden" name="pid" value="<?= $row['id'] ?>">
                            <input type="hidden" name="pname" value="<?= $row['product_name'] ?>">
                            <input type="hidden" name="pprice" value="<?= $row['product_price'] ?>">
                            <input type="hidden" name="pimage" value="<?= $row['product_image'] ?>">
                            <input type="hidden" name="pcode" value="<?= $row['product_code'] ?>">
                            <button type="submit" class="btn btn-danger btn-block addItemBtn"><i class="fas fa-shopping-basket"></i>&nbsp;&nbsp;Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
  </div>

  


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    /*$(".addItemBtn").click(function(e) {
      alert("click");
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });*/

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>
