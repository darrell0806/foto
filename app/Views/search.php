<!-- app/Views/search.php -->

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Search User</h2>
            <form action="<?= base_url('dashboard/searchUser'); ?>" method="post">
                <div class="form-group">
                    <label for="search_username">Username:</label>
                    <input type="text" class="form-control" id="search_username" name="search_username" required>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
</div>
