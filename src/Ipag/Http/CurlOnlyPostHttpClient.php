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

        $fields_string ='';
        foreach ($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');

        curl_setopt( $curl, CURLOPT_URL, $url );
        curl_setopt( $curl, CURLOPT_POST, true );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $fields_string );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl, CURLOPT_HEADER, false);
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)' );
        curl_setopt( $curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );

        $return = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new \Exception('Curl error: '.curl_error($curl));
        }
        curl_close($curl);
        return $return;
    }
}
