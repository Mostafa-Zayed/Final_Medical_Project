<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'settings/view.php'?>">Settings</a><a href="<?=ADMIN_URL.'settings/add.php';?>" class="btn btn-primary pull-right">ADD SETTING</a></h4>
            <br>
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Settings</h3>
                    </div>
                    <div class="panel-body">
                        <div id="shieldui-grid1" class='text-center'>
                            <h4>Settings</h4>
                        </div>
                        <br>
                        <?php $rows = get_data('settings'); ?>
                        
                            <div class='table'>
                            <table class="table bordered">
                                <tbody>
                                <?php foreach ($rows as $row): ?>
                                    <tr data-id="<?=$row['setting_id']?>">
                                        <td>
                                            <label for="<?=$row['setting_name']?>"><?=ucfirst($row['setting_name'])?> :</label>
                                        </td>
                                        <td>
                                        <?php if ($row['setting_type'] == 'textarea'): ?>
                                            <<?=$row['setting_type']?> class="form-control"></<?=$row['setting_type']?>>
                                        <?php else: ?>
                                            <input type="<?=$row['setting_type']?>" class="form-control" name="<?=$row['setting_name']?>" id="<?=$row['setting_name']?>" value="<?=$row['setting_value']?>">
                                        <?php endif; ?>
                                        </td>
                                        <td id="btnset">
                                            <button class="btn btn-primary" data-id="<?=$row['setting_id']?>">Save</button>
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
<?php require_once INCLUDES."footer_dashboard.php"; ?>