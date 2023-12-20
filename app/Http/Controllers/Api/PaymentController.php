<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\PaymentJob;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function billingOrder(Request $request)
    {
        try {
            $headers = [
                'X-Company-ID' => '11658',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => env('BEARER_INTEGRATION')
            ];

            $body = [
                'payer_name' => $request->payer_name,
                'amount' => $request->amount,
                'external_id' => $request->external_id,
                'description' => $request->description
            ];

            PaymentJob::dispatch($headers, $body, $request->payer_name, $request->amount, $request->description);

            return response()->json([
                'Pagamento processado.'
            ]);

        } catch (Exception $e){
            return response()->json(['$response' => 'Error'], 500);
        }
    }

    public function isValid(Request $request)
    {
        /**
         * Pega a assinatura que vem no header Signature
         */
        $signature = $request->header('Signature');
        if (!$signature) {
            return false;
        }
        $signingSecret = 'IRDQERSZRQGBTIPXENQLJUZ8MZ10JNVOOOL5IU4OPZW6DLHQTP7IZK5CQ775Q37IFEPJJ1WAUDQX63TP6LNGRH4WBR02CJRAZTDJ';
        /**
         * Nesse ponto você vai criar do seu lado um hash de assinatura
         * e utilizar ele para comparar com o hash assinado enviado na request
         * Se as chaves $signature e $computedSignature
         *
         * O getContent inclui todo o conteudo da request, nao apenas o body
         */
        $computedSignature = hash_hmac('sha256', $request->getContent(), $signingSecret);
        /**
         * Verificar se as duas chaves são iguais
         * Se forem iguais significa que não houve nenhuma alteração na requisição e o Body é confiável
         * @return bool Returns TRUE quando as duas strings são iguais.
         */
        return hash_equals($signature, $computedSignature);
    }
}
