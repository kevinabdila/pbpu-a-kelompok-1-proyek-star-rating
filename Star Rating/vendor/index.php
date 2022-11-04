<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Star Rating Script in PHP</title>
    <link href="../assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
    <link href="../assets/css/star-rating-style.css" type="text/css" rel="stylesheet" />
    <script src="../vendor/" type="text/javascript"></script>
</head>

<body>
    <div class="phppot-container">
        <div class="container">
            <h2>Star Rating Script in PHP</h2>
            <div id="course_list">
                <?php require_once "getRatingData.php"; ?>
            </div>
        </div>
    </div>
    <script src="./assets/js/rating.js"></script>
</body>

</html>