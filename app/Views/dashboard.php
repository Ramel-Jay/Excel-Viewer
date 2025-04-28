<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<style>
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #dc3545;
    }

    .card-body {
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<body>

<div>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-4 px-4">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Logo on the left -->
            <div class="d-flex align-items-center">
                <h1 class="fw-bold mb-0 text-primary">Display Excel</h1>
            </div>

            <!-- User info and sign-out on the right -->
            <div class="d-flex align-items-center">
                <h5 class="mb-0 me-3" style="font-size: 1.2rem; font-weight: 500; color: #343a40;">Hello, 
                    <span class="fw-bold text-dark" style="font-size: 1.3rem;"><?= esc($userInfo['name']); ?>!</span>
                </h5>
                <!-- Sign-out button -->
                <a class="dropdown-item text-danger d-flex align-items-center" href="<?= base_url('dashboard/signout') ?>" style="transition: background-color 0.3s;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                    <span class="text-danger">Sign Out</span>
                </a>
            </div>
        </div>
    </div>
</div>



    <div class="container">

        <div class="card p-4 mb-4">
            <h5 class="mb-3">Upload Excel File (.xls, .xlsx)</h5>
            <form id="uploadForm" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <input type="file" name="excel_file" id="excel_file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" id="upload_excel_btn">Upload</button>
            </form>
        </div>

        <div class="card p-4">
            <h5 class="mb-3">Excel Content Preview</h5>
            <div id="tableContainer">
                <!-- Table will appear here -->
            </div>
        </div>
    </div>
    


</div>

<!-- Bootstrap Bundle JS (with Popper for dropdown) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#uploadForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?= site_url('dashboard/excel') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#upload_excel_btn').text('Uploading...').prop('disabled', true);
                },
                success: function (response) {
                    $('#upload_excel_btn').text('Upload').prop('disabled', false);
                    
                    if (response.status === 'success') {
                        var tableHtml = '<table class="table table-bordered table-striped">';
                        response.data.forEach(function (row) {
                            tableHtml += '<tr>';
                            row.forEach(function (cell) {
                                tableHtml += '<td>' + (cell !== null ? cell : '') + '</td>';
                            });
                            tableHtml += '</tr>';
                        });
                        tableHtml += '</table>';

                        $('#tableContainer').html(tableHtml);
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    $('#upload_excel_btn').text('Upload').prop('disabled', false);
                    alert('An error occurred while uploading the file.');
                }
            });
        });
    });
</script>

</body>
</html>
