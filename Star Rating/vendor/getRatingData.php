<?php

namespace Phppot;

use PhppotRating;

require_once "../common/config.php";
$config = new Config();
require_once "../model/rating.php";
$rating = new Rating();
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
$userId = 5;

$apperance = $config::RATING_APPEARANCE;

$courseResult = $rating->getCourse();
if (!empty($courseResult)) {
    foreach ($courseResult as $row) {
        $userRating = $rating->getUserRating($userId, $row['id']);
        $totalRating = $rating->getTotalRating($row['id']);
       
?>
        <div class="row-item">
            <div class="row-title"><?php echo $row['name']; ?></div>
            <ul class="list-inline" id="list-<?php echo $row['id']; ?>">
                <?php require $apperance . "-rating-view.php"; ?>

                <img src="https://phppot.com/php/jquery-star-rating-script-using-php-and-mysql-with-ajax/img/loader.gif" class="loader-icon" id="loader-icon">
            </ul>
            <div class="response" id="response-<?php echo $row['id']; ?>"></div>


            <p class="review-note">Total Reviews: <?php echo $totalRating; ?></p>
           
        </div>
<?php
    }
}
?>