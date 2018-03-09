<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    Create Survey
    <form method="POST" action="create_survey.php">
        Name: <input type="text" name="survey_name">
        No_Questions: <input type="text" name="no_questions">
        Category: <input type="text" name="category">
        <input type="submit" value="Create" name="submit"/>
    </form>

    Edit Survey
    <form method="POST" action="edit_survey.php">
    Name:<input type="text" name="survey_name">
    No_Questions:   <input type="text" name="no_questions">
        <input type="text" name="category">
        <input type="submit" value="Save" name="submit"/>
    </form>

    Delete Survey
    <form method="POST" action="delete_survey.php">
    Name: <input type="text" name="survey_name">
    No_Questions    <input type="text" name="no_questions">
        <input type="text" name="category">
        <input type="submit" value="Delete" name="submit"/>
    </form>


</body>
</html>