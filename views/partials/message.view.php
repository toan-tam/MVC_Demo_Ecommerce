<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
    </div>
<?php unset($_SESSION['error']); endif ?>

<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-success">
        <?= $_SESSION['message']; ?>
    </div>
<?php unset($_SESSION['message']); endif ?>