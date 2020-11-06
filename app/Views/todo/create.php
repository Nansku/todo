<h3><?= $title ?></h3>
<form action="/todo/create">
    <div class="col-12">
        <!--Validation tarkistaa annettut syötteet-->
        <?= Config\Services::validation()->listErrors(); ?>
    </div>

    <div class="form-group">
        <label>Title</label>
        <input class="form-control" name="title" placeholder="Enter title" maxlength="255">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" name="description" 
        placeholder="Enter description" maxlength="255"></textarea>
    </div>
        <button class="btn btn-success">Save</button>
</form>