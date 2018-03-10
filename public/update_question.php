<?php
    include_once('../includes/survey.php');
    include_once('../includes/question.php');
?>
<?php include_once('../includes/layouts/header.php')?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php 
                    $database = new MySQLDatabase();
                    $question_id = $database->escape_value($_GET['id']);

                    $question = new Question();
                    $res = $question->find($question_id);
                    $found_question = $database->fetch_array($res);

                    $survey = new Survey();
                    $res = $survey->find($found_question['survey_id']);
                    $found_survey = $database->fetch_array($res);

                ?>
                <h2>Update Question</h2>
                <form method="POST" action="edit_question.php?id=<?php echo urlencode($found_question['id'])?>">
                    <div class="form-group">
                        <input class="form-control" type="text" value="<?php echo $found_question['question']?>" name="question"/>
                    </div>  

                    <div class="form-group">  
                        <input disabled class="form-control" value="<?php echo $found_survey['name']?>" type="text" name="survey_name"/>
                        <input hidden value="<?php echo $found_survey['id']?>" type="text" name="survey_id"/>
                    </div>  
                       
                    <input style="margin-top:10px;" type="submit" />
                            
                </form>
            </div>
        </div>
    </div>
<?php include_once('../includes/layouts/footer.php');?>