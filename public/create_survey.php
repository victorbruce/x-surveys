<?php 
require_once('../includes/database.php');
require_once('../includes/survey.php');
// require_once('../includes/session.php');
// require_once('../includes/functions.php');




 $found_survey = Survey::find_by_id(1);
 echo $found_survey['name'];
?>


<br><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    Create Surveys
    <form method="POST" action="create_survey.php">
        Name: <input type="text" name="survey_name">
        No_Questions: <input type="text" name="no_questions">
        Category: <input type="text" name="category">
        <input type="submit" value="Create" name="submit"/>
    </form>
</body>
