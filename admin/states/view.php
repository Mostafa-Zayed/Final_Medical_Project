<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'states/view.php'?>">States</a><a href="<?=ADMIN_URL.'states/add.php';?>" class="btn btn-primary pull-right">ADD STATE</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div style="display:none" id="message"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> States</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>ACTIVE</th>
                                        <th>Country</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('states'); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr data-id=<?=$row['state_id']?> data-mod="states" data-country="<?=$row['country_id']?>">
                                            <td><?=type_count()?></td>
                                            <td><?=ucfirst($row['state_name'])?></td>
                                            <td>
                                            <select class="form-control" data-id="<?=$row['state_id']?>" id="active">
                                                <option value="1" <?=($row['state_is_active'] == 1) ? 'selected' : ''?>>Active</option>
                                                <option value="0" <?=($row['state_is_active'] == 0) ? 'selected' : ''?>>Not Active</option>
                                            </select>
                                            <br>
                                            <button class="btn btn-primary pull-right" style="display:none;" id="btn_active<?=$row['state_id']?>">Update</button>
                                            </td>
                                            <td>
                                                <?php $countries = get_data('countries', "Where `country_is_active` = 1");?>
                                                <select class="form-control" data-id="<?=$row['state_id']?>" id="country">
                                                    <?php foreach ( $countries as $country): ?>
                                                        <option value="<?=$country['country_id']?>" <?=($country['country_id'] == $row['country_id']) ? 'selected' : ''?>><?=ucfirst($country['country_name'])?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <br>
                                                <button class="btn btn-primary pull-right" style="display:none;" id="btn_country<?=$row['state_id']?>">Update</button>
                                            </td>
                                            <td><a href="<?=ADMIN_URL.'states/edit.php?state_id='.$row['state_id']?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="<?=ADMIN_URL.'states/delete.php?state_id='.$row['state_id']?>" class="btn btn-danger">Delete</a></td>
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