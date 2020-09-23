<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'departments/view.php'?>">Departments</a><a href="<?=ADMIN_URL.'departments/add.php';?>" class="btn btn-primary pull-right">ADD DEPARTMENT</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Departments</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th>ACTIVE</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('departments'); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=type_count()?></td>
                                            <td><?php 
                                                if (isset($row['department_image'])) {
                                                    echo '<img src="'.WEBSITE_URL.'uploads'.DS.'departments'.DS.$row['department_image'].'" width="100px" height="100px">';
                                                } else {
                                                    'NO Image';
                                                }
                                                ?>
                                            </td>
                                            <td><?=ucfirst($row['department_name'])?></td>
                                            <td><?=$row['department_description']?></td>
                                            <td><?=($row['department_is_active'] == 1) ? 'Active' : 'Not Active';?></td>
                                            <td><a href="<?=ADMIN_URL.'departments/edit.php?department_id='.$row['department_id']?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="<?=ADMIN_URL.'departments/delete.php?department_id='.$row['department_id']?>" class="btn btn-danger">Delete</a></td>
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
<?php require_once INCLUDES."footer_dashboard.php"; ?>