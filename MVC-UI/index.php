<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $.ajax({
        type: 'get',
        url: 'http://localhost/Hemraj-test/crud/public/',
        dataType: 'json',
        success: function (r){
            if (r.success) {
                let html = '';
                $.each(r.data, (k, v) => {
                    html += '<tr><td>'+v.id+'</td><td>'+v.sapid+'</td><td>'+v.hostname+'</td><td>'+v.loopback+'</td><td>'+v.macaddress+'</td><td><a class="btn btn-primary" href="edit.php?id='+v.id+'">edit</a> <button data-id="'+v.id+'" class="btn remove-item btn-danger">Delete</button></td></tr>'
                });
                $('#data tbody').html(html)
            }
        }
    });
});
$(document).on('click', '.remove-item', function(){
    if (confirm('Are you sure, you want to delete ?')) {
        $.ajax({
            type: 'get',
            url: 'http://localhost/Hemraj-test/crud/public/delete/' + $(this).data('id'),
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