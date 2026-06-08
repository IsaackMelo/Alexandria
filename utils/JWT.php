<?php

class JWT {

    private static $chave = 'alexandria_chave_secreta_2024';

    // gera token

    public static function gerar($dados) {

        $header = base64_encode(json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]));

        $payload = base64_encode(json_encode([
            'id'    => $dados['id'],
            'email' => $dados['email'],
            'exp'   => time() + (60 * 60 * 24) // expira em 24 horas
        ]));

        $assinatura = base64_encode(hash_hmac(
            'sha256',
            "$header.$payload",
            self::$chave,
            true
        ));

        return "$header.$payload.$assinatura";
    }

    // valida token

    public static function validar($token) {

        $partes = explode('.', $token);

        if (count($partes) !== 3) {
            return null;
        }

        [$header, $payload, $assinatura] = $partes;

        $assinatura_valida = base64_encode(hash_hmac(
            'sha256',
            "$header.$payload",
            self::$chave,
            true
        ));

        if ($assinatura !== $assinatura_valida) {
            return null;
        }

        $dados = json_decode(base64_decode($payload), true);

        if ($dados['exp'] < time()) {
            return null;
        }

        return $dados;
    }

    // pega o token do header

    public static function pegarToken() {

        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (str_starts_with($header, 'Bearer ')) {
            return substr($header, 7);
        }

        return null;
    }
}