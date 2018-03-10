<?php
    session_start();
    include_once('../includes/survey.php');
?>
<?php include_once('../includes/layouts/header.php');?>

    <?php
        if (empty($_SESSION['admin_id'])) {
            header('Location: admin/login.php');
            exit;
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> Welcome 
                    <?php echo $_SESSION['username']; ?>
                </h1>
            </div>

            <div class="col-md-3" id="dashboard-menu">
                <ul class="list-style-none">
                    <h4 id="grey-header">Operations</h4>
                    <li> <a href="new_survey.php">Create Survey</a> </li>
                    <li> <a href="admin/logout.php">Logout</a> </li>
                </ul>
            </div><!--/Dashboard Menu -->

            <div class="col-md-8" id="dashboard-menu-view">
                <h4 id="grey-header">All Surveys</h4>
                <?php 
                    //Create a database connection object
                    $database = new MySQLDatabase();

                    $survey = new Survey();
                    $all_surveys = $survey->read_all();

                    //Headings
                    echo "<table class='table table-condensed'> 
                    <tr> 
                        <strong><td>Name</td></strong> 
                        <strong><td>Operations</td></strong> 
                    </tr>";
                    
                    if( $database->num_rows($all_surveys) > 0 ){
                        foreach($all_surveys as $survey)
                            echo "<tr>
                                <td>".$survey['name']."</td>
                                <td><a href='update_survey.php?id=".urlencode($survey['id'])."'>Edit</a></td> 
                                <td><a href='delete_survey.php?id=".urlencode($survey['id'])."'>Delete</a></td>
                            <tr>";
                    }
                    echo "</table>";
                ?>
            </div>
        </div>
    </div>
<?php include_once('../includes/layouts/footer.php');?>