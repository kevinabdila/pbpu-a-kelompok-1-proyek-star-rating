<?php
namespace Phppot;

use PhppotRating;
require_once __DIR__ . "../model/rating.php";
$rating = new Rating();
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
$userId = 5;

if (isset($_POST["index"], $_POST["course_id"])) {
    
    $courseId = $_POST["course_id"];
    $ratingIndex = $_POST["index"];
    
    $rowCount = $rating->isUserRatingExist($userId, $courseId);
    
    if ($rowCount == 0) {
        $insertId = $rating->addRating($userId, $courseId, $ratingIndex);
        if (empty($insertId)) {
            echo "Problem in adding ratings.";
        }
    } else {
        echo "You have added rating already.";
    }
}