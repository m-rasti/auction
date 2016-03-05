<?php
include 'nav.php';
if (isset($_GET['sort'])) {
    $name = $_GET['search-name'];
    $category = $_GET['search-category'];
    $sort = $_GET['sort'];
    if (isset($_GET['search-name'])) {
        if ($category != 0) {
            if ($sort == 1) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
                        FROM Auction A, Item I WHERE I.label LIKE :search AND I.category_id = :category
                        ORDER BY A.end_time ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
            }
            else if ($sort == 2) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
                        FROM Auction A, Item I WHERE I.label LIKE :search AND I.category_id = :category
                        ORDER BY A.end_time DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
            }
            else if ($sort == 3) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
                        FROM Auction A, Item I WHERE I.label LIKE :search AND I.category_id = :category
                        ORDER BY A.current_bid ASC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
            }
            else if ($sort == 4) {
                $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
                        FROM Auction A, Item I WHERE I.label LIKE :search AND I.category_id = :category
                        ORDER BY A.current_bid DESC';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $name . '%');
                $stmt->bindParam(':category', $category);
            }
        }
        else if ($sort == 1) {
            $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
            FROM Auction A, Item I WHERE I.label LIKE :search ORDER BY A.end_time ASC';
            $stmt = $db ->prepare($sql);
            $stmt->bindValue(':search','%'.$name.'%');
        }
        else if ($sort == 2) {
            $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
            FROM Auction A, Item I WHERE I.label LIKE :search ORDER BY A.end_time DESC';
            $stmt = $db ->prepare($sql);
            $stmt->bindValue(':search','%'.$name.'%');
        }
        else if ($sort == 3) {
            $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
            FROM Auction A, Item I WHERE I.label LIKE :search ORDER BY A.current_bid ASC';
            $stmt = $db ->prepare($sql);
            $stmt->bindValue(':search','%'.$name.'%');
        }
        else if ($sort == 4) {
            $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
            FROM Auction A, Item I WHERE I.label LIKE :search ORDER BY A.current_bid DESC';
            $stmt = $db ->prepare($sql);
            $stmt->bindValue(':search','%'.$name.'%');
        }
    }
    else if ($category != 0) {
        if ($sort == 1) {
            $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
                FROM Auction A, Item I WHERE I.category_id = :category
                ORDER BY A.end_time ASC';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':category', $category);
        } else if ($sort == 2) {
            $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
                FROM Auction A, Item I WHERE I.category_id = :category
                ORDER BY A.end_time DESC';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':category', $category);
        } else if ($sort == 3) {
            $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
                FROM Auction A, Item I WHERE I.category_id = :category
                ORDER BY A.current_bid ASC';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':category', $category);
        } else if ($sort == 4) {
            $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
                FROM Auction A, Item I WHERE I.category_id = :category
                ORDER BY A.current_bid DESC';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':category', $category);
        }
    }
    else {
        $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
            FROM Auction A, Item I ORDER BY A.end_time ASC';
    }
    $stmt->execute();
    $result = $stmt -> fetchAll();
    $currentLink = 'listings2.php?search-name='.$name.'&search-category='.$category;
}
else {
    $sql = 'SELECT A.current_bid, A.end_time, A.viewings, I.label, I.description
            FROM Auction A, Item I ORDER BY A.end_time ASC';
    $stmt = $db ->prepare($sql);
    $stmt -> execute();
    $result = $stmt -> fetchAll();
    $currentLink = 'listings2.php?search-name=&search-category=0';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Listings</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- Bootstrap Core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>

    <div class="col-md-6 col-md-offset-3 text-center">
        <div class="btn-group btn-group-justified" role="group">
            <a href="<?php echo $currentLink.'&sort=1'?>" class="btn btn-primary" role="button">Lowest Time Remaining</a>
            <a href="<?php echo $currentLink.'&sort=2'?>" class="btn btn-primary" role="button">Highest Time Remaining</a>
            <a href="<?php echo $currentLink.'&sort=3'?>" class="btn btn-primary" role="button">Lowest Bid</a>
            <a href="<?php echo $currentLink.'&sort=4'?>" class="btn btn-primary" role="button">Highest Bid</a>
        </div>
    </div>

    <div class="col-md-12" style="padding-top:20px">
        <?php
        foreach ($result as $item) { ?>
        <div id="auction" class="col-md-2">
            <div class="thumbnail">
                <img src="http://placehold.it/320x150" alt="">
                <div class="caption">
                    <h4 class="pull-right"><?php echo $item['current_bid']; ?></h4>
                    <h4><a href="productpage.html"><?php echo $item['label']; ?></a></h4>
                    <p><?php echo $item['description']; ?></p>
                </div>
                <div class="row viewings">
                    <div class="col-md-6"><?php echo $item['viewings']; ?></div>
                    <div class="col-md-6 text-right"><?php echo $item['end_time']; ?></div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</body>

</html>