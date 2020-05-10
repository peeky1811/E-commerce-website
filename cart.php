<?php
require ("includes/common.php");
//if user is not logged in, go to homepage
if(!isset($_SESSION['email'])){
    header('location:index.php');
}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cart | Life Style Store</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        
        <div class="container-fluid" id="content">
            <?php
        require 'includes/header.php';
        ?>
            <div class="row decor_bg">
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-striped">
                        
                        <!--show table only if there are items added in the cart-->
                        <?php
//                        $_SESSION['user_id']= mysqli_insert_id($con); no need as already this step is done in login_submit.php
                        $user_id=$_SESSION['user_id'];
                        $sum=0;
                        $s_query="SELECT i.id, i.name, i.price FROM users_items ui INNER JOIN items i WHERE i.id=ui.item_id AND ui.user_id='$user_id' AND ui.status='Added to cart'";
                        $res= mysqli_query($con, $s_query) or die(mysqli_error($con));
                        if(mysqli_num_rows($res)==0){
                            echo 'Add items to the cart first!';
                        }
                         else {
                        ?>
                        <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    $sum+= $row["Price"];
                                    $id .= $row["id"] . ", ";
                                    echo "<tr><td>" . "#" . $row["id"] . "</td><td>" . $row["Name"] . "</td><td>Rs " . $row["Price"] . "</td><td><a href='cart-remove.php?id={$row['id']}' class='remove_item_link'> Remove</a></td></tr>";
                                }
                                $id = rtrim($id, ", ");
                                echo "<tr><td></td><td>Total</td><td>Rs " . $sum . "</td><td><a href='success.php?itemsid=" . $id . "' class='btn btn-primary'>Confirm Order</a></td></tr>";
                            }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        require 'includes/footer.php';
        ?>
    </body>
</html>