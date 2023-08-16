<?php
    include 'design/header.php';
    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit;
    }
    require_once 'User/account/dbh.inc.php';
    require_once 'User/account/function.inc.php';
    $requests = getRequest($conn);
    $num = mysqli_num_rows($requests);
?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <?php if($num>0): ?>
                <?php foreach($requests as $request): ?>
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="https://cdn.pixabay.com/photo/2022/11/08/14/59/money-7578738_1280.jpg"></div>
                        <div class="col-md-6 mt-1">
                            <h5>Request From User: <?php echo $request['username']?></h5>
                            <div class="d-flex flex-row">
                                <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                            </div>
                        </div>
                        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1">$ <?php echo $request['request'] ?></h4>
                            </div>
                            <form action="User/account/decide.inc.php?id=<?php echo $request['user_id'] ?>" method="post">
                                <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="submit" name="submit" value="accept">Accept</button></div>
                                <div class="d-flex flex-column mt-3 "><button class="btn btn-primary btn-sm" type="submit" name="submit" value="denied">Delete</button></div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="row p-2 bg-white border rounded ">
                        <div class="col-md-6 mt-1">
                            <h5>There is no request</h5>
                        </div>
                    </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include 'design/footer.php';
?>