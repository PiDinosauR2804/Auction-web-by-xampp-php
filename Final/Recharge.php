<?php
    include 'design/header.php';
    if(!isset($_SESSION['id'])){
      header("Location: index.php");
      exit;
    }
?>

<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
            alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Request Form</h3>

            <form class="px-md-2" action="User/account/RequestMoney.inc.php" method="post">

              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="request" placeholder="Request" name="request">
                <label for="request">Fill the number you want request</label>
              </div>

              <button type="submit" class="btn btn-success btn-lg mb-1" name="submit">Post</button>
              <br>
                <?php if(isset($_GET['error'])):?>
                  <section class="alert alert-primary" role="alert">
                      <?php if($_GET['error'] == "emptyinput"):?>
                        <h3><strong>Fill in all fields!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "invalidNumber"):?>
                        <h3><strong>Invalid Number!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "none"):?>
                        <h3><strong>Successed!</strong></h3>
                      <?php endif?>
                  </section>
                <?php endif ?>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
    include 'design/footer.php';
?>