<?php

namespace Ipag\Http;

/**
 * @codeCoverageIgnoreFile
 */
final class CurlOnlyPostHttpClient implements OnlyPostHttpClientInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke($url, array $headers = array(), array $fields = array())
    {
        $headers = array_map(
            function ($name, $value) {
                return sprintf('%s: %s', $name, $value);
            },
            array_keys($headers),
            array_values($headers)
        );

        $curl = curl_init();

        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSLVERSION, 6);
        curl_setopt($curl, CURLOPT_USERAGENT, 'IPAG_SDK_PHP/1.2');
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2TLS);

        $return = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new \Exception('Curl error: ' . curl_error($curl));
        }
        curl_close($curl);
        return $return;
    }
}
