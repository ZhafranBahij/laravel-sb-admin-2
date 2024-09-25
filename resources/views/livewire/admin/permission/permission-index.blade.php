<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Permissions') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow mb-4">

                <div class="card-body">

                    <div class="pl-lg-4 mb-4">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('permission.create') }}" class="btn btn-primary" wire:navigate.hover>Create +</a>
                            </div>
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
                            <th scope="col">Name</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $key => $item)
                                <tr>
                                    <th scope="row">{{ ( $loop->index + 1 ) + ( ( $permissions->currentPage() - 1 ) * 10 )}}</th>
                                    <td>
                                        <a href="{{ route('permission.edit', $item->id) }}" class="btn btn-warning btn-sm"  wire:navigate.hover>
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <button type="button"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Are you sure you want to delete this post?"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                {{ $permissions->links() }}

        </div>

    </div>
</div>
