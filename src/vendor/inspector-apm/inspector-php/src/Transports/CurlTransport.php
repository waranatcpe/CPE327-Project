<?php

namespace Inspector\Transports;


use Inspector\Configuration;
use Inspector\Exceptions\InspectorException;

class CurlTransport extends AbstractApiTransport
{
    /**
     * CurlTransport constructor.
     *
     * @param Configuration $configuration
     * @throws InspectorException
     */
    public function __construct($configuration)
    {
        // System need to have CURL available
        if (!function_exists('curl_init')) {
            throw new InspectorException('cURL PHP extension is not available');
        }

        parent::__construct($configuration);
    }

    /**
     * Deliver items to Inspector.
     *
     * @param string $data
     */
    public function sendChunk($data)
    {
        $headers = [];

        foreach ($this->getApiHeaders() as $name => $value) {
            $headers[] = "$name: $value";
        }

        $handle = curl_init($this->config->getUrl());

        curl_setopt($handle, CURLOPT_POST, 1);

        // Tell cURL that it should only spend 10 seconds trying to connect to the URL in question.
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        // A given cURL operation should only take 30 seconds max.
        curl_setopt($handle, CURLOPT_TIMEOUT, 10);

        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
        if ($this->proxy) {
            curl_setopt($handle, CURLOPT_PROXY, $this->proxy);
        }
        $response = curl_exec($handle);
        $errorNo = curl_errno($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $error = curl_error($handle);

        // 200 OK
        // 403 Account has reached no. transactions limit
        if (0 !== $errorNo || (200 !== $code && 201 !== $code && 403 !== $code)) {
            error_log(date('Y-m-d H:i:s') . " - [Warning] [" . get_class($this) . "] $error - $code $errorNo");
        }

        curl_close($handle);
    }
}
