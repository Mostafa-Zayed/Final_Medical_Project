<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'hours_servicings/view.php'?>">Hours Servicings</a><a href="<?=ADMIN_URL.'hours_servicings/add.php';?>" class="btn btn-primary pull-right">ADD HOUR SERVICING</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Hour Servicings</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>DAY</th>
                                        <th>TIME</th>
                                        <th>ACTIVE</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('hours_servicings'); ?>
                                    <?php //print_r($rows); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=$row['hours_servicing_id']?></td>
                                            <td><?=ucfirst($row['hours_servicing_day'])?></td>
                                            <td><?=ucfirst($row['hours_servicing_time'])?></td>
                                            <td><?=($row['hours_servicing_is_active'] == 1) ? 'Active' : 'Not Active';?></td>
                                            <td><a href="<?=ADMIN_URL.'hours_servicings/edit.php?hours_servicing_id='.$row['hours_servicing_id']?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="<?=ADMIN_URL.'hours_servicings/delete.php?hours_servicing_id='.$row['hours_servicing_id']?>" class="btn btn-danger">Delete</a></td>
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