<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')
    <div class="full-height-section error-section mt-150 mb-150">
        <div class="full-height-tablecell">
            <div class="container">
                <h2>User Details</h2>
                <div class="card">
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Usertype:</strong> {{ $user->usertype }}</p>
                        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
                        <!-- Add more details as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="footer">
    </x-slot>
</x-app-layout>
