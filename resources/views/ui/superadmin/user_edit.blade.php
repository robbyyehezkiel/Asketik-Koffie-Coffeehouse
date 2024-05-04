<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')
    <div class="full-height-section error-section mt-150 mb-150">
        <div class="full-height-tablecell">
            <div class="container">

                <h2>Edit User</h2>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <select class="form-control" id="user_type" name="usertype">
                            <option value="customer" {{ $user->usertype == 'customer' ? 'selected' : '' }}>Customer
                            </option>
                            <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="footer">
    </x-slot>
</x-app-layout>
