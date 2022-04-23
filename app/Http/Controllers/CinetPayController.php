<?php

namespace App\Http\Controllers;

use App\Http\CinetPay;
use Illuminate\Http\Request;

use Psy\Exception\Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class CinetPayController extends Controller
{
    public function checkout(Request $request){
        $cp = new CinetPay(env('CP_SITEID'),  env("CP_APIKEY"));
        $transactionId = $cp->generateTransId() ;

        $formData = array(
            "transaction_id"=> $transactionId,
            "amount"=> $request->subtotal,
            "currency"=> "XOF",
            "customer_surname"=> "Dieke",
            "customer_name"=> "Jonathan",
            "description"=> "Test d'intégration de Cinetpay",
            "notify_url" => route('cp.notify_url'),
            "return_url" => route('cp.return_url'),
            "channels" => "ALL",
            "metadata" => "", // utiliser cette variable pour recevoir des informations personnalisés.
            "alternative_currency" => "",//Valeur de la transaction dans une devise alternative
            //pour afficher le paiement par carte de credit
            "customer_email" => "jonathan.dieke225@gmail.com", //l'email du client
            "customer_phone_number" => "+2250153488836", //Le numéro de téléphone du client
            "customer_address" => "Yopougon", //l'adresse du client
            "customer_city" => "Abidjan", // ville du client
            "customer_country" => "CI",//Le pays du client, la valeur à envoyer est le code ISO du pays (code à deux chiffre) ex : CI, BF, US, CA, FR
            "customer_state" => "CI", //L’état dans de la quel se trouve le client. Cette valeur est obligatoire si le client se trouve au États Unis d’Amérique (US) ou au Canada (CA)
            "customer_zip_code" => "BP 2364" //Le code postal du client
        );

        // enregistrer la transaction dans votre base de donnée
        /*  $commande->create(); */

        $result = $cp->generatePaymentLink($formData);

        if ($result["code"] == '201')
        {
            $url = $result["data"]["payment_url"];

            // ajouter le token à la transaction enregistré
            /* $commande->update(); */
            //redirection vers l'url de paiement
            Cart::destroy();
            header('Location:'.$url);
            exit;

        }
    }

    public function notify(Request $request){
        dd($request);
        // if (isset($_POST['transaction_id']) || isset($_POST['token'])) {

        //     $id_transaction = $_POST['transaction_id'];

        //     try {
        //         // Verification d'etat de transaction chez CinetPay
        //         $CinetPay = new CinetPay($marchand["site_id"], $marchand["apikey"]);

        //         $CinetPay->getPayStatus($id_transaction, $marchand["site_id"]);
        //         $message = $CinetPay->chk_message;
        //         $code = $CinetPay->chk_code;

        //         //recuperer les info du clients pour personnaliser les reponses.
        //         /* $commande->getUserByPayment(); */

        //         // redirection vers une page en fonction de l'état de la transaction
        //         if ($code == '00') {
        //             echo 'Felicitation, votre paiement a été effectué avec succès';
        //             die();
        //         }
        //         else {
        //            // header('Location: '.$commande->getCurrentUrl().'/');
        //             echo 'Echec, votre paiement a échoué';
        //             die();
        //         }

        //     } catch (Exception $e) {
        //         echo "Erreur :" . $e->getMessage();
        //     }
        // } else {
        //     echo 'transaction_id non transmis';
        //     die();

        // }
    }

    public function return(Request $request){
        // dd($request->all());
        if ($request->transaction_id || $request->token) {

            // $commande = new Commande();
            $id_transaction = $request->transaction_id;

            try {
                // Verification d'etat de transaction chez CinetPay
                $CinetPay = new CinetPay(env("site_id"), env("apikey"));

                $CinetPay->getPayStatus($id_transaction, env("site_id"));
                $message = $CinetPay->chk_message;
                $code = $CinetPay->chk_code;

                //recuperer les info du clients pour personnaliser les reponses.
                /* $commande->getUserByPayment(); */

                // redirection vers une page en fonction de l'état de la transaction
                if ($code == '00') {
                    // echo 'Felicitation, votre paiement a été effectué avec succès';
                    return redirect()->route('cp.payment_success');
                    // die();
                }
                else {
                   // header('Location: '.$commande->getCurrentUrl().'/');
                    // echo 'Echec, votre paiement a échoué';
                    return redirect()->route('cp.payment_fail');
                    // die();
                }

            } catch (Exception $e) {
                echo "Erreur :" ;
            }
        } else {
            echo 'transaction_id non transmis';
            die();

        }
    }
}
