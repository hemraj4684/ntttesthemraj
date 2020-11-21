<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    let searchParams = new URLSearchParams(window.location.search);
    let data = {};
    if (searchParams.has('type')) {
        data['type'] = searchParams.get('type');
    }
    if (searchParams.has('ipstart')) {
        data['ipstart'] = searchParams.get('ipstart');
    }
    if (searchParams.has('ipend')) {
        data['ipend'] = searchParams.get('ipend');
    }
    $.ajax({
        type: 'get',
        url: 'http://localhost/Hemraj-test/crud/public/api/',
        data: data,
        dataType: 'json',
        headers: {"Authorization": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxfQ==.4oDCXk+8ckMQ/YLZbYoxydTQZ84oW2441sZMu3rU5tA="},
        success: function (r){
            if (r.success) {
                let html = '';
                $.each(r.data, (k, v) => {
                    html += '<tr><td>'+v.id+'</td><td>'+v.sapid+'</td><td>'+v.hostname+'</td><td>'+v.loopback+'</td><td>'+v.macaddress+'</td><td><a class="btn btn-primary" href="edit.php?ip='+v.loopback+'">edit</a> <button data-ip="'+v.loopback+'" class="btn remove-item btn-danger">Delete</button></td></tr>'
                });
                $('#data tbody').html(html)
            }
        }
    });
    $('.reset-btn').click(function () {
        location.href = 'index.php';
    })
});
$(document).on('click', '.remove-item', function(){
    if (confirm('Are you sure, you want to delete ?')) {
        $.ajax({
            type: 'get',
            url: 'http://localhost/Hemraj-test/crud/public/api/delete',
            data: { ip: $(this).data('ip') },
            headers: {"Authorization": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxfQ==.4oDCXk+8ckMQ/YLZbYoxydTQZ84oW2441sZMu3rU5tA="},
            dataType: 'json',
            success: function (r){
                location.reload();
            }
        });
    }
});
</script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-12">
    <h1>Routers <a href="add.php" class="btn btn-primary btn-lg">Add More</a></h1>

    <form method="get" class="form-inline" id="search-form">
        <input type="radio" name="type" value="ag1" <?php if (isset($_GET['type']) && $_GET['type'] == 'ag1') { echo 'checked'; } ?>> AG1
        <input type="radio" name="type" value="css" <?php if (isset($_GET['type']) && $_GET['type'] == 'css') { echo 'checked'; } ?>> CSS
        <div class="form-group">
            <label for="ipstart">IP Address Start</label>
            <input type="text" class="form-control" id="ipstart" name="ipstart" placeholder="Ipaddress Start" value="<?php if (isset($_GET['ipstart'])) { echo $_GET['ipstart']; } ?>">
            </div>
            <div class="form-group">
            <label for="ipend">IP Address End</label>
            <input type="text" class="form-control" id="ipend" name="ipend" placeholder="Ipaddress End" value="<?php if (isset($_GET['ipend'])) { echo $_GET['ipend']; } ?>">
            <button type="submit" class="btn btn-warning">Submit</button>
            <button type="button" class="btn btn-warning reset-btn">Reset</button>
        </div>
    </form>
    <table class="table" id="data">
        <thead>
            <tr>
                <th>#</th>
                <th>Sapid</th>
                <th>Hostname</th>
                <th>Loopback</th>
                <th>Mac Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
</div>
</div>
</body>
</html>