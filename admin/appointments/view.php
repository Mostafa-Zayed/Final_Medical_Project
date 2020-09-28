<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'appointments/view'?>">Appointments</a><a href="<?=ADMIN_URL.'appointments/add';?>" class="btn btn-primary pull-right">ADD APPOINTMENT &nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a></h4>
            <br>
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Appointments</h3>
                    </div>
                    <div class="panel-body">
                        <div id="shieldui-grid1"></div>
                        <div class="table">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>PHONE</th>
                                    <th>SERVICE</th>
                                    <th>DATE</th>
                                    <th>DOCTOR</th>
                                    <th>CONFIRMED</th>
                                    <th>SHOW</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </thead>
                                <tbody>
                                <?php if (isset($city_id)){
                                        $rows = get_data_join($tables, "appointments.city_id = $city_id");
                                    } else {
                                        $rows = get_data('appointments'); 
                                    }
                                ?>
                                    <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td><?=type_count()?></td>
                                        <td><?=ucfirst($row['appointment_name'])?></td>
                                        <td><?=ucfirst($row['appointment_phone'])?></td>
                                        <td><?=ucfirst($row['service_id'])?></td>
                                        <td><?=ucfirst($row['appointment_date'])?></td>
                                        <td><?=ucfirst($row['doctor_id'])?></td>
                                        <td><?=($row['appointment_is_confirmed'] == 1) ? 'Conformed' : 'Not Confirmed';?></td>
                                        <td><a href="<?=ADMIN_URL.'appointments/show.php?appointment_id='.$row['appointment_id']?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        <td><a href="<?=ADMIN_URL.'appointments/edit.php?appointment_id='.$row['appointment_id']?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                        <td><a href="<?=ADMIN_URL.'appointments/edit.php?appointment_id='.$row['appointment_id']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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