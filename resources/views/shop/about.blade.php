<x-shop-layout title="home" >

    <!-- Start About Area -->
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="content-left">
                        <img src="{{ Storage::disk('public')->url('backgroung.jpg') }}" alt="#">
                        <a href="https://www.youtube.com/watch?v=J4OjGf0t2sQ" class="glightbox video"><i
                                class="lni lni-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- content-1 start -->
                    <div class="content-right">
                        <h2>ShopGrids - Your Trusted & Reliable Partner.</h2>
                        <p>
                            At [E-Commerce ShopGrids], we are dedicated to providing a seamless online shopping
                            experience. With a focus on quality, customer satisfaction, and environmental
                            responsibility, we curate a wide range of products for your convenience. Enjoy shopping with
                            us!</p>
                        <p>We believe in the power of technology to transform the way we shop and connect with each
                            other. By leveraging the latest advancements in e-commerce, we aim to create a user-friendly
                            platform that is secure, intuitive, and enjoyable to navigate. We continuously strive to
                            enhance your online shopping experience and provide a seamless checkout process.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <!-- Start Team Area -->
    <section class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Our Core Team</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                    <x-admin-card :admins="$admins"/>
            </div>
        </div>
    </section>
    <!-- End Team Area -->
</x-shop-layout>
