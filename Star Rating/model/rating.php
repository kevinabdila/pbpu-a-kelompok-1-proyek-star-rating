<?php

namespace Phppot;

use PhppotDataSource;

class Rating
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '../lib/dataSource.php';
        $this->ds = new DataSource();
    }

    function getCourse()
    {
        $query = "SELECT * FROM tbl_course ORDER BY id DESC";

        $result = $this->ds->select($query);
        return $result;
    }

    function getUserRating($userId, $courseId)
    {
        $average = 0;
        $avgQuery = "SELECT rating FROM tbl_course_rating WHERE member_id = ? and course_id = ?";
        $paramType = "ii";
        $paramValue = array(
            $userId,
            $courseId
        );
        $result = $this->ds->select($avgQuery, $paramType, $paramValue);
        if ($result > 0) {
            foreach ($result as $row) {
                $average = round($row["rating"]);
            } // endForeach
        } // endIf
        return $average;
    }

    function getTotalRating($courseId)
    {
        $totalVotesQuery = "SELECT * FROM tbl_course_rating WHERE course_id = ?";
        $paramType = "i";
        $paramValue = array(
            $courseId
        );
        $result = $this->ds->getRecordCount($totalVotesQuery, $paramType, $paramValue);
        return $result;
    }

    function isUserRatingExist($userId, $courseId)
    {
        $checkIfExistQuery = "select * from tbl_course_rating where member_id = ? and course_id = ?";
        $userId;
        $courseId;
        $paramType = "ii";
        $paramValue = array(
            $userId,
            $courseId
        );
        $rowCount = $this->ds->getRecordCount($checkIfExistQuery, $paramType, $paramValue);
        return $rowCount;
    }

    function addRating($userId, $courseId, $rating)
    {
        $insertQuery = "INSERT INTO tbl_course_rating(member_id,course_id, rating) VALUES (?,?,?) ";

        $paramType = "iii";
        $paramValue = array(
            $userId,
            $courseId,
            $rating
        );
        $insertId = $this->ds->insert($insertQuery, $paramType, $paramValue);
        return $insertId;
    }
}
