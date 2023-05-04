@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        Chi tiết loại hàng
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
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">App-Profile</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="user-profile">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="user-profile-name">john doe</div>
                                    <div class="user-Location">
                                        <i class="ti-location-pin"></i> New York, New York
                                    </div>
                                    <div class="user-job-title">Product Designer</div>
                                    <div class="ratings">
                                        <h4>Ratings</h4>
                                        <div class="rating-star">
                                            <span>8.9</span>
                                            <i class="ti-star color-primary"></i>
                                            <i class="ti-star color-primary"></i>
                                            <i class="ti-star color-primary"></i>
                                            <i class="ti-star color-primary"></i>
                                            <i class="ti-star"></i>
                                        </div>
                                    </div>
                                    <div class="user-send-message">
                                        <button class="btn btn-primary btn-addon" type="button">
                                            <i class="ti-email"></i>Send Message</button>
                                    </div>
                                    <div class="custom-tab user-profile-tab">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#1" aria-controls="1" role="tab"
                                                    data-toggle="tab">About</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="1">
                                                <div class="contact-information">
                                                    <h4>Contact information</h4>
                                                    <div class="phone-content">
                                                        <span class="contact-title">Phone:</span>
                                                        <span class="phone-number">+8801629599859</span>
                                                    </div>
                                                    <div class="address-content">
                                                        <span class="contact-title">Address:</span>
                                                        <span class="mail-address">123, Rajar Goli, South Mugda</span>
                                                    </div>
                                                    <div class="email-content">
                                                        <span class="contact-title">Email:</span>
                                                        <span class="contact-email">hello@Admin Board.com</span>
                                                    </div>
                                                    <div class="website-content">
                                                        <span class="contact-title">Website:</span>
                                                        <span class="contact-website">www.Admin Board.com</span>
                                                    </div>
                                                    <div class="skype-content">
                                                        <span class="contact-title">Skype:</span>
                                                        <span class="contact-skype">Admin Board</span>
                                                    </div>
                                                </div>
                                                <div class="basic-information">
                                                    <h4>Basic information</h4>
                                                    <div class="birthday-content">
                                                        <span class="contact-title">Birthday:</span>
                                                        <span class="birth-date">January 31, 1990 </span>
                                                    </div>
                                                    <div class="gender-content">
                                                        <span class="contact-title">Gender:</span>
                                                        <span class="gender">Male</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
