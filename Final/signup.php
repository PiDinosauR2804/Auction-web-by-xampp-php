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
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form action="/User/account/signup.inc.php" method="post">

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" />
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="username" />
                  <label class="form-label" for="form3Example1cg">Your User Name</label>
  
                  <?php if(isset($_GET['error']) && $_GET['error'] == "UsernameExisted"):?>
                    <section class="alert alert-danger" role="alert">
                      <h3><strong>Username existed, please choose another!</strong></h3>
                    </section>
                  <?php endif?>
                  <?php if(isset($_GET['error']) && $_GET['error'] == "invalidUsername"):?>
                    <section class="alert alert-danger" role="alert">
                      <h3><strong>Invalid Username!</strong></h3>
                    </section>
                  <?php endif?>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" />
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <?php if(isset($_GET['error']) && $_GET['error'] == "invalidEmail"):?>
                    <section class="alert alert-danger" role="alert">
                      <h3><strong>Invalid Email!</strong></h3>
                    </section>
                  <?php endif?>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="pwd"/>
                  <label class="form-label" for="form3Example4cg">Password</label>
                  <?php if(isset($_GET['error']) && $_GET['error'] == "invalidPassword"):?>
                    <section class="alert alert-danger" role="alert">
                        <h3><strong>Invalid Password, at least 8 characters and 1 uppercase character!</strong></h3>
                    </section>
                  <?php endif?>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="rptpwd"/>
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>                  
                  <?php if(isset($_GET['error']) && $_GET['error'] == "PwdUnmatch"):?>
                    <section class="alert alert-danger" role="alert">
                      <h3><strong>Password Unmatch!</strong></h3>
                    </section>
                  <?php endif?>
                </div>

                <br>
                <?php if(isset($_GET['error']) && $_GET['error'] == "emptyinput"):?>
                  <section class="alert alert-danger" role="alert">
                    <h3><strong>Fill in all fields!</strong></h3>
                  </section>
                <?php endif ?>
                <?php if(isset($_GET['error']) && $_GET['error'] == "none"):?>
                  <section class="alert alert-primary" role="alert">
                    <h3><strong>Register successed!</strong></h3>
                  </section>
                <?php endif ?>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="/login.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

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