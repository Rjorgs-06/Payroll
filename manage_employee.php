<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
    $user = $conn->query("SELECT * FROM employee1 where id =" . $_GET['id']);
    foreach ($user->fetch_array() as $k => $v) {
        $meta[$k] = $v;
    }
}
?>
<div class="container-fluid">
    <form id='employee_frm'>
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : "" ?>" />
        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo isset($meta['fullname']) ? $meta['fullname'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" id="position" class="form-control" value="<?php echo isset($meta['position']) ? $meta['position'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="employee_id">Employee ID</label>
            <input type="text" name="employee_id" id="employee_id" class="form-control" value="<?php echo isset($meta['employee_id']) ? $meta['employee_id'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="monthly_salary">Monthly Salary</label>
            <input type="text" name="monthly_salary" id="monthly_salary" class="form-control" value="<?php echo isset($meta['monthly_salary']) ? $meta['monthly_salary'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="pera">PERA</label>
            <input type="text" name="pera" id="pera" class="form-control" value="<?php echo isset($meta['pera']) ? $meta['pera'] : '' ?>" required>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Please Select Here",
            width: "100%"
        })
        $('#employee_frm').submit(function(e) {
            e.preventDefault()
            start_load();
            $.ajax({
                url: 'ajax.php?action=save_employee',
                method: 'POST',
                data: $(this).serialize(),
                error: err => console.log(),
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Employee's data successfully saved", "success");
                        setTimeout(function() {
                            location.reload();

                        }, 1000)
                    } else {
                        alert_toast("Employee's data failed")
                    }
                }
            })
        })
    })
</script>