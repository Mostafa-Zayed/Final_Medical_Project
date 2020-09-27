<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'cities/view.php'?>">Cities</a><a href="<?=ADMIN_URL.'cities/add.php';?>" class="btn btn-primary pull-right">ADD CITY</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div style="display:none" id="message"></div>
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
                                        <tr data-id=<?=$row['city_id']?> data-mod="cities" data-state="<?=$row['state_id']?>">
                                            <td><?=type_count()?></td>
                                            <td><a href="<?=ADMIN_URL.'appointments/view.php?city_id='.$row['city_id']?>"><?=ucfirst($row['city_name'])?></a></td>
                                            <td>
                                            <select class="form-control" data-id="<?=$row['city_id']?>" id="active">
                                                <option value="1" <?=($row['city_is_active'] == 1) ? 'selected' : ''?>>Active</option>
                                                <option value="0" <?=($row['city_is_active'] == 0) ? 'selected' : ''?>>Not Active</option>
                                            </select>
                                            <br>
                                            <button class="btn btn-primary pull-right" style="display:none;" id="btn_active<?=$row['city_id']?>">Update</button>
                                            </td>
                                            <td>
                                                <?php $states = get_data('states', "Where `state_is_active` = 1");?>
                                                <select class="form-control" data-id="<?=$row['city_id']?>" id="state">
                                                    <?php foreach ($states as $state): ?>
                                                        <option value="<?=$state['state_id']?>" <?=($state['state_id'] == $row['state_id']) ? 'selected' : ''?>><?=ucfirst($state['state_name'])?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <br>
                                                <button class="btn btn-primary pull-right" style="display:none;" id="btn_state<?=$row['city_id']?>">Update</button>
                                            </td>
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
<?php require_once ADMIN_INCLUDES."footer.php"; ?>