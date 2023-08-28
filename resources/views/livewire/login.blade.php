 <div class="col-md-6 my-4 ">
     <form wire:submit.prevent='login'>

         <div class="my-2">
             @if (session()->has('message'))
                 <div class="alert alert-success">
                     {{ session('message') }}
                 </div>
             @endif
         </div>
         {{$email}}
         {{$password}}
         <h1>login</h1>

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
             <button type="submit" class="btn btn-primary">login</button>

         </div>

     </form>


 </div>
