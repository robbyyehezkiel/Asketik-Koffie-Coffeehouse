<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')
    <div class="full-height-section error-section mt-150 mb-150">
        <div class="full-height-tablecell">
            <div class="container">

                <div class="text-center">

                    <x-alert>

                    </x-alert>

                    <!-- Search Form and User Type Filter -->
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <form action="{{ route('users.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="Search by name or email" value="{{ request('search') }}"
                                        aria-label="Search products" style="height: 50px; font-size: 18px;">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('users.index') }}" method="GET" id="userTypeFilterForm">
                                <div class="input-group">
                                    <select class="form-control" name="usertype" onchange="submitForm()"
                                        style="border-radius: 10px; background-color: #f8f9fa; color: #495057; height: 50px; font-size: 18px;">
                                        <option value="all">All</option>
                                        <option value="customer"
                                            {{ request('usertype') == 'customer' ? 'selected' : '' }}>
                                            Customer
                                        </option>
                                        <option value="admin" {{ request('usertype') == 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="superadmin"
                                            {{ request('usertype') == 'superadmin' ? 'selected' : '' }}>
                                            Superadmin
                                        </option>
                                    </select>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- User List -->
                    <table class="table">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->usertype }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            style="display:inline;" id="deleteForm{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="confirmDelete(event, {{ $user->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="footer">
    </x-slot>
</x-app-layout>

<script>
    function submitForm() {
        document.getElementById('userTypeFilterForm').submit();
    }
</script>
