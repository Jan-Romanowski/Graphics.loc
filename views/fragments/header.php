<!DOCTYPE html>
<header>
    <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="/js/javascript.js" type="text/javascript"></script>
    <script src="/css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Pracownika</title>

</header>

<nav class="navbar navbar-expand-lg row navbar-dark bg-dark m-0 sticky-top">
    <div class="container-fluid col-sm-12 col-md-10 col-lg-8">
        <a class="navbar-brand d-inline-block text-truncate col-sm-4" href="#">Portal Pracownika</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">

                  <li class="nav-item">
                      <a class="nav-link" href="/user/login/">Zaloguj</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="/users/logout/"></a>
                  </li>

            </ul>
        </div>
    </div>
</nav>

<div class="row g-0 mt-5">
	<?php if (isset($_SESSION["msg"]) && $_SESSION["msg"]): ?>
      <div class="container-fluid col-sm-12 col-md-10 col-lg-8">
          <div class="alert <?php echo $_SESSION["stat"]; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION["msg"]; ?>
                <?php $_SESSION["msg"] = null; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      </div>
	<?php endif; ?>
</div>
