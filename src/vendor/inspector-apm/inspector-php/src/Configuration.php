<?php

namespace Inspector;


class Configuration
{
    /**
     * Remote endpoint to send data.
     *
     * @var string
     */
    protected $url = 'https://ingest.inspector.dev';

    /**
     * Authentication key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * Max numbers of items to collect in a single session.
     *
     * @var int
     */
    protected $maxItems = 100;

    /**
     * @var string
     */
    protected $transport = 'async';

    /**
     * @var string
     */
    protected $version = '3.3.6';

    /**
     * Transport options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Environment constructor.
     *
     * @param null|string $apiKey
     * @throws \InvalidArgumentException
     */
    public function __construct($apiKey = null)
    {
        if(is_string($apiKey)) {
            $this->setApiKey($apiKey);
        } else {
            $this->setEnabled(false);
        }
    }

    /**
     * Max size of a POST request content.
     *
     * @return  integer
     */
    public function getMaxPostSize()
    {
        return OS::isWin() ? 8000 : 65536;
    }

    /**
     * Set ingestion url.
     *
     * @param string $value
     * @return Configuration
     */
    public function setUrl($value): Configuration
    {
        $value = trim($value);

        if (empty($value)) {
            throw new \InvalidArgumentException('Invalid URL');
        }

        $this->url = $value;
        return $this;
    }

    /**
     * Get ingestion endpoint.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Verify if api key is well formed.
     *
     * @param $value
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setApiKey($value)
    {
        $value = trim($value);

        if (empty($value)) {
            throw new \InvalidArgumentException('API key cannot be empty');
        }

        $this->apiKey = $value;
        return $this;
    }

    /**
     * Get current API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return int
     */
    public function getMaxItems(): int
    {
        return $this->maxItems;
    }

    /**
     * @param int $maxItems
     * @return Configuration
     */
    public function setMaxItems(int $maxItems): Configuration
    {
        $this->maxItems = $maxItems;
        return $this;
    }

    /**
     * Transport options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Add a new entry in the options list.
     *
     * @param string $key
     * @param $value
     * @return Configuration
     */
    public function addOption($key, $value): Configuration
    {
        $this->options[$key] = $value;
        return $this;
    }

    /**
     * Override the transport options.
     *
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Check if data transfer is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return isset($this->apiKey) && is_string($this->apiKey) && $this->enabled;
    }

    /**
     * Enable/Disable data transfer.
     *
     * @param bool $enabled
     * @return $this
     */
    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get current transport method.
     *
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set the preferred transport method.
     *
     * @param string $transport
     * @return $this
     */
    public function setTransport(string $transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * Get the package version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the package version.
     *
     * @param string $value
     * @return $this
     */
    public function setVersion($value)
    {
        $this->version = $value;
        return $this;
    }
}
