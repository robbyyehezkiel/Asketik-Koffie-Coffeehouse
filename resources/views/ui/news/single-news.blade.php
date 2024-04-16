<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>


    @include('layouts.partials.breadcrumb')

    <!-- single article section -->
    <div class="mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-article-section">
                        <div class="single-article-text">
                            <div class="single-artcile-bg"></div>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Admin</span>
                                <span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
                            </p>
                            <h2>Pomegranate can prevent heart disease</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint soluta, similique
                                quidem fuga vel voluptates amet doloremque corrupti. Perferendis totam voluptates
                                eius error fuga cupiditate dolorum? Adipisci mollitia quod labore aut natus nobis.
                                Rerum perferendis, nobis hic adipisci vel inventore facilis rem illo, tenetur ipsa
                                voluptate dolorem, cupiditate temporibus laudantium quidem recusandae expedita dicta
                                cum eum. Quae laborum repellat a ut, voluptatum ipsa eum. Culpa fugiat minus laborum
                                quia nam!</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, praesentium, dicta.
                                Dolorum inventore molestias velit possimus, dolore labore aliquam aperiam architecto
                                quo reprehenderit excepturi ipsum ipsam accusantium nobis ducimus laudantium.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum est aperiam
                                voluptatum id cupiditate quae corporis ex. Molestias modi mollitia neque magni
                                voluptatum, omnis repudiandae aliquam quae veniam error! Eligendi distinctio, ab
                                eius iure atque ducimus id deleniti, vel alias sint similique perspiciatis saepe
                                necessitatibus non eveniet, quo nisi soluta.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt beatae nemo
                                quaerat, doloribus obcaecati odio!</p>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end single article section -->

    <x-slot name="footer">

    </x-slot>
</x-app-layout>
