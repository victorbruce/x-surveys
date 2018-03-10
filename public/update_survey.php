<?php
    include_once('../includes/survey.php');
    include_once('../includes/category.php');
?>
<?php include_once('../includes/layouts/header.php')?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php 
                    $database = new MySQLDatabase();
                    $survey_id = $database->escape_value($_GET['id']);

                    $survey = new Survey();
                    $res = $survey->find($survey_id);
                    $found_survey = $database->fetch_array($res);
    
                    $category = new Category();
                    $all_categories = $category->read_all();
                ?>
                <h2>Update Survey Info</h2>

                <form method="POST" action="edit_survey.php?id=<?php echo urlencode($found_survey['id'])?>">
                    <div class="form-group">
                        <input class="form-control" type="text" value="<?php echo $found_survey['name']?>" name="survey_name"/>
                    </div>  

                    <div>  
                        <select class="form-control" name="survey_category" type="dropdown">
                            <?php 
                                foreach($all_categories as $category){
                                    echo "<option ";
                                    echo $category['id'] === $found_survey['category_id'] ? 'selected ': ''; 
                                    echo " value='".$category['id']."'>".$category['name']."</option>";
                                }
                            ?>
                        </select>
                    </div>  
                       
                    <input style="margin-top:10px;" type="submit" />
                            
                </form>
            </div>
        </div>
    </div>
<?php include_once('../includes/layouts/footer.php');?>