<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('User Create') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow mb-4">

                <div class="card-body">

                    <form class="row" wire:submit="save">
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
                        <div class="mb-3 col-6">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" wire:model.blur="password">
                          <div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                </div>
            </div>

        </div>

    </div>
</div>
