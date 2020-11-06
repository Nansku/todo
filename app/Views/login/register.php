<h3><?= $title ?></h3>

<form action="/login/registration">
    <div class="col-12">
        <?= \Config\Services::validation()->listErrors(); ?>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input class="form-control" name="user" placeholder="Enter username" maxlength="30">
    </div>
    
    <div class="form-group">
        <label>First name</label>
        <input class="form-control" name="fname" placeholder="Enter first name" maxlength="30">
    </div>

    <div class="form-group">
        <label>Last name</label>
        <input class="form-control" name="lname" placeholder="Enter last name" maxlength="30">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input class="form-control" name="password" placeholder="Enter password" maxlength="30">
    </div>

    <div class="form-group">
        <label>Password again</label>
        <input class="form-control" name="confirmpassword" placeholder="Enter password again" maxlength="30">
    </div>
    
    <button class="btn btn-success">Submit</button>
</form>