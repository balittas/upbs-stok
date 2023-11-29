@extends('user.layouts.app')

@section('content')

<!-- ##### Breadcrumb Area Start ##### -->
{{-- <div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center"
        style="background-image: url('assets/frontend/img/bg-img/24.jpg;);">
        <h2>Detail Produk</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
<!-- ##### Breadcrumb Area End ##### -->
<!-- ##### Contact Area Info Start ##### -->
<div class="contact-area-info section-padding-0-100">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <!-- Contact Thumbnail -->
            <div class="col-12 col-md-6">
                <div class="contact--thumbnail">
                    <img src="{{url('alazea-gh-pages/img/bg-img/balittas.jpg')}}" alt="">
                </div>
            </div>

            <div class="col-12 col-md-5">
                <!-- Section Heading -->
                <div class="section-heading">
                    <h2>CONTACT US</h2>
                    <p>Balai Pengujian Standar Instrumen Tanaman Pemanis dan Serat (BSIP-TAS).</p>
                </div>
                <!-- Contact Information -->
                <div class="contact-information">
                    <p><span>Alamat:</span> Jalan Raya Karangploso Km 4 , Kotak Pos 199, Kabupaten Malang
                        Jawa Timur, Indonesia</p>
                    <p><span>Phone:</span> (0341) 491447 / (0341) 485121</p>
                    <p><span>Email:</span> bsip.tanamanpemanis@pertanian.go.id </p>
                </div><br>
            </div>
        </div>
    </div>
</div>
<!-- ##### Contact Area Info End ##### -->

<!-- ##### Contact Area Start ##### -->
<section class="contact-area">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            {{-- <div class="col-12 col-lg-5">
                <!-- Section Heading -->
                <div class="section-heading">
                    <h2>GET IN TOUCH</h2>
                    <p>Send us a message, we will call back later</p>
                </div>
                <!-- Contact Form Area -->
                <!-- cek git -->
                <div class="contact-form-area mb-100">
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contact-name" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="contact-email" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contact-subject" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn alazea-btn mt-15">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}

            <div class="col-12 col-lg-12">
                <!-- Google Maps -->
                <div class="map-area mb-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15807.444428660874!2d112.6227342!3d-7.9095748!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7881e8795c6f71%3A0xceec556ddda3e8c0!2sBSIP%20TAS!5e0!3m2!1sid!2sid!4v1701247665123!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->
@endsection
