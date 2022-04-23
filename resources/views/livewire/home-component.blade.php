<div>
     <!-- Header-->
     <header class="bg-dark py-5" style="background-image: url('{{ asset('assets/images/S3.jpg') }}')">
        <div class="container px-4 px-lg-5 my-5">
          <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">#CinetPay</h1>
            <p class="lead fw-normal text-white-50 mb-0">Hackathon Ecole 2022</p>
          </div>
        </div>
      </header>
      <!-- Section-->
      <section class="py-5">
          <div class="container px-4 px-lg-5 mt-5">
            @if (Session::has('success_message'))
                <div class="alert alert-success text-center">
                    <strong>Succès : </strong> {{ Session::get("success_message") }}
                </div>
            @endif
          <div  class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" >
              @foreach ($products as $product)
               @livewire("product-component", ["product" => $product])
              @endforeach
          </div>
          {{ $products->links() }}
        </div>
      </section>
</div>
