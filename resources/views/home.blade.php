@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('page_name')
    {{ $page_title }}
@endsection


@section('content')
   <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-money color-success border-success"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text">Sản phẩm</div>
                            <div class="stat-digit">{{ count($stock_product_data) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text">Khách hàng</div>
                            <div class="stat-digit">{{ count($customers) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text">Nhà cung cấp</div>
                            <div class="stat-digit">{{ count($suppliers) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-link color-danger border-danger"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text">Referral</div>
                            <div class="stat-digit">2,781</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="footer">
                    <p>2023 &copy; Admin Warehouse Management. - <a href="#">wmp.com.vn</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
