<div class="container">
    <div class="row ">
        <div class="col-md-6 my-4 mx-auto ">
            <form wire:submit.prevent='addContact'>
                <div class="my-2">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" id="" class="form-control" placeholder="name"
                        wire:model.lazy="name" aria-describedby="helpId">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">tel</label>
                    <input type="tel" name="tel" id="" class="form-control" placeholder="tel"
                        wire:model.lazy="tel" aria-describedby="helpId">
                    @error('tel')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">photo :</label>
                    <input type="file" name="photo" id="" class="form-control" placeholder="photo"
                        wire:model.lazy="photo" aria-describedby="helpId">
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="my-2">

                        @if ($photo)
                            Photo Preview:
                            <img  class="img-thumbnail w-25" src="{{ $photo->temporaryUrl() }}">
                        @endif
                    </div>
                </div>
                @if ($editing)
                    <div class="mb-3">
                        <div class="d-flex  justify-content-evenly px-3">
                            <button class="btn btn-warning" type="button" wire:click="updateContact">edit</button>
                            <button class="btn btn-danger" type="button" wire:click="cancel">cancel</button>
                        </div>
                    </div>
                @else
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">submit</button>

                    </div>
                @endif
            </form>
            <ul class="list-group">

                @foreach ($contactsList as $contact)
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                        <div class=" w-25 text-start d-flex">
                               @if ($contact->photo)

                            <img  width="100" height="100" class="img-thumbnail " src="{{ asset("storage/photos/".$contact->photo) }}">
                        @endif
                        </div>
                        <div class=" w-25 text-start d-flex"> <i class="fa fa-user px-3 text-start"
                                aria-hidden="true"></i><span class=""> {{ $contact['name'] }}</span></div>
                        <div class=" w-25 text-start d-flex"><i class="fa fa-phone px-3 text-start"
                                aria-hidden="true"></i><span class="">{{ $contact['tel'] }}</span></div>
                        <div class="w-25 d-flex justify-content-evenly">
                            <button class="btn btn-warning" type="button"><i class="fa fa-edit"
                                    wire:click='getContact({{ $contact->id }})' aria-hidden="true"></i></button>
                            <button class="btn btn-danger" wire:click="deleteContact({{ $contact->id }})"
                                type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </li>
                @endforeach
                <div class="my-2">

                    {{ $contactsList->links() }}
                </div>

            </ul>

        </div>


    </div>
</div>
