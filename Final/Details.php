<?php
    include 'design/header.php';
    include_once 'SellingProduct/function.inc.php';
    include_once 'User/account/dbh.inc.php';
    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit;
    }
    $product = getProductById($_GET['Id'], $conn);
    $productId = $product['id']
?>

<div class='container-fluid'>
        <div class="card mx-auto col-md-3 col-10 mt-5">
            <img class='mx-auto img-thumbnail'
                src="<?php echo $product['image_url']?>"
                width="auto" height="auto"/>
            <div class="card-body text-center mx-auto">
                <div class='cvp'>
                    <h5 class="card-title font-weight-bold"><?php echo $product["product_name"]?></h5>
                    <p class="card-text">Staring Price: <?php echo $product["starting_price"]?></p>
                    <p class="card-text">Buy Out Price: <?php echo $product["buy_out_price"]?></p>
                    <?php if($product["current_pay"] == NULL): ?>
                        <p class="card-text">Be the first one pay</p>
                    <?php else: ?>
                    <p class="card-text">Current Pay: <?php echo $product["current_pay"]?></p>
                    <?php endif; ?>
                    <p class="card-text">Remain: <?php echo showEndsTime($conn, $product['id']) ?></p>
                    <form action="SellingProduct/buy.inc.php?id=<?php echo $productId?>" method="POST">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="CurrentPay" placeholder="CurrentPay" name="CurrentPay">
                            <label for="floatingInputUsername">Select Amount</label>
                        </div>
                        <div class="d-grid mb-2">
                            <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit" name="submit">PAY</button>
                        </div>
                    </form>
                    <?php if(isset($_GET['error'])):?>
                  <section class="alert alert-danger" role="alert">
                      <?php if($_GET['error'] == "emptyinput"):?>
                        <h3><strong>Fill in all fields!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "InvalidPrice"):?>
                        <h3><strong>Invalid Price!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "NotEnough"):?>
                        <h3><strong>Your Wallet Not Enough Money!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "YourInputNotPositive"):?>
                        <h3><strong>Your Input Is Not Positive!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "TooLow"):?>
                        <h3><strong>You Need To Pay Higher!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "none"):?>
                        <h3><strong>Register successed!</strong></h3>
                      <?php endif?>
                  </section>
                <?php endif ?>
                </div>
            </div>
        </div>

    </div>

<?php
    include 'design/footer.php';
?>