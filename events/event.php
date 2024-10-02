<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Event</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include_once '../components/header_link.php' ?>
</head>

<body>
    <?php include_once '../php/events/event.php' ?>

    <?php include_once '../components/header.php' ?>

    <?php include_once '../components/sidebar.php' ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Events</li>
                    <li class="breadcrumb-item active">Evente</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="d-sm-flex align-items-center justify-content-end mb-4">
            <select class="form-select me-2" id="select_personal">
                <option value="">เลือกผู้ใช้</option>
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
                                        <th>ชื่อกิจกรรม</th>
                                        <th>วันที่เริ่ม</th>
                                        <th>วันที่สิ้นสุด</th>
                                        <th>ความคืบหน้า</th>
                                        <th>สถานะ</th>
                                        <th>ตัวเลือก</th>
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

        <!-- Modal -->
        <div class="modal fade" id="view_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ดูข้อมูล</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">ชื่อกิจกรรม</label>
                                <input type="text" class="form-control" id="event_name_view" placeholder="<?= $texts['event_name'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">รายละเอียดกิจกรรม</label>
                                <input type="text" class="form-control" id="event_detail_view" placeholder="<?= $texts['event_description'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">วันที่เริ่ม</label>
                                <input type="text" class="form-control" id="event_date_view" placeholder="<?= $texts['start_date'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">วันที่สิ้นสุด</label>
                                <input type="text" class="form-control" id="event_date_to_view" placeholder="<?= $texts['end_date'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">ความคืบหน้า</label>
                                <input type="text" class="form-control" id="percent_view" placeholder="<?= $texts['progress'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">สถานะ</label>
                                <input type="text" class="form-control" id="status_view" placeholder="<?= $texts['status'] ?>" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <?php include_once '../components/footer.php' ?>

    <script src="<?= $path ?>js/events/event.js"></script>
    <script src="<?= $path ?>js/common/get_query_param.js"></script>
    <script src="<?= $path ?>js/common/convert_form_data_to_json.js"></script>
    <script src="<?= $path ?>js/common/handle_error.js"></script>

</body>

</html>