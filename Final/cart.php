<?php

    include 'design/header.php';
    include_once 'SellingProduct/function.inc.php';
    include_once 'User/account/dbh.inc.php';
    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit;
    }
    $Products = getProductsByOwnerId($conn, $_SESSION['id']);
    $num = count($Products);
?>

<div class="container" class="bg-image"
  style="
    background-image: url('https://mdbcdn.b-cdn.net/img/Photos/Others/images/76.webp');
    height: 100vh;">
    <h1 class="text-center">My Cart</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Pay Value</th>
                <th>Post to auction</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($Products as $product): ?>
            <tr>
                <td> 
                    <img style="width: 60px" src="<?php echo $product['image_url'] ?>" alt="" >
                </td>
                <td><?php echo $product['product_name'] ?></td>
                <td><?php echo $product['pay_value'] ?></td>
                <td>
                    <a href ="ResForSellFromCart.php?ProductId=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-info"> Post</a>
                </td>
            <tr>
        <?php endforeach; ; ?>
        </tbody>
    </table>
</div>

<?php
    include 'design/footer.php';
?>