<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php if (isset($_GET['city_id']) && ! empty($_GET['city_id']) && is_numeric($_GET['city_id'])) {
    $city_id =  (int) $_GET['city_id']; 
    $tables = array('appointments','cities');
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'appointments/view.php'?>">Appointments</a><a href="<?=ADMIN_URL.'appointments/add.php';?>" class="btn btn-primary pull-right">ADD APPOINTMENT</a></h4>
            <br>
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Appointments</h3>
                    </div>
                    <div class="panel-body">
                        <div id="shieldui-grid1"></div>
                        <div class="table">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>PHONE</th>
                                    <th>SERVICE</th>
                                    <th>DATE</th>
                                    <th>DOCTOR</th>
                                    <th>CONFIRMED</th>
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
                                        <td><a href="<?=ADMIN_URL.'appointments/edit.php?appointment_id='.$row['appointment_id']?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="<?=ADMIN_URL.'appointments/edit.php?appointment_id='.$row['appointment_id']?>" class="btn btn-danger">Delete</a></td>
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