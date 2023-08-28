 <div class="col-md-6 my-4 ">
     <form wire:submit.prevent='register'>
{{$password}}
         <div class="my-2">
             @if (session()->has('message'))
                 <div class="alert alert-success">
                     {{ session('message') }}
                 </div>
             @endif
         </div>
         <h1>register</h1>
         <div class="mb-3">
             <label for="" class="form-label">Name</label>
             <input type="text" name="name" id="" class="form-control" placeholder="name"
                 wire:model.lazy="name" aria-describedby="helpId">
             @error('name')
                 <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
         <div class="mb-3">
             <label for="" class="form-label">email</label>
             <input type="email" name="email" id="" class="form-control" placeholder="email"
                 wire:model.lazy="email" aria-describedby="helpId">
             @error('email')
                 <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
         <div class="mb-3">
             <label for="" class="form-label">password :</label>
             <input type="password" name="password" id="" class="form-control" placeholder="password"
                 wire:model.lazy="password" aria-describedby="helpId">
             @error('password')
                 <span class="text-danger">{{ $message }}</span>
             @enderror

         </div>

         <div class="mb-3">
             <button type="submit" class="btn btn-primary">register</button>

         </div>

     </form>


 </div>
