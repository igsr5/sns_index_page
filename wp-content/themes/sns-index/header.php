<?php require 'setting.php';?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SNS-Sample</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/sns-index.css">
    </head>
    <body>
        <header class="mb-5">
          <div class="container-fluid">
            <div class="row">
              <a class="user-name col-3"><?php echo $page->post_title; ?></a>
              <ul class="col-9 d-flex justify-content-end">
                <li class="ml-5 d-flex align-items-center"><a>Elected Officials</a></li>
                <li class="ml-5 d-flex align-items-center"><a>Lobbyists</a></li>
                <li class="ml-5 d-flex align-items-center"><a>Staff</a></li>
              </ul>
            </div>
          </div>
        </header>
