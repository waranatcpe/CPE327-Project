<?php

namespace Inspector\Tests;


use Inspector\Inspector;
use Inspector\Configuration;
use Inspector\Models\Segment;
use PHPUnit\Framework\TestCase;

class AgentTest extends TestCase
{
    /**
     * @var Inspector
     */
    public $inspector;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @throws \Exception
     */
    public function setUp(): void
    {
        $configuration = new Configuration('example-api-key');
        $configuration->setEnabled(false);

        $this->inspector = new Inspector($configuration);
        $this->inspector->startTransaction('transaction-test');
    }

    /**
     * @throws \Inspector\Exceptions\InspectorException
     */
    public function testInspectorInstance()
    {
        $this->assertInstanceOf(Inspector::class, $this->inspector);
    }

    public function testAddEntry()
    {
        $this->assertInstanceOf(
            Inspector::class,
            $this->inspector->addEntries($this->inspector->startSegment('segment-test'))
        );

        $this->assertInstanceOf(
            Inspector::class,
            $this->inspector->addEntries([$this->inspector->startSegment('segment-test')])
        );
    }

    public function testCallbackThrow()
    {
        $this->expectException(\Exception::class);

        $this->inspector->addSegment(function () {
            throw new \Exception('Error in segment');
        }, 'callback', 'test exception throw', true);
    }

    public function testCallbackReturn()
    {
        $return = $this->inspector->addSegment(function () {
            return 'Hello!';
        }, 'callback', 'test callback');

        $this->assertSame('Hello!', $return);
    }

    public function testAddSegmentWithInput()
    {
        $this->inspector->addSegment(function ($segment) {
            $this->assertInstanceOf(Segment::class, $segment);
        }, 'callback', 'test callback', true);
    }

    public function testAddSegmentWithInputContext()
    {
        $segment = $this->inspector->addSegment(function ($segment) {
            return $segment->setContext(['foo' => 'bar']);
        }, 'callback', 'test callback', true);

        $this->assertEquals(['foo' => 'bar'], $segment->context);
    }
}
