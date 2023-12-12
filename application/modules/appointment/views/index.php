<?php
main_header(['appointment']);
?>
<!-- ############ PAGE START-->
<style>

</style>

<section>
    <div class="container">
        <div class="card pt-4">
            <div class="card-header">
                <h2>APPOINTMENT LIST</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12" style="height: 350px; overflow: auto;">
                        <h3 class="ml-2 mb-3">Appointments from Students</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Student ID no.</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($appointments)) {
                                    // var_dump($appointments);
                                    foreach ($appointments as $k => $val) {
                                        $status = ($val->Status == 'Approved' ? 1 : ($val->Status == 'Pending' ? 0 : 2));
                                        
                                ?>
                                        <tr>
                                            <td class="text-center"><?= @$k + 1 . '.' ?></td>
                                            <td class="text-center"><?= @$val->appointer_name ?></td>
                                            <td class="text-center"><?= @$val->username ?></td>
                                            <td class="text-center"><?= date("m-d-Y", strtotime(@$val->Date)) ?></td>
                                            <td class="text-center"><?= date('h:i a', strtotime(@$val->fromTime)) . '-' . date('h:i a', strtotime(@$val->toTime)) ?></td>
                                            <?php if ($session->usertype == 3) {
                                            ?>
                                                <td class="text-center"><?=     @$val->Status ?></td>
                                            <?php
                                            } else { ?>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-status" data-stat="1" data-id="<?= @$val->ID ?>" <?= $status == 1 ? 'disabled' : ''; ?>><i class="fas fa-check"></i></button>
                                                    <button type="button" class="btn btn-primary btn-status" data-stat="0" data-id="<?= @$val->ID ?>" <?= $status == 0 ? 'disabled' : ''; ?>><i class="fas fa-spinner"></i></button>
                                                    <button type="button" class="btn btn-danger btn-status" data-stat="2" data-id="<?= @$val->ID ?>" <?= $status == 2 ? 'disabled' : ''; ?>><strong>X</strong></button>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<td colspan='6' class='text-center'>No Appointments available</td>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12" style="height: 350px; overflow: auto;" <?= @$session->usertype == 3 ? 'hidden' : '' ?>>
                        <h3 class="ml-2 mb-3">My Appointments</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Student ID no.</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($appointments_c)) {
                                    foreach ($appointments_c as $k => $val) {
                                        $status = ($val->Status == 1 ? "Approved" : ($val->Status == 0 ? "Pending" : "Cancelled"));
                                ?>
                                        <tr>
                                            <td class="text-center"><?= @$k + 1 . '.' ?></td>
                                            <td class="text-center"><?= ucfirst(@$val->fname).' '.ucfirst(@$val->lname) ?></td>
                                            <td class="text-center"><?= @$val->username ?></td>
                                            <td class="text-center"><?= date("m-d-Y", strtotime(@$val->Date)) ?></td>
                                            <td class="text-center"><?= date('h:i a', strtotime(@$val->fromTime)) . '-' . date('h:i a', strtotime(@$val->toTime)) ?>    </td>
                                            <td class="text-center">
                                                <?= @$status ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<td colspan='6' class='text-center'>No Appointments available</td>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
</section>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/appointment/appointment_web.js"></script>
<script>
      setInterval(function() {
            location.reload();
        }, 300000);
</script>