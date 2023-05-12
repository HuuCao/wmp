<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>@yield('title') | WMP</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="{{ asset('css/lib/calendar2/pignose.calendar.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/lib/chartist/chartist.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/lib/weather-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/lib/menubar/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="" />
                            <span>WMP</span>
                        </a>
                    </div>
                    {{-- Tổng quan --}}
                    <li>
                        <a href="{{ route('home') }}"><i class="ti-home"></i>Tống quan</a>
                    </li>

                    {{-- Thiết lập dữ liệu --}}
                    <li class="label">
                        Thiết lập dữ liệu
                    </li>
                    <li>
                        <a class="sidebar-sub-toggle">
                            <i class="ti-settings"></i> Thiết lập dữ liệu
                            <span class="sidebar-collapse-icon ti-angle-down"></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('categories.index') }}">Loại hàng</a></li>
                            <li><a href="{{ route('units.index') }}">Đơn vị</a></li>
                            <li><a href="{{ route('shelves.index') }}">Kệ hàng</a></li>
                            <li><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('suppliers.index') }}"><i class="ti-user"></i>Nhà cung cấp</a></li>
                    <li><a href="{{ route('customers.index') }}"><i class="ti-user"></i>Khách hàng</a></li>

                    {{-- Dữ liệu nhập xuất --}}
                    <li class="label">Dữ liệu nhập xuất</li>
                    <li>
                        <a class="sidebar-sub-toggle"><i class="ti-cloud-down"></i>Dữ liệu nhập hàng
                            <span class="sidebar-collapse-icon ti-angle-down"></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('stock-inward.index') }}">Nhập hàng</a></li>
                            <li><a href="ui-alerts.html">Sản phẩm đã nhập</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sidebar-sub-toggle">
                            <i class="ti-cloud-up"></i> Dữ liệu xuất hàng
                            <span class="sidebar-collapse-icon ti-angle-down"></span>
                        </a>
                        <ul>
                            <li><a href="uc-calendar.html">Xuất hàng</a></li>
                            <li><a href="uc-carousel.html">Sản phẩm đã xuất</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="ti-package"></i>Dữ liệu kho hàng</a></li>

                    {{-- Báo cáo thống kê --}}
                    <li class="label">Báo cáo thống kê</li>
                    <li><a href="#"><i class="ti-stats-up"></i>Thống kê nhập xuất tồn đầu</a></li>
                    <li><a href="#"><i class="ti-money"></i>Thống kê doanh thu</a></li>
                    <li><a href="#"><i class="ti-book"></i>Thống kê SL hàng bán ra</a></li>

                    {{-- Thông tin quản trị --}}
                    <li class="label">Thông tin quản trị</li>
                    <li><a href="{{ route('users.index') }}"><i class="ti-list"></i>Danh sách người dùng</a></li>
                    <li><a href="{{ route('users.create') }}"><i class="ti-plus"></i>Tạo người dùng</a></li>
                    <li><a href="{{ route('roles.index') }}"><i class="ti-thumb-up"></i>Phân quyền người dùng</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <div class="drop-down dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">Recent Notifications</span>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="images/avatar/3.jpg"
                                                        alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">5 members joined today </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="images/avatar/3.jpg"
                                                        alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mariam</div>
                                                        <div class="notification-text">likes a photo of you</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="images/avatar/3.jpg"
                                                        alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Tasnim</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="images/avatar/3.jpg"
                                                        alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="more-link">See All</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <i class="ti-email"></i>
                                <div class="drop-down dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">2 New Messages</span>
                                        <a href="email.html">
                                            <i class="ti-pencil-alt pull-right"></i>
                                        </a>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li class="notification-unread">
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="images/avatar/1.jpg"
                                                        alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Michael Qin</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="notification-unread">
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="images/avatar/2.jpg"
                                                        alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="images/avatar/3.jpg"
                                                        alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Michael Qin</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="images/avatar/2.jpg"
                                                        alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="more-link">See All</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">{{ Auth::user()->name }}
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="ti-email"></i>
                                                    <span>Inbox</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-settings"></i>
                                                    <span>Setting</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="ti-lock"></i> <span>Logout</span>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>
                                    @yield('page_name')
                                </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">@yield('page_title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.nanoscroller.min.js') }}"></script>
    <script src="{{ asset('js/lib/select2.min.js') }}"></script>
    <!-- nano scroller -->
    <script src="{{ asset('js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ asset('js/lib/preloader/pace.min.js') }}"></script>
    <!-- sidebar -->

    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- bootstrap -->

    <script src="{{ asset('js/lib/calendar-2/moment.latest.min.js') }}"></script>
    <script src="{{ asset('js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
    <script src="{{ asset('js/lib/calendar-2/pignose.init.js') }}"></script>


    <script src="{{ asset('js/lib/weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('js/lib/weather/weather-init.js') }}"></script>
    <script src="{{ asset('js/lib/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('js/lib/circle-progress/circle-progress-init.js') }}"></script>
    {{-- <script src="{{ asset('js/lib/chartist/chartist.min.js') }}"></script> --}}
    <script src="{{ asset('js/lib/sparklinechart/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/lib/sparklinechart/sparkline.init.js') }}"></script>
    <script src="{{ asset('js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/lib/owl-carousel/owl.carousel-init.js') }}"></script>
    <!-- scripit init-->
    <script src="{{ asset('js/dashboard2.js') }}"></script>
    <script src="{{ asset('js/dashboard2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".js-select2-multi").select2();

            var searchInput = $('#search-input');
            var searchResults = $('#search-results');
            var productList = $('#product-list');
            var productIndex = 1;

            searchInput.on('input', function() {
                var query = $(this).val();

                if (query.length >= 0) {
                    $.ajax({
                        url: '{{ route('products.search') }}',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        dataType: 'json',
                        success: function(response) {
                            searchResults.empty();

                            if (response.length > 0) {
                                $.each(response, function(index, product) {
                                    var listItem = $('<li>').text(product.name_product);
                                    listItem.attr('data-product-id', product.id);
                                    searchResults.append(listItem);
                                });
                            } else {
                                var listItem = $('<li>').text('No results found');
                                searchResults.append(listItem);
                            }
                        }
                    });
                } else {
                    searchResults.empty();
                }
            });
            searchResults.on('click', 'li', function() {
                var productId = $(this).attr('data-product-id');
                var productName = $(this).text();
                addProductToTable(productId, productName);
                $(this).remove();
                searchInput.val('');
            });

            function addProductToTable(productId, productName) {
                var row = $('<tr>');
                row.attr('id', 'product-row-' + productIndex);
                var productCell = $('<td>').text(productName);
                var quantityCell = $('<td>');
                var quantityInput = $('<input>');
                quantityInput.attr('type', 'number');
                quantityInput.attr('name', 'products[' + productIndex + '][quantity]');
                quantityCell.append(quantityInput);
                row.append(productCell);
                row.append(quantityCell);
                productList.append(row);
                productIndex++;
            }
        });

        $('#unitForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Đã tạo thành công đơn vị!');
                        $('#unitForm')[0].reset();
                        $('#createUnitModal').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        displayValidationErrors(errors);
                    } else {

                    }
                }
            });
        });

        $('#categoryForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Đã tạo thành công loại hàng!');
                        $('#categoryForm')[0].reset();
                        $('#createCategoryModal').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        displayValidationErrors(errors);
                    } else {

                    }
                }
            });
        });

        $('#supplierForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Đã tạo thành công nhà cung cấp!');
                        $('#supplierForm')[0].reset();
                        $('#createSupplierModal').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        displayValidationErrors(errors);
                    } else {

                    }
                }
            });
        });

        $('#shelvesForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Đã tạo thành công kệ hàng!');
                        $('#shelvesForm')[0].reset();
                        $('#createShelvesModal').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        displayValidationErrors(errors);
                    } else {

                    }
                }
            });
        });

        function displayValidationErrors(errors) {
            for (var field in errors) {
                var errorMessage = errors[field][0];
                $('#' + field).addClass('is-invalid');
                $('#' + field).after('<div class="invalid-feedback">' + errorMessage + '</div>');
            }
        }
    </script>

    <script>
        // ============= UPLOAD IMAGE ============= //
        const inputLogo = document.getElementById("image");
        const previewLogo = document.getElementById("output_image");

        // check if the preview image is stored in local storage
        const storedImageLogo = localStorage.getItem("image");
        if (storedImageLogo) {
            previewLogo.src = storedImageLogo;
            previewLogo.style.display = "block";
        }

        inputLogo.addEventListener("change", function() {
            const file = this.files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                previewLogo.src = reader.result;
                previewLogo.style.display = "block";
                localStorage.setItem("image", reader.result);
            });

            reader.readAsDataURL(file);
        });
        window.onbeforeunload = function() {
            localStorage.removeItem("image");
        };
        // ============= END UPLOAD IMAGE ============= //
    </script>
</body>

</html>
