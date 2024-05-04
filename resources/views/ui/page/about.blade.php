<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')

    <!-- featured section -->
    <div class="feature-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="featured-text">
                        <h1 class="pb-3">Why <span class="orange-text">Asketik</span></h1>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Fast Service</h3>
                                        <p>Menyediakan kopi Anda dalam waktu singkat dengan pelayanan secepat kilat
                                            dimana respon cepat adalah prioritas kami.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Best Price</h3>
                                        <p>Rasakan nikmatnya penghematan besar tanpa mengurangi rasa dengan harga
                                            kopi kafe kami yang luar biasa.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Custom Coffee</h3>
                                        <p>Rasakan kebebasan memilih dengan beragam penawaran kopi spesial kami,
                                            yang dapat disesuaikan dengan kebutuhan Anda</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Kualitas Premium</h3>
                                        <p>Nikmati pilihan biji kopi terbaik yang dipilih secara cermat, dipanggang
                                            dengan sempurna untuk pengalaman rasa yang tak tertandingi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end featured section -->

    <!-- shop banner -->
    <section class="shop-banner">
        <div class="container">
            <h3>December sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="shop.html" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
    <!-- end shop banner -->

    <!-- single article section -->
    <div class="mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Asketik <span class="orange-text">Koffie</span></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="single-article-section">
                        <div class="single-article-text">
                            <div class="single-artcile-bg"></div>
                            <p>Asketik Koffie merupakan cafe yang
                                bertema rumahan, dengan
                                memanfaatkan teras rumah sebagai
                                tempat usaha yang didirikan oleh
                                Bang Andre dengan jumlah
                                karyawan 3 orang. Asketik koffie
                                beralamat di Jl. Widuri 2 No. 44, Pal
                                Lima, Kec. Kota Baru, Kota Jambi.
                            </p>
                            <p>Caffe ini menyajikan berbagai macam jenis kopi dengan beragam rasa yang lezat dan unik
                                dengan khasnya sendiri.
                                Saat memasuki kedai kopi ini, akan disambut oleh suasana yang hangat, bersih, dan
                                nyaman.</p>
                            <p>Didalamnya, tercium aroma kopi segar yang menggugah selera. Desain interior kedai kopi
                                ini sangat menarik dengan tataan meja dan kursi kayu yang estetik serta tambahan
                                tanaman-tanaman hidup yang membuat caffe ini terasa segar udaranya.
                                Selain itu, ada juga beberapa sudut yang disediakan khusus untuk mereka yang
                                ingin membaca buku.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-section">
                        <div class="recent-posts">
                            <h4>Social Media</h4>
                            <ul>
                                <li><a href="https://m.facebook.com/p/Asketik-Koffie-100087181167935/"><i
                                            class="fab fa-facebook-f"></i> Facebook</a></li>
                                <li><a href="https://www.instagram.com/asketikoffie?igsh=MXNyZWNrYWNkdjZ3Zg=="><i
                                            class="fab fa-instagram"></i> Instagram</a></li>
                                <li><a href="https://www.tiktok.com/@asketikkoffie?_t=8lsSEJsQmVW&_r=1"><i
                                            class="fa-brands fa-tiktok"></i> Tiktok</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="footer">

    </x-slot>
</x-app-layout>
