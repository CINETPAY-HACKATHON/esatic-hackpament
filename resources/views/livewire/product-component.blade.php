<div class="col mb-5">
    <div class="card h-100">
    <!-- Product image-->
    <img
        class="card-img-top"
        src="{{ asset("assets/images") }}/{{ $product->image }}"
        alt="{{ $product->name }}"
    />
    <!-- Product details-->
    <div class="card-body p-4">
        <div class="text-center">
        <!-- Product name-->
        <h5 class="fw-bolder">{{ $product->name }}</h5>
        <!-- Product price-->
        {{ $product->price }} FCFA
        </div>
    </div>
    <!-- Product actions-->
    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        <div class="text-center">
            <a class="btn btn-outline-success mt-auto"  onclick="event.preventDefault(); document.getElementById('form-{{ $product->slug }}').submit()">Ajouter au panier</a>
            <form action="{{ route('cart.add') }}" method="get" id='form-{{ $product->slug }}'>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="product_name" value="{{ $product->name }}">
                <input type="hidden" name="product_price" value="{{ $product->price }}">
            </form>
        </div>
    </div>
    </div>
</div>
