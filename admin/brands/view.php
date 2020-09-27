<?php require_once "../../globals.php"; ?>
<?php is_not_admin() ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'brands/view.php'?>">Brands</a><a href="<?=ADMIN_URL.'brands/add.php';?>" class="btn btn-primary pull-right">ADD BRAND</a></h4>
            <br>
            <div class="col-lg-12">
                <div id="message"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Brands</h3>
                    </div>
                    <div class="panel-body">
                        <div id="shieldui-grid1"></div>
                        <div class="table">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>ACTIVE</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </thead>
                                <tbody>
                                <?php $rows = get_data('brands'); ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr data-id="<?=$row['brand_id']?>" data-mod="brands">
                                        <td><?=type_count()?></td>
                                        <td><?php 
                                            if (! empty($row['brand_image'])) {
                                                echo '<img src="'.WEBSITE_URL.'uploads'.DS.'brands'.DS.$row['brand_image'].'" width="100px" height="100px">';
                                            } else {
                                                echo 'NO Image';
                                            }
                                            ?>
                                        </td>
                                        <td><?=ucfirst($row['brand_name'])?></td>
                                        <td><?=$row['brand_description']?></td>
                                        <td>
                                            <select class="form-control" data-id="<?=$row['brand_id']?>" id="active">
                                                <option value="1" <?=($row['brand_is_active'] == 1) ? 'selected' : ''?>>Active</option>
                                                <option value="0" <?=($row['brand_is_active'] == 0) ? 'selected' : ''?>>Not Active</option>
                                            </select>
                                            <br>
                                            <button class="btn btn-primary pull-right" style="display:none;" id="btn_active<?=$row['brand_id']?>">Update</button>
                                        </td>
                                        <td><a href="<?=ADMIN_URL.'brands/edit.php?brand_id='.$row['brand_id']?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="<?=ADMIN_URL.'brands/delete.php?brand_id='.$row['brand_id']?>" class="btn btn-danger">Delete</a></td>
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