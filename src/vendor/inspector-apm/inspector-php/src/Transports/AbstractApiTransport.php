<?php

namespace Inspector\Transports;


use Inspector\Configuration;
use Inspector\Exceptions\InspectorException;
use Inspector\Models\Arrayable;

abstract class AbstractApiTransport implements TransportInterface
{
    /**
     * Key to authenticate remote calls.
     *
     * @var Configuration
     */
    protected $config;

    /**
     * Custom url of the proxy if needed.
     *
     * @var string
     */
    protected $proxy;

    /**
     * Queue of messages to send.
     *
     * @var array
     */
    protected $queue = [];

    /**
     * AbstractApiTransport constructor.
     *
     * @param Configuration $configuration
     * @throws InspectorException
     */
    public function __construct(Configuration $configuration)
    {
        $this->config = $configuration;
        $this->verifyOptions($configuration->getOptions());
    }

    /**
     * Verify if given options match constraints.
     *
     * @param $options
     * @throws InspectorException
     */
    protected function verifyOptions($options)
    {
        foreach ($this->getAllowedOptions() as $name => $regex) {
            if (isset($options[$name])) {
                $value = $options[$name];
                if (preg_match($regex, $value)) {
                    $this->$name = $value;
                } else {
                    throw new InspectorException("Option '$name' has invalid value");
                }
            }
        }
    }

    /**
     * Get the current queue.
     *
     * @return array
     */
    public function getQueue(): array
    {
        return $this->queue;
    }

    /**
     * Add a message to the queue.
     *
     * @param array|Arrayable $item
     * @return TransportInterface
     */
    public function addEntry($item): TransportInterface
    {
        if(count($this->queue) <= $this->config->getMaxItems()) {
            $this->queue[] = $item;
        }
        return $this;
    }

    /**
     * Deliver everything on the queue to LOG Engine.
     *
     * @return void
     */
    public function flush()
    {
        if (empty($this->queue)) {
            return;
        }

        $this->send($this->queue);

        $this->queue = [];
    }

    /**
     * Send data chunks based on MAX_POST_LENGTH.
     *
     * @param array $items
     * @return void
     */
    public function send($items)
    {
        $json = json_encode($items);
        $jsonLength = strlen($json);
        $count = count($items);

        if ($jsonLength > $this->config->getMaxPostSize()) {
            if ($count === 1) {
                // It makes no sense to divide into chunks, just try to send via file
                return $this->sendViaFile($json);
            }

            $chunkSize = floor($count / ceil($jsonLength / $this->config->getMaxPostSize()));
            $chunks = array_chunk($items, $chunkSize);

            foreach ($chunks as $chunk) {
                $this->send($chunk);
            }
        } else {
            $this->sendChunk($json);
        }
    }

    /**
     * @param $json
     * @return void
     */
    protected function sendViaFile($json)
    {
        $filepath = __DIR__.DIRECTORY_SEPARATOR.uniqid().'.dat';
        file_put_contents($filepath, $json, LOCK_EX);
        $this->sendChunk('@'.$filepath);
    }

    /**
     * Send a portion of the load to the remote service.
     *
     * @param string $data
     * @return void
     */
    abstract protected function sendChunk($data);

    /**
     * List of available transport's options with validation regex.
     *
     * ['param-name' => 'regex']
     *
     * @return mixed
     */
    protected function getAllowedOptions()
    {
        return [
            'proxy' => '/.+/', // Custom url for
            'debug' => '/^(0|1)?$/',  // boolean
        ];
    }

    /**
     * @return array
     */
    protected function getApiHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-Inspector-Key' => $this->config->getApiKey(),
            'X-Inspector-Version' => $this->config->getVersion(),
        ];
    }
}
