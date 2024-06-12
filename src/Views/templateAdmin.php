<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/static/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/assets/libs/css/style.css">
    <link rel="stylesheet" href="/static/css/admin.css">
    <title>Lemming Admin</title>
</head>
<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="/">LEMMING GROUP</a>
                <h2 class="pageheader-title"> <? echo $data['page_title']; ?> </h2>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/static/img/admin-lemming.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><? echo $admin['admin_name'] . ' ' . $admin['admin_surname']; ?> </h5>
                                    <span class="status"></span><span class="ml-2">Админ</span>
                                </div>
                                  <a class="dropdown-item" href="/logout"><i class="fas fa-power-off mr-2"></i>Выход</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div id='navbar' class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="d-xl-none d-lg-none" href="/admin/projects">Lemming Group Admin</a

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Меню
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/projects">Проекты</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/services">Услуги</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/news">Новости</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/requests">Запросы</a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i> Штат </a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/admin/users">Сотрудники</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="/admin/teams">Бригады</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/admin/trips">Командировки</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/admin/vacations">Отпуски</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div id='mainbox' class="dashboard-wrapper">
              <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                          <? include_once $content; ?>
                  </div>
              </div>
        </div>
            <script src="/static/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
            <!-- bootstap bundle js -->
            <script src="/static/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
            <!-- slimscroll js -->
            <script src="/static/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
            <!-- main js -->
            <script src="/static/assets/libs/js/main-js.js"></script>

  </body>
  </html>
