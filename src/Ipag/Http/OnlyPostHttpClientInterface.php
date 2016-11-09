<?php

namespace Ipag\Http;

interface OnlyPostHttpClientInterface
{
    /**
     * @param  string    $url
     * @param  array     $fields
     * @param  \string[] $headers
     * @return string
     */
    public function __invoke($url, array $headers = array(), array $fields = array());
}
