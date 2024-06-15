<x-template>
     <div class="mb-3">
         <a href="{{ route('catalog') }}" class="btn btn-secondary">Back</a>
     </div>
     <div class="row">
         <div class="col-lg-5">
             <section>
                 <img src="https://i.etsystatic.com/30157886/r/il/b90110/3176435397/il_570xN.3176435397_8eel.jpg" class="w-100 rounded-3" alt="...">
             </section>
         </div>
         <div class="col-lg-7">
             <div class="mt-3">
                 <section>
                     <h3>{{ $product->name }}</h3>
                     <h1 class="fw-bold text-danger">Rp {{ number_format($product->price, 0, ',', '.') }}</h1>
                 </section>
                 <form class="my-4" method="post">
                     @csrf
                     <button type="submit" class="btn btn-primary btn-lg w-100">
                         Add to cart
                     </button>
                 </form>
                 <section>
                     <div class="fw-semibold mb-2">Description</div>
                     <p>{{ $product->description }}</p>
                 </section>
             </div>
         </div>
     </div>
 </x-template>
 