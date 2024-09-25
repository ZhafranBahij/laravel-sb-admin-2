<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('User Edit') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow mb-4">

                <div class="card-body">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary mb-5" wire:navigate.hover><i class="fa-solid fa-arrow-left"></i></a>

                    <form wire:submit="save">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" wire:model.blur="name" id="name" aria-describedby="name">
                                <div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                              </div>
                              <div class="mb-3 col-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" wire:model.blur="last_name" aria-describedby="last_name">
                                <div>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                              </div>
                            <div class="mb-3 col-6">
                              <label for="exampleInputEmail1" class="form-label">Email</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" wire:model.blur="email" aria-describedby="emailHelp">
                              <div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3>Roles</h3>
                        <div class="mb-3 pl-3 row">
                            @foreach ($roles as $key => $item)
                                <div class="form-check col-3">
                                    <input class="form-check-input" type="checkbox" value="{{ $item }}" id="{{ $key }}" wire:model="user_has_roles">
                                    <label class="form-check-label" for="{{ $key }}">
                                        {{ $item }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                </div>
            </div>

        </div>

    </div>
</div>
