<?php include('condb.php'); ?>
<?php include 'navbar-user.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width ,initial-scale=1.0">
    <title>RUTS</title>



    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@5.3.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>



<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form class="was-validated" novalidate="" style="width: 300px;">
        <div class="card">
            <div class="card-header"><label class="form-label">ค้นหาศิษย์เก่า</label></div>
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-12 mb-2"><label class="form-label mb-1">ค้นหา</label><input class="form-control form-control-sm" type="text" required="" value="น" fdprocessedid="qt8z4u">
                        <div class="invalid-feedback">กรุณากรอกข้อมูล</div><span class="form-text text-dark">ระบบค้นหาจากชื่อ นามสกุล รหัสนักศึกษา</span>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label mb-1">วิทยาเขต</label>
                        <select class="form-select form-select-sm" required="" fdprocessedid="qt8z4u">
                            <option value="">โปรดเลือก</option>
                            <option value="1">วิทยาเขต 1</option>
                            <option value="2">วิทยาเขต 2</option>
                            <option value="3">วิทยาเขต 3</option>
                        </select>
                        <div class="invalid-feedback">กรุณาเลือกวิทยาเขต</div>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label mb-1">คณะ</label>
                        <select class="form-select form-select-sm" required="" fdprocessedid="qt8z4u">
                            <option value="">โปรดเลือก</option>
                            <option value="1">คณะวิทยาศาสตร์</option>
                            <option value="2">คณะเศรษฐศาสตร์</option>
                            <option value="3">คณะวิศวกรรมศาสตร์</option>
                        </select>
                        <div class="invalid-feedback">กรุณาเลือกคณะ</div>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label mb-1">สาขา</label>
                        <select class="form-select form-select-sm" required="" fdprocessedid="qt8z4u">
                            <option value="">โปรดเลือก</option>
                            <option value="1">วิทยาการคอมพิวเตอร์</option>
                            <option value="2">เทคโนโลยีสารสนเทศ</option>
                            <option value="3">วิศวกรรมไฟฟ้า</option>
                        </select>
                        <div class="invalid-feedback">กรุณาเลือกสาขา</div>
                    </div>
                    <div class="col-12 d-flex justify-content-end mb-1"><button class="btn btn-primary btn-sm but-sut" type="submit" fdprocessedid="px0lj">ค้นหา</button></div>
                </div>
            </div>
        </div>
    </form>
</div>
