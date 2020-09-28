<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.'doctors/view'?>">Doctors</a><a href="<?=ADMIN_URL.'doctors/add';?>" class="btn btn-primary pull-right">ADD DOCTOR &nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a></h4>
                    <br>
                    <div class="col-lg-12">
                    <div id="message"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Doctors</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>DEPARTMENT</th>
                                        <th>PHONE</th>
                                        <th>ACTIVE</th>
                                        <th>HOME</th>
                                        <th>DETAILS</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('doctors'); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr data-id=<?=$row['doctor_id']?> data-mod="doctors" data-department="<?=$row['department_id']?>">
                                            <td><?=type_count()?></td>
                                            <td><?php 
                                            if (isset($row['doctor_image'])) {
                                                echo '<img src="'.WEBSITE_URL.'uploads'.DS.'doctors'.DS.$row['doctor_image'].'" width="100px" height="100px">';
                                                } else {
                                                    echo 'NO Image';
                                                }
                                            ?>
                                        </td>
                                            <td><?=ucfirst($row['doctor_name'])?></td>
                                            <td>
                                            <?php if (! empty($row['department_id'])): ?>
                                                <?php $departments =  get_data('departments','where `department_is_active` = 1','id,name'); ?>
                                                <select class="form-control" data-id="<?=$row['doctor_id']?>" id="department">
                                                <?php foreach ($departments as $department): ?>
                                                    <option value="<?=$department['department_id']?>" <?=($department['department_id'] == $row['department_id']) ? 'selected' : '' ?>><?=ucfirst($department['department_name'])?></option>
                                                    
                                                <?php endforeach; ?>
                                                </select>
                                                <br>
                                                <button class="btn btn-primary pull-right" style="display:none;" id="btn_department<?=$row['doctor_id']?>">Update</button>
                                            <?php else: ?>
                                                <br>No Department Yet</br>
                                            <?php endif;?>
                                            </td>
                                            <td><?=$row['doctor_phone']?></td>
                                            <td>
                                                <select class="form-control" data-id="<?=$row['doctor_id']?>" id="active">
                                                    <option value="1" <?=($row['doctor_is_active'] == 1) ? 'selected' : ''?>>Active</option>
                                                    <option value="0" <?=($row['doctor_is_active'] == 0) ? 'selected' : ''?>>Not Active</option>
                                                </select>
                                                <br>
                                                <button class="btn btn-primary pull-right" style="display:none;" id="btn_active<?=$row['doctor_id']?>">Update</button>
                                            </td>
                                            <td>
                                                <select class="form-control" data-id="<?=$row['doctor_id']?>" id="show">
                                                    <option value="1" <?=($row['doctor_is_show'] == 1) ? 'selected' : ''?>>Visiable</option>
                                                    <option value="0" <?=($row['doctor_is_show'] == 0) ? 'selected' : ''?>>Hidden</option>
                                                </select>
                                                <br>
                                                <button class="btn btn-primary pull-right" style="display:none;" id="btn_show<?=$row['doctor_id']?>">Update</button>
                                            </td>
                                            <td><a href="<?=ADMIN_URL.'doctors/details.php?doctor_id='.$row['doctor_id']?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>
</a></td>
                                            <td><a href="<?=ADMIN_URL.'doctors/edit.php?doctor_id='.$row['doctor_id']?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a></td>
                                            <td><a href="<?=ADMIN_URL.'doctors/delete.php?doctor_id='.$row['doctor_id']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>
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