<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'features/view.php'?>">Features</a><a href="<?=ADMIN_URL.'features/add.php';?>" class="btn btn-primary pull-right">ADD FEATURE</a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Features</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>ICON</th>
                                        <th>NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th>ACTIVE</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('features'); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr data-id="<?=$row['feature_id']?>" data-mod="features">
                                            <td><?=type_count()?></td>
                                            <td><?=$row['feature_icon']?></td>
                                            <td><?=ucfirst($row['feature_name'])?></td>
                                            <td><?=$row['feature_description']?></td>
                                            <td>
                                                <select class="form-control" data-id="<?=$row['feature_id']?>" id="active">
                                                    <option value="1" <?=($row['feature_is_active'] == 1) ? 'selected' : ''?>>Active</option>
                                                    <option value="0" <?=($row['feature_is_active'] == 0) ? 'selected' : ''?>>Not Active</option>
                                                </select>
                                            <br>
                                            <button class="btn btn-primary pull-right" style="display:none;" id="btn_active<?=$row['feature_id']?>">Update</button>
                                        </td>
                                            <td><a href="<?=ADMIN_URL.'features/edit.php?feature_id='.$row['feature_id']?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="<?=ADMIN_URL.'features/delete.php?feature_id='.$row['feature_id']?>" class="btn btn-danger">Delete</a></td>
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