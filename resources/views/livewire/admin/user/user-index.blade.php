<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Users') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow mb-4">

                <div class="card-body">

                    <div class="pl-lg-4 mb-4">
                        <div class="row">
                            @can('create users')
                                <div class="col-6">
                                    <a href="{{ route('user.create') }}" class="btn btn-primary" wire:navigate.hover>Create +</a>
                                </div>
                            @endcan
                            <div class="col-6">
                                <!-- Topbar Search -->
                                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" wire:model.live="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Action</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Email</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $item)
                                <tr>
                                    <th scope="row">{{ ( $loop->index + 1 ) + ( ( $users->currentPage() - 1 ) * 10 )}}</th>
                                    <td>
                                        @can('edit users')
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm" wire:navigate.hover>
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('delete users')
                                            <button type="button"
                                            wire:click="delete({{ $item->id }})"
                                            wire:confirm="Are you sure you want to delete this post?"
                                            class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($item->roles as $role)
                                            <li>
                                                {{ $role->name }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                {{ $users->links() }}

        </div>

    </div>
</div>
