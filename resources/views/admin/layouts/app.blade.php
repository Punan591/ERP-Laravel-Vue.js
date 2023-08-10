<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Punan Chowdhury Creation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
             body {
  font-family: Arial, sans-serif;
}

.sidebar {
  background-color: #ffc107!important; /* This is a yellow color */
  color: #333!important; /* This is a dark gray color */
  width: 250px!important;
  position: fixed!important;
  height: 100%!important;
  overflow: auto!important;
}

.nav-pills .nav-link {
  color: #000!important; /* This is black color */
}

.nav-pills .nav-link:hover {
  color: #5e8c61!important; /* This is a greenish color */
}

.nav-pills .nav-link.active,
.nav-pills .nav-link.active:hover {
  color: #fff!important; /* This is white color */
  background-color: #333333!important; /* This is a greenish color */
}

.image {
  width: 50px!important;
  height: 50px!important;
  border-radius: 50%!important;
  overflow: hidden!important;
  margin-right: 10px!important;
}

.info a {
  color: #000!important; /* This is black color */
}

.info a:hover {
  color: #5e8c61!important; /* This is a greenish color */
}

.nav-icon {
  margin-right: 10px!important;
}

/* This style applies to the logout button */
.nav-item form a {
  color: #000!important; /* This is black color */
}

.nav-item form a:hover {
  color: #5e8c61!important; /* This is a greenish color */
}
.logout-button {
            font-size: 16px;
            padding: 10px 20px;
            color: white;
            background-color: #f44336; /* Red */
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            transition-duration: 0.4s;
            border-radius: 12px;
        }

        .logout-button:hover {
            background-color: white;
            color: black;
        }
         .main-header {
            background-color: #333;
            padding: 10px;
            color: white;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .nav-item {
            float: right;
        }

        .nav-item button.logout-button {
            font-size: 16px;
            padding: 10px 20px;
            color: white;
            background-color: #f44336; /* Red */
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            transition-duration: 0.4s;
            border-radius: 12px;
        }

        .nav-item button.logout-button:hover {
            background-color: white;
            color: black;
        }
        .brand-link {
            display: flex;
            align-items: center;
            background-color: #ffc107; /* Yellow */
            padding: 10px;
            color: black!important;
            text-decoration: none;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            transition-duration: 0.4s;
        }

        .brand-link:hover {
            background-color: #c6a700;
        }

        .brand-image {
            height: 40px;
            margin-right: 10px;
        }

        .brand-text {
            font-weight: lighter;
            font-size: 20px;
        }
        .user-panel {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #ffc107;
            padding: 15px;
            border-radius: 2px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .user-panel:hover {
            transform: translateY(-10px);
        }

        .user-panel .image {
            height: 60px;
            width: 60px;
        }

        .user-panel .image img {
            border-radius: 50%;
            height: 100%;
            width: 100%;
            object-fit: cover;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .user-panel .info {
            flex-grow: 1;
            margin-left: 20px;
            text-align: left;
        }

        .user-panel .info a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                          <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="logout-button" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </button>
                            </form>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="#" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ setting('app_name') }}</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">{{ $user->name }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <router-link to="/admin/dashboard" active-class="active" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/admin/clients" active-class="active" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Client
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/admin/appointments" :class="$route.path.startsWith('/admin/appointments') ? 'active' : ''" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Appointments
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/admin/users" active-class="active" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/admin/settings" active-class="active" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Settings
                                </p>
                            </router-link>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">
            <router-view></router-view>

            <!-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Starter Page</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the card's
                                        content.
                                    </p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the card's
                                        content.
                                    </p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div> -->

        </div>


        <aside class="control-sidebar control-sidebar-dark">

            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>


        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright &copy; {{ date('Y') }} <a href="#">{{ setting('app_name') }}</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleMenuIcon = document.getElementById('toggleMenuIcon');
            const body = document.querySelector('body');

            toggleMenuIcon.addEventListener('click', () => {
                if (body.classList.contains('sidebar-collapse')) {
                    localStorage.setItem('sidebarState', 'expanded');
                } else {
                    localStorage.setItem('sidebarState', 'collapsed');
                }
            });

            const sidebarState = localStorage.getItem('sidebarState');
            if (sidebarState === 'collapsed') {
                body.classList.add('sidebar-collapse');
            }
        });
    </script>
</body>

</html>
