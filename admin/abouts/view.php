<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
    <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'abouts/view'?>">Abouts</a><a href="<?=ADMIN_URL.'abouts/add';?>" class="btn btn-primary pull-right">ADD ABOUT</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Abouts</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>HEADING</th>
                                        <th>ACTIVE</th>
                                        <th>SHOW</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('abouts'); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=type_count()?></td>
                                            <td><?php 
                                            if (isset($row['about_image'])) {
                                                echo '<img src="'.WEBSITE_URL.'uploads'.DS.'abouts'.DS.$row['about_image'].'" width="100px" height="100px">';
                                                } else {
                                                    echo 'NO Image';
                                                }
                                            ?>
                                            </td>
                                            <td><?=$row['about_heading']?></td>
                                            <td><?=($row['about_is_active'] == 1) ? 'Active' : 'Not Active';?></td>
                                            <td><a href="#">Details</a></td>
                                            <td><a href="#" class="btn btn-primary">Edit</a></td>
                                            <td><a href="#" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
<?php require_once ADMIN_INCLUDES."footer.php"; ?>