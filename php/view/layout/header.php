<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
</head>
<body>
<div class="container">
    <header class="mb-5">
        <div class="p-5 text-center bg-light" style="margin-top:
58px;">
            <h1 class="mb-3"><?php echo $controller->page_title; ?>
            </h1>
            <h4 class="mb-3">-</h4>
        </div>
    </header>
    <?php if (isset($_SESSION['is_logged_in'])&& $_SESSION['is_logged_in']): ?>
    <div class="col-md-12 text-right">
        <h3>Hola, <?= $_SESSION["user_data"]["name"] ?></h3>
        <hr>
    </div>
    <div class="col-md-12 text-right">
        <a href="index.php?controller=user&action=logout" class="btn btn-outline-primary">logout</a>
        <hr>
    </div>
     <?php else:; ?>
    <div class="col-md-12 text-right">
        <a href="index.php?controller=user&action=login" class="btn btn-outline-primary">login</a>
        <hr>
    </div>
    <div class="col-md-12 text-right">
        <a href="index.php?controller=user&action=register" class="btn btn-outline-primary">register</a>
        <hr>
    </div>
    <?php endif; ?>