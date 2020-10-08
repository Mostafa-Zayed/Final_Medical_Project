<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.'offers/view'?>">Offers</a><a href="<?=ADMIN_URL.'offers/add.php';?>" class="btn btn-primary pull-right">ADD OFFER &nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Cities</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>ACTIVE</th>
                                        <th>STATE</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('cities'); ?>
                                    <?php //print_r($rows); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=$row['city_id']?></td>
                                            <td><?=ucfirst($row['city_name'])?></td>
                                            <td><?=($row['city_is_active'] == 1) ? 'Active' : 'Not Active';?></td>
                                            <td><?=$row['state_id']?></td>
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