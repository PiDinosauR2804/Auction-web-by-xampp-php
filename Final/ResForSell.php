<?php 
    include 'design/header.php';
    if(!isset($_SESSION['id'])){
      header("Location: index.php");
      exit;
    }
?>
<style>
    .card-img-left {
      width: 45%;
      /* Link to your background image using in the property below! */
      background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512');
      background-size: cover;
    }
</style>
<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5"><strong>Register For Selling Art</strong></h5>
            <form action="SellingProduct/ResForSell.inc.php" method="POST">

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                <label for="floatingInputUsername">Name</label>
              </div>

              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="StartingPrice" placeholder="Starting Price" name="StartingPrice">
                <label for="floatingInputEmail">Starting Price (USD)</label>
              </div>

              <hr>

              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="BuyOutPrice" placeholder="Buy Out Price" name="BuyOutPrice">
                <label for="floatingPassword">Buy Out Price (USD)</label>
              </div>

              <div class="form-floating mb-3">
                <input type="datetime-local" class="form-control" id="EndsTime" placeholder="Ends Time Ex: 2023-08-10 15:30:00" name="EndsTime">
                <label for="dateTimeWithSeconds">Ends Time Ex: 2023-08-10 15:30:00</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="URLImage" placeholder="URL Image" name="URLImage">
                <label for="floatingPasswordConfirm">URL Image</label>
              </div>

              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit" name="submit">POST</button>
              </div>

              <hr class="my-4">
              
            </form>
            <?php if(isset($_GET['error'])):?>
                  <section class="alert alert-danger" role="alert">
                      <?php if($_GET['error'] == "emptyinput"):?>
                        <h3><strong>Fill in all fields!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "InvalidPrice"):?>
                        <h3><strong>Invalid Price!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "InvalidEndsTime"):?>
                        <h3><strong>Invalid EndsTime!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "YourInputNotPositive"):?>
                        <h3><strong>Your Input Is Not Positive!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "NameExist"):?>
                        <h3><strong>Product's Name Exist, please choose another!</strong></h3>
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
</div>


<?php 
    include 'design/footer.php';
?>