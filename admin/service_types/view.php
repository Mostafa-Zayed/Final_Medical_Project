<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'service_types/view.php'?>">Service Types</a><a href="<?=ADMIN_URL.'service_types/add.php';?>" class="btn btn-primary pull-right">ADD SERVICE TYPE</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Service Type</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>ACTIVE</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('service_types'); ?>
                                    <?php //print_r($rows); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=$row['service_type_id']?></td>
                                            <td><?=ucfirst($row['service_type_name'])?></td>
                                            <td><?=($row['service_type_is_active'] == 1) ? 'Active' : 'Not Active';?></td>
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