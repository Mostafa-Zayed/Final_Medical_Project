<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.'questions/view'?>"> Questions </a><a href="<?=ADMIN_URL.'questions/add';?>" class="btn btn-primary pull-right">ADD Questions &nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a></h4>
                    <br>
                    <div class="col-lg-12">
                        <div id="message"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Questions</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                            <div class="table">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>ID</th>
                                        <th>Content</th>
                                        <th>RATE</th>
                                        <th>HOME</th>
                                        <th>ITEM</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </thead>
                                    <tbody>
                                    <?php $rows = get_data('feedbacks'); ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr data-id=<?=$row['feedback_id']?> data-mod="feedbacks">
                                            <td><?=type_count()?></td>
                                            <td width="40%"><?=ucfirst($row['feedback_content'])?></td>
                                            <td><?=$row['feedback_rate']?></td>
                                            <td>
                                                <select class="form-control" data-id="<?=$row['feedback_id']?>" id="show">
                                                    <option value="1" <?=($row['feedback_is_show'] == 1) ? 'selected' : ''?>>Visisable</option>
                                                    <option value="0" <?=($row['feedback_is_show'] == 0) ? 'selected' : ''?>>Hidden</option>
                                                </select>
                                                <br>
                                                <button class="btn btn-primary pull-right" style="display:none;" id="btn_show<?=$row['feedback_id']?>">Update</button>
                                            </td>
                                            <td><a href="<?=ADMIN_URL.'feedbacks/show.php?feedback_id='.$row['feedback_id']?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                            <td><a href="<?=ADMIN_URL.'feedbacks/edit.php?feedback_id='.$row['feedback_id']?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                            <td><a href="<?=ADMIN_URL.'feedbacks/delete.php?feedback_id='.$row['feedback_id']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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