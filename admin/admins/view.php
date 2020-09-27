<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'admins/view.php'?>">Admins</a><a href="<?=ADMIN_URL.'admins/add.php';?>" class="btn btn-primary pull-right">ADD ADMIN</a></h4>
            <br>
            <div class="col-lg-12">
                <div style="display:none" id="message"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Admins</h3>
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
                                <?php $rows = get_data('admins'); ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr data-id="<?=$row['admin_id']?>" data-mod="admins">
                                        <td><?=type_count()?></td>
                                        <td><?php 
                                            if (isset($row['admin_image'])) {
                                                echo '<img src="'.WEBSITE_URL.'uploads'.DS.'admins'.DS.$row['admin_image'].'" width="100px" height="100px">';
                                            } else {
                                                echo 'NO Image';
                                            }
                                            ?>
                                        </td>
                                        <td><?=ucfirst($row['admin_name'])?></td>
                                        <td>
                                            <select class="form-control" data-id="<?=$row['admin_id']?>" id="admin_type">
                                                <option value="admin" <?=($row['admin_type'] == 'admin') ? 'selected' : ''?>>Admin</option>
                                                <option value="super_admin" <?=($row['admin_type'] == 'super_admin') ? 'selected' : ''?>>Super Admin</option>
                                            </select>
                                            <br>
                                            <button class="btn btn-primary pull-right" style="display:none;" id="admin_update<?=$row['admin_id']?>">Update</button>
                                        </td>
                                        <td>
                                            <select class="form-control" data-id="<?=$row['admin_id']?>" id="active">
                                                <option value="1" <?=($row['admin_is_active'] == 1) ? 'selected' : ''?>>Active</option>
                                                <option value="0" <?=($row['admin_is_active'] == 0) ? 'selected' : ''?>>Not Active</option>
                                            </select>
                                            <br>
                                            <button class="btn btn-primary pull-right" style="display:none;" id="btn_active<?=$row['admin_id']?>">Update</button>
                                        </td>
                                        <td><a href="<?=ADMIN_URL.'admins/edit.php?admin_id='.$row['admin_id']?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="<?=ADMIN_URL.'admins/delete.php?admin_id='.$row['admin_id']?>" class="btn btn-danger">Delete</a></td>
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
</div>
<?php require_once ADMIN_INCLUDES."footer.php"; ?>