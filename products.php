<?php
include_once 'header.php';
include_once 'db.php';
?>

<?php 
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT * FROM products WHERE category = '$category'";
} 
elseif (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM products WHERE name = '$search'";
} 
else {
    $sql = "SELECT * FROM products";
}

$productSql = "SELECT * FROM products";
$productSql = $conn->query($productSql);


$categories = array();
$brands = array();
while ($row = $productSql->fetch_assoc()) {
    $categories[] = $row['category'];
    $brands[] = $row['brand'];

}
$categories = array_unique($categories);
$brands = array_unique($brands);

 
 
$result = $conn->query($sql);

?>

<main class="flex-shrink-0">
    <div class="container mt-5">
    <div class="row justify-content-center">
                     <h2 class="mt-5">Products:</h2>
                 </div> 
        <div class="row text-center py-5"> 
            
            <div class="col-md-3">
                <div class="row py-5">
                    <div class="card shadow m-2 p-1">
                        <div class="card-body">
                            <h5 class="card-title">Filter</h5>
                            <p class="card-text"> 
                                <div class="form-group mt-2">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="">All</option>
                                        <?php
                                        if (sizeof($categories) > 0) { 
                                            foreach ($categories as $category) {
                                                echo "<option value='$category'>$category</option>";
                                            }
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="brand">Brand</label>
                                    <select class="form-control" id="brand" name="brand">
                                        <option value="">All</option>
                                        <?php
                                        if (sizeof($brands) > 0) { 
                                            foreach ($brands as $brand) {
                                                echo "<option value='$brand'>$brand</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="price">Price</label>
                                    <select class="form-control" id="price" name="price">
                                        <option value="">All</option>
                                        <option value="0-10">0-10</option>
                                        <option value="10-20">10-20</option>
                                        <option value="20-30">20-30</option>
                                        <option value="30-40">30-40</option>
                                        <option value="40-50">40-50</option>
                                    </select>
                                </div> 
                            </p>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-9 row" id="productContainer">
            <?php
            if ($result->num_rows > 0) { 
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3">
                        <div class="card shadow m-2 p-1">
                            <img class="card-img-top" src="<?php echo $row['image']; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text productBrand"><?php echo $row['brand']; ?></p>
                                <p class="card-text productCategory"><?php echo $row['category']; ?></p>

                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text">£
                                    <span class="productPrice">
                                        <?php echo $row['price']; ?>
                                    </span> 
                                </p>
                                <a href="addtocart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "nothing to show";
            }
            ?> 

            </div>      

    </div>
</main>

<?php
include_once 'footer.php';
?>

