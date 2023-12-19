<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Ticket;
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
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiM2YzNzhlZTQ5MTBmZmZlNDU5ZDJhMmNkMDI4YTQ5YzgwMDFlZWZlMmY3NzlhOTM4NmVjYzVmOWUwY2VjMjcwYmFkMzcyNTJhZTcwYjQ4ZDUiLCJpYXQiOjE3MDI5MzkzNzcuNjU4MTA5LCJuYmYiOjE3MDI5MzkzNzcuNjU4MTExLCJleHAiOjE3MzQ1NjE3NzcuNjQzMTU3LCJzdWIiOiIxMzI5OSIsInNjb3BlcyI6W119.mBD_FcuLkTPWDdPCODUw-GDe-cRH8Es6BvQyKAudY0wgEAYxgPCPKz8ck-o4LTwbMMIB3NjLTfcEcaaQv-L4pl9DapvKUXlUNL4kCtu6_zn-Geauw-2SO8TO87lTiJdISvPAoLV3H0k8sJqhKymo4cYlrA6O45TKs1vWwI9dCdqnq6R7PijrRd9AdT2jQyRxV41NQnwFpQRO326daRSbfsKL97q3cygD9aWQEtc6NsxjG5llyzNRwLtrL1LKiYWZ0CbTC0u4-crvMOHwtdNiNptbWQRJHDRb6q9khvP4UwgFAPWlQmgVf9lwGn96Qg8q62KDJtuId79HA5OxBuowqpCqRmCha2WBQ8pN0RUNjNVApOQ-Jb4gtRsyHvoZrTe9YyZ_hyC7EELrGYuKiD5WCc0EGI5-vvL5oPbxDP70oDRjlLm_71vkiGj8lFGMKID3-8YvOY2zJnOCuJfpCBIlpyBDoPOCn9XcDsz-eC1roJ5W-HD6C_UaUkrtaq-xVeB1E535KZg0KTWElIGuTTao0RKHxPi-18DPBo0QHqUQDLToLi1j9YJTYSB0jnhw4ANVOWKi5FpjBY17MaXX52387G_yV_CxNZf5OIsp3ncIpbABDJLW9UQRAopfCyAeD7fiNlzMoJMvV053IU3DtVn2gidBRzVUhzdBbayrDYj5-zY'
            ];

            $request = Http::withHeaders(
                $headers
            )->post('https://ms.paggue.io/cashin/api/billing_order', [
                'payer_name' => $request->payer_name,
                'amount' => $request->amount,
                'external_id' => $request->external_id,
                'description' => $request->description
            ]);

            return $request;

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
