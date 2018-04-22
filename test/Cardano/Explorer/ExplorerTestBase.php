<?php namespace Butz\Tests\Cardano\Explorer;

use Butz\Cardano\Explorer\ExplorerAPI;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use StephenHill\Base58;

/**
 * Base class for all test for the Cardano Explorer API wrapper.
 */
class ExplorerTestBase extends TestCase
{
    /**
     * @var ExplorerAPI
     */
    protected $explorer;

    /**
     * @var MockHandler
     */
    protected $mock;

    public function generateRandomAddress()
    {
        $base58 = new Base58();

        return $base58->encode(uniqid('cardano_address_', true));
    }

    /**
     * Set up.
     */
    public function setUp()
    {
        $this->mock = new MockHandler();

        $handler = HandlerStack::create($this->mock);

        $this->explorer = new ExplorerAPI($handler);
    }

    /**
     * Tear down.
     */
    public function tearDown()
    {
    }

    /**
     * Returns a 200 response
     *
     * @param $data string
     * @return Response
     */
    protected function mockSuccess($filename)
    {
        $data = file_get_contents('test/data/' . $filename);

        return new Response(200, ['Content-Type' => 'application/json;charset=utf-8'], $data);
    }

    /**
     * @return Response
     */
    protected function mockNotFound()
    {
        return new Response(404, [], '');
    }
}
