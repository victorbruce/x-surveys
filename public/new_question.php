<?php
    include_once('../includes/survey.php');
    include_once('../includes/question.php');
?>
<?php include_once('../includes/layouts/header.php')?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php 
                    //Find the survey associated with this question from the GET variable.
                    $survey = new Survey();
                    $result = $survey->find($_GET['id']);
                    $found_survey = $database->fetch_array($result);

                    $question = new Question();
                    $all_questions = $question->read_all();
                ?>
                <h2>Add Questions</h2>

                <form method="POST" action="create_question.php">
                    <div class="form-group">
                        <input class="form-control" type="text" name="question"/>
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