<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.'pages/view'?>">Pages</a><a href="<?=ADMIN_URL.'pages/add';?>" class="btn btn-primary pull-right">ADD PAGE</a></h4>
            <br>
            <div class="col-lg-12">
                <div id="message"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Pages</h3>
                    </div>
                    <div class="panel-body">
                        <div id="shieldui-grid1"></div>
                        <div class="table">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>LINK</th>
                                    <th>ACTIVE</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </thead>
                                <tbody>
                                <?php $rows = get_data('pages'); ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr data-id=<?=$row['page_id']?> data-mod="users">
                                        <td><?=type_count()?></td>
                                        <td><?=ucfirst($row['page_name'])?></td>
                                        <td><a href="<?=WEBSITE_URL.$row['page_link']?>"><?=$row['page_link']?></a></td>
                                        <td>
                                            <select class="form-control" data-id="<?=$row['page_id']?>" id="active">
                                                <option value="1" <?=($row['page_is_active'] == 1) ? 'selected' : ''?>>Active</option>
                                                <option value="0" <?=($row['page_is_active'] == 0) ? 'selected' : ''?>>Not Active</option>
                                            </select>
                                            <br>
                                            <button class="btn btn-primary pull-right" style="display:none;" id="btn_active<?=$row['page_id']?>">Update</button>
                                        </td>
                                        <td><a href="<?=ADMIN_URL.'pages/edit.php?page_id='.$row['page_id']?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="<?=ADMIN_URL.'pages/delete.php?page_id='.$row['page_id']?>" class="btn btn-danger">Delete</a></td>
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
</div>
<?php require_once ADMIN_INCLUDES."footer.php"; ?>