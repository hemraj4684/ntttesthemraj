<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#router-form').submit(function(e){
        e.preventDefault();
        let t = $(this);
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: t.serialize(),
            url: 'http://localhost/Hemraj-test/crud/public/store',
            success: function (r) {
                if (r.success) {
                    alert(r.msg)
                    location.reload();
                } else {
                    let html = '';
                    $.each(r.validate, (k, v) => {
                        html += '<p class="alert alert-danger">' + v + '</p>';
                    })
                    $('#errors').html(html);
                }
            }
        })
    });
});
</script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-12">
    <h1>Add Router <a href="index.php" class="btn btn-primary btn-lg">Go to list</a></h1>
    <form class="form-horizontal" method="post" id="router-form">
        <div class="form-group">
            <label for="sapid" class="col-sm-2 control-label">Sapid</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sapid" name="sapid" placeholder="Sapid" required>
            </div>
        </div>
        <div class="form-group">
            <label for="hostname" class="col-sm-2 control-label">Hostname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hostname" name="hostname" placeholder="Hostname" required>
            </div>
        </div>
        <div class="form-group">
            <label for="loopback" class="col-sm-2 control-label">Loopback</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="loopback" name="loopback" placeholder="Loopback" required>
            </div>
        </div>
        <div class="form-group">
            <label for="macaddress" class="col-sm-2 control-label">Macaddress</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="macaddress" name="macaddress" placeholder="Macaddress" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div id="errors"></div>
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</body>
</html>