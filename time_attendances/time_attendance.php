<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Time Attendance</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include_once '../components/header_link.php' ?>
</head>

<body>
    <?php include_once '../php/time_attendances/time_attendance.php' ?>

    <?php include_once '../components/header.php' ?>

    <?php include_once '../components/sidebar.php' ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Time Attendance</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Time Attendances</li>
                    <li class="breadcrumb-item active">Time Attendance</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="d-sm-flex align-items-center justify-content-end mb-4">
            <select class="form-select me-2" id="select_personal">
                <option value="">เลือกผู้ใช้</option>
            </select>
            <select class="form-select me-2" id="select_month">
                <option value="">เลือกเดือน</option>
                <?php
                $months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
                $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('n');
                foreach ($months as $index => $monthName) {
                    $value = $index + 1;
                    $selected = ($selectedMonth == $value) ? 'selected' : '';
                    echo "<option value='$value' $selected>$monthName</option>";
                }
                ?>
            </select>
            <select class="form-select me-2" id="select_year">
                <option value="">เลือกปี</option>
                <?php
                $startYear = 2024;
                $currentYear = date('Y');
                $selectedYear = isset($_GET['year']) ? $_GET['year'] : $currentYear;
                for ($year = $startYear; $year < $startYear + 20; $year++) {
                    $selected = ($year == $selectedYear) ? 'selected' : '';
                    $year_show = $year + 543;
                    echo "<option value='$year' $selected>$year_show</option>";
                }
                ?>
            </select>
            <button class="btn btn-primary" type="button" id="search_button">ค้นหา</button>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table id="datatables" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>วันที่</th>
                                        <th>เวลาเข้า</th>
                                        <th>เวลาออก</th>
                                        <!-- <th>สถานะ</th> -->
                                        <!-- <th>ตัวเลือก</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <?php include_once '../components/footer.php' ?>

    <script src="<?= $path ?>js/time_attendances/time_attendance.js"></script>
    <script src="<?= $path ?>js/common/get_query_param.js"></script>
    <script src="<?= $path ?>js/common/convert_form_data_to_json.js"></script>
    <script src="<?= $path ?>js/common/handle_error.js"></script>

</body>

</html>