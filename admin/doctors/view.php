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
                                        <td><?=(isset($row['doctor_image']))? $row['doctor_image'] : 'No Image';?></td>
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
                                    <?php //print_r($rows); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=$row['doctor_id']?></td>
                                            <td><?=(isset($row['doctor_image']))? $row['doctor_image'] : 'No Image';?></td>
                                            <td><?=ucfirst($row['doctor_name'])?></td>
                                            <td><?='department';?></td>
                                            <td><?=($row['doctor_is_show'] == 1) ? 'Show' : 'Not Show';?></td>
                                            <td><?=$row['doctor_phone']?></td>
                                            <td><a href="#" class="btn btn-primary">Details</a></td>
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
<?php require_once INCLUDES."footer_dashboard.php"; ?>