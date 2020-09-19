<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'doctors/view.php'?>">Doctors</a><a href="<?=ADMIN_URL.'doctors/add.php';?>" class="btn btn-primary pull-right">ADD DOCTOR</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Doctors</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>DEPARTMENT</th>
                                        <th>PHONE</th>
                                        <th>SHOW</th>
                                        <th>DETAILS</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('doctors'); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=$row['doctor_id']?></td>
                                            <td><?php 
                                            if (isset($row['doctor_image'])) {
                                                echo '<img src="'.WEBSITE_URL.'uploads'.DS.'doctors'.DS.$row['doctor_image'].'" width="100px" height="100px">';
                                                } else {
                                                    'NO Image';
                                                }
                                            ?>
                                        </td>
                                            <td><?=ucfirst($row['doctor_name'])?></td>
                                            <td>
                                            <?php
                                                $data =  get_data('departments','where `department_id` = '.$row['department_id'],'name');
                                                echo $data[0]['department_name'];
                                            ?>
                                            </td>
                                            <td><?=$row['doctor_phone']?></td>
                                            <td><?=($row['doctor_is_show'] == 1) ? 'Show' : 'Not Show';?></td>
                                            <td><a href="<?=ADMIN_URL.'doctors/details.php?doctor_id='.$row['doctor_id']?>" class="btn btn-primary">Details</a></td>
                                            <td><a href="<?=ADMIN_URL.'doctors/edit.php?doctor_id='.$row['doctor_id']?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="<?=ADMIN_URL.'doctors/delete.php?doctor_id='.$row['doctor_id']?>" class="btn btn-danger">Delete</a></td>
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