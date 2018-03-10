<?php
    session_start();
    include_once('../includes/survey.php');
    include_once('../includes/category.php');
?>
<?php include_once('../includes/layouts/header.php')?>

    <?php
        if (empty($_SESSION['admin_id'])) {
            header('Location: admin/login.php');
            exit;
        }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php 
                    $category = new Category();
                    $all_categories = $category->read_all();
                ?>
                <h2>Create A New Survey</h2>

                <form method="POST" action="create_survey.php">
                    <div class="form-group">
                        <input class="form-control" type="text" name="survey_name"/>
                    </div>  

                    <div>  
                        <select class="form-control" name="survey_category" type="dropdown">
                            <option selected disabled >Choose a category</option>
                            <?php 
                                foreach($all_categories as $category){
                                    echo "<option "; 
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