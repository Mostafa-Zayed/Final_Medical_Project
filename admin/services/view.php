<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'services/view.php'?>">Services</a><a href="<?=ADMIN_URL.'services/add.php';?>" class="btn btn-primary pull-right">ADD SERVICE</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div id="message"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Services</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>TYPE</th>
                                        <th>ACTIVE</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('services'); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=type_count()?></td>
                                            <td><?php
                                                if (! empty($row['service_image'])) {
                                                    echo '<img src="'.WEBSITE_URL.'uploads'.DS.'services'.DS.$row['service_image'].'" width="100px" height="100px">';
                                                } else {
                                                    echo 'NO Image';
                                                }
                                                ?>
                                            </td>
                                            <td><?=ucfirst($row['service_name'])?></td>
                                            <td><?=$row['service_type_id']?></td>
                                            <td><?=($row['service_is_active'] == 1) ? 'Active' : 'Not Active';?></td>
                                            <td><a href="<?=ADMIN_URL.'services/edit.php?service_id='.$row['service_id']?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="<?=ADMIN_URL.'services/delete.php?service_id='.$row['service_id']?>" class="btn btn-danger">Delete</a></td>
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