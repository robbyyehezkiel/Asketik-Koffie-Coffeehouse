<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')
    <!-- error section -->
    <div class="full-height-section error-section mt-150 mb-150">
        <div class="full-height-tablecell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="error-text">
                            <i class="far fa-sad-cry"></i>
                            <h1>Oops! Not Found.</h1>
                            <p>The page you requested for is not found.</p>
                            <a href="index.html" class="boxed-btn">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end error section -->
    <x-slot name="footer">

    </x-slot>
</x-app-layout>
