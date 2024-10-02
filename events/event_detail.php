<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Event Detail</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include_once '../components/header_link.php' ?>
</head>

<body>
    <?php include_once '../php/events/event_detail.php' ?>

    <?php include_once '../components/header.php' ?>

    <?php include_once '../components/sidebar.php' ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Event Details</li>
                    <li class="breadcrumb-item active">Evente Detail</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="pagetitle">
            <h1><span id="event_name"></span></h1>
        </div>
        <div>
            <h5>รายละเอียดกิจกรรม : <span id="event_detail"></span></h5>
        </div>
        <div>
            <h5>วันที่เริ่ม : <span id="event_date"></span></h5>
        </div>
        <div>
            <h5>วันที่สิ้นสุด : <span id="event_date_to"></span></h5>
        </div>

        <section class="section">
            <div class="row align-items-top" id="cardContainer">

            </div>
        </section>

    </main><!-- End #main -->

    <?php include_once '../components/footer.php' ?>

    <script src="<?= $path ?>js/events/event_detail.js"></script>
    <script src="<?= $path ?>js/common/get_query_param.js"></script>
    <script src="<?= $path ?>js/common/convert_form_data_to_json.js"></script>
    <script src="<?= $path ?>js/common/handle_error.js"></script>

</body>

</html>