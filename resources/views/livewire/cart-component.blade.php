<section class="py-3">
    <div class="container px-4 px-lg-5 mt-5">
        @if (Session::has('success_message'))
                <div class="alert alert-success text-center">
                    <strong>Succès : </strong> {{ Session::get("success_message") }}
                </div>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item "><a style="text-decoration:none" class='text-dark' href="{{ route('home') }}">Accueil</a></li>
              <li class="breadcrumb-item active" aria-current="page">Panier</li>
            </ol>
        </nav>

        @if(Cart::count() > 0)

            <div class="row">
                <div class="col-7">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $item )
                                <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->model->name }}</td>
                                <td>{{ $item->model->price }} FCFA</td>
                                <td>
                                    <a href="{{ route('cart.remove', ['rowId' => $item->rowId]) }}" class="btn btn-outline-danger btn-sm">Supprimer</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-5">
                    <fieldset class="border p-2">
                        <legend  class="float-none w-auto"> Résumé de la commande </legend>
                        <div class="container">
                            <hr>

                            <div class="row">
                                <h5 class="col">Sous-total : </h5>
                                <h5 class="col">{{ Cart::subtotal() }} FCFA</h5>
                            </div>
                            <div class="row">
                                <h5 class="col">Taxes : </h5>
                                <h5 class="col"> {{ Cart::tax() }} FCA</h5>
                            </div>
                            <hr>

                            <div class="row">
                                <h5 class="col">Total : </h5>
                                <h5 class="col">{{ Cart::total() }} FCFA</h5>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('checkout') }}" method="post" class="text-center">
                            @csrf
                            <input type="hidden" name="subtotal" value="{{ Cart::subtotal() }}">
                            <button type="submit" class="btn btn-lg btn-outline-success">Payer</button>
                        </form>

                    </fieldset>

                </div>


            </div>
        @else
            <h1 class="text-center text-muted">Aucun produit dans le panier !</h1>
        @endif


    </div>

</section>
