<?php

    include 'design/header.php';
    include_once 'SellingProduct/function.inc.php';
    include_once 'User/account/function.inc.php';
    include_once 'User/account/dbh.inc.php';
    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit;
    }
    $Products = getProducts($conn);
?>


<div class="container" class="bg-image"
  style="
    background-image: url('https://mdbcdn.b-cdn.net/img/Photos/Others/images/76.webp');
    height: 100vh;">
    <h1 class="text-center">Auction <span class="badge bg-secondary ">New</span></h1>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Starting Price</th>
                <th>Buy Out Price</th>
                <th>Current Pay</th>
                <th>Ends Time In</th>
                <th>In Details</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($Products as $product): 
            ?>
            <?php if(checkWheatherEnds($conn, $product['id'])): ?>
                <tr>
                    <td> 
                        <img style="width: 60px" src="<?php echo $product['image_url'] ?>" alt="" >
                    </td>
                    <td><?php echo $product['product_name'] ?></td>
                    <td><?php echo $product['starting_price'] ?></td>
                    <td><?php echo $product['buy_out_price'] ?></td>
                    <td><?php echo $product['current_pay'] ?></td>
                    <td><?php echo showEndsTime($conn, $product['id']) ?></td>
                    <td>
                        <a href ="Details.php?Id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-info"> View</a>
                    </td>
                <tr>
            <?php else: 
                if($product['next_owner_id'] != NULL){
                    buyProduct($conn,$product['next_owner_id'] , $product['id'], $product['product_name'], $product['current_pay'], $product['image_url']);
                    deleteProduct($conn, $product['id']);
                    payup($conn, $product['next_owner_id'], $product['current_pay']);
                    receiveMoney($conn, $product['owner_id'],$product['current_pay']);
                } else {
                    deleteProduct($conn, $product['id']);
                    buyProduct($conn,$product['owner_id'] , $product['id'], $product['product_name'], $product['current_pay'], $product['image_url']);
                }
                endif; ?>
        <?php endforeach; ; ?>
        </tbody>
    </table>
    <p>
        <a class ="btn btn-outline-success" href="ResForSell.php">Register </a>
    </p>
</div>

<?php
    include 'design/footer.php';
?>