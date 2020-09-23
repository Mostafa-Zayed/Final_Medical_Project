<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'cities/view.php'?>">Cities</a><a href="<?=ADMIN_URL.'cities/add.php';?>" class="btn btn-primary pull-right">ADD CITY</a></h4>
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
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?=type_count()?></td>
                                            <td><?=ucfirst($row['city_name'])?></td>
                                            <td><?=($row['city_is_active'] == 1) ? 'Active' : 'Not Active';?></td>
                                            <td><?=$row['state_id']?></td>
                                            <td><a href="<?=ADMIN_URL.'cities/edit.php?city_id='.$row['city_id']?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="<?=ADMIN_URL.'cities/delete.php?city_id='.$row['city_id']?>" class="btn btn-danger">Delete</a></td>
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