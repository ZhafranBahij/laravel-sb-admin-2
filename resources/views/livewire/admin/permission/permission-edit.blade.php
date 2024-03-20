<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Permission Create') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow mb-4">

                <div class="card-body">

                    <form class="row" wire:submit="save">
                        <div class="mb-3 col-6">
                            <label for="name" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" wire:model.blur="name" id="name" aria-describedby="name">
                            <div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-6">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
