<?php
    include 'design/header.php';
    include_once 'SellingProduct/function.inc.php';
    include_once 'User/account/dbh.inc.php';
    include_once 'User/account/function.inc.php';
    
    if(!isset($_SESSION['id'])){
      header("Location: index.php");
      exit;
    }
    $User = getUserById($conn,$_SESSION['id']);
    $Wallet = getWaller($_SESSION['id'], $conn);
?>

<section class="vh-100" style="background-color: #9de2ff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-md-9 col-lg-7 col-xl-5">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex text-black">
              <div class="flex-shrink-0">
                <img src="https://cdn-icons-png.flaticon.com/512/4128/4128176.png"
                  alt="Generic placeholder image" class="img-fluid"
                  style="width: 180px; border-radius: 10px;">
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1"><?php echo $User['user_name'] ?></h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;"><?php echo $User['username'] ?></p>
                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                  style="background-color: #efefef;">
                  <div>
                    <p class="small text-muted mb-1">ID</p>
                    <p class="mb-0"><?php echo $User['id'] ?></p>
                  </div>
                  <div class="px-3">
                    <p class="small text-muted mb-1">EMAIL</p>
                    <p class="mb-0"><?php echo $User['email'] ?></p>
                  </div>
                </div>
                <div class="d-flex pt-1">
                  <p class="btn btn-outline-primary me-1 flex-grow-1">$<?php echo $Wallet['wallet'] ?></p>
                </div>
              </div>
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