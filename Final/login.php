<?php 
    include 'design/header.php';
    
?>

<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Login System</h2>
              <form action="/User/account/login.inc.php" method="post">
                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="username" />
                  <label class="form-label" for="form3Example1cg">Your User Name</label>
                </div>
                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="pwd"/>
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>
                <br>

                <?php if(isset($_GET['error'])):?>
                  <section class="alert alert-danger" role="alert">
                      <?php if($_GET['error'] == "emptyinput"):?>
                        <h3><strong>Fill in all fields!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "WrongUsername"):?>
                        <h3><strong>Wrong Username!</strong></h3>
                      <?php endif?>
                      <?php if($_GET['error'] == "WrongPwd"):?>
                        <h3><strong>Wrong Password!</strong></h3>                   
                      <?php endif?>
                  </section>
                <?php endif ?>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have not already an account? <a href="/signup.php"
                    class="fw-bold text-body"><u>Register Here</u></a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
    include 'design/footer.php';
?>