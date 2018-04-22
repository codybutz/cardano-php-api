<?php
/**
 * Copyright 2018 Cody Butz
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
 * associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING
 * BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace Butz\Cardano\Explorer;

use Butz\Cardano\Explorer\Exceptions\AddressNotFoundException;
use Butz\Cardano\Explorer\Exceptions\ExplorerException;
use Butz\Cardano\Explorer\Models\AddressSummary;
use Butz\Cardano\Explorer\Models\BlockPageSummary;
use Butz\Cardano\Explorer\Models\BlockSummary;
use Butz\Cardano\Explorer\Models\GenesisAddressInfo;
use Butz\Cardano\Explorer\Models\GenesisSummary;
use Butz\Cardano\Explorer\Models\TransactionBrief;
use Butz\Cardano\Explorer\Models\TransactionEntry;
use Butz\Cardano\Explorer\Models\TransactionSummary;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use function GuzzleHttp\Psr7\build_query;

/**
 * Class ExplorerAPI
 * @package Butz\Cardano\Explorer
 *
 * Allows interaction with the Cardano Explorer API.
 */
class ExplorerAPI
{

    /**
     * The base URL to be able to access the Cardano Explorer API.
     *
     * @var string
     */
    private static $baseUri = 'https://cardanoexplorer.com/api/';

    /**
     * The API Client used to connect to the Cardano Explorer API.
     *
     * @var Client
     */
    private $client;

    /**
     * The possible filters that can be used in CAddressesFilter
     *
     * @var array
     */
    private $addressFilters = [
        'all',
        'redeemed',
        'notredeemed'
    ];

    /**
     * ExplorerAPI constructor.
     *
     * @param HandlerStack|null $handler
     */
    public function __construct(HandlerStack $handler = null)
    {
        $this->client = new Client([
            // Base URI is the public Cardano Explorer API.
            'base_uri' => self::$baseUri,
            // 2.5 second timeout on request
            'timeout' => 2.5,
            // Handler
            'handler' => $handler
        ]);
    }

    /**
     * Get summary information about an address.
     *
     * @param $address
     * @return AddressSummary
     * @throws ExplorerException
     * @throws AddressNotFoundException
     */
    public function getAddressSummary($address)
    {
        if (empty($address)) {
            throw new AddressNotFoundException("Address cannot be blank.");
        }

        $data = $this->getExplorer('addresses/summary/' . $address);


        return AddressSummary::fromRequest($data->Right);
    }

    /**
     * Extends the functionality of `get` by adding exception handling.
     *
     * @param $url
     * @return mixed
     * @throws ExplorerException
     */
    private function getExplorer($url)
    {

        $response = $this->get($url);

        $data = \GuzzleHttp\json_decode($response->getBody()->getContents());

        if (isset($data->Left)) {
            if ($data->Left == "Invalid Cardano address!") {
                throw new AddressNotFoundException("Address was not found.");
            }

            throw new ExplorerException($data->Left);
        }


        return $data;
    }

    /**
     * Sends an HTTP request to the Cardano Explorer API.
     *
     * @param $uri string The API to call.
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ExplorerException
     */
    private function get($uri)
    {
        $response = $this->client->get($uri);

        if ($response->getStatusCode() != 200) {
            throw new ExplorerException("Invalid HTTP Response returned (" . $response->getStatusCode() . ").");
        }

        $data = \GuzzleHttp\json_decode($response->getBody()->getContents());

        if (!isset($data->Left) && !isset($data->Right)) {
            throw new ExplorerException("Invalid Data returned, invalid JSON object returned.");
        }

        $response->getBody()->rewind();

        return $response;
    }

    /**
     * Get summary info from a block page.
     *
     * @param int $page
     * @param int $pageSize
     * @return BlockPageSummary
     * @throws ExplorerException
     */
    public function getBlockPages($page = 1, $pageSize = 10)
    {
        $query = build_query([
            'page' => $page,
            'pageSize' => $pageSize
        ]);

        $data = $this->getExplorer('addresses/address/blocks?' . $query);

        return BlockPageSummary::fromResponse($data->Right);
    }

    /**
     * Get total blocks.
     *
     * @param int $pageSize
     * @return integer
     * @throws ExplorerException
     */
    public function getBlockPageTotal($pageSize = 10)
    {
        $query = build_query([
            'pageSize' => $pageSize
        ]);

        $data = $this->getExplorer('addresses/address/blocks/total?' . $query);

        return $data->Right;
    }

    /**
     * Get summary information about an block.
     *
     * @param $hash
     * @return BlockSummary
     * @throws ExplorerException
     */
    public function getBlockSummary($hash)
    {
        $data = $this->getExplorer('blocks/summary/' . $hash);

        return BlockSummary::fromResponse($data->Right);
    }

    /**
     * Get transactions that took place during an block.
     *
     * @param $hash
     * @return array
     * @throws ExplorerException
     */
    public function getBlockTransactions($hash)
    {
        $data = $this->getExplorer('blocks/txs/' . $hash);

        $results = [];

        foreach ($data->Right as $transaction) {
            $results[] = TransactionBrief::fromRequest($transaction);
        }

        return $results;
    }

    /**
     * Get all genesis addresses.
     *
     * @param int $page
     * @param int $pageSize
     * @param string $filter
     *
     * @return array
     * @throws ExplorerException
     */
    public function getGenesisAddresses($page = 1, $pageSize = 15, $filter = 'all')
    {
        if (!in_array($filter, $this->addressFilters)) {
            throw new ExplorerException('Invalid filter given. Must be in: ' . implode(', ', $this->addressFilters));
        }

        $query = build_query([
            'page' => $page,
            'pageSize' => $pageSize,
            'filter' => $filter
        ]);

        $data = $this->getExplorer('genesis/address?' . $query);

        $results = [];

        foreach ($data->Right as $address) {
            $results[] = GenesisAddressInfo::fromRequest($address);
        }

        return $results;
    }

    /**
     * Get the number of pages for a particular genesis address query.
     *
     * @param int $pageSize
     * @param string $filter
     *
     * @return integer
     * @throws ExplorerException
     */
    public function getGenesisAddressesPages($pageSize = 15, $filter = 'all')
    {
        if (!in_array($filter, $this->addressFilters)) {
            throw new ExplorerException('Invalid filter given. Must be in: ' . implode(', ', $this->addressFilters));
        }

        $query = build_query([
            'pageSize' => $pageSize,
            'filter' => $filter
        ]);

        $data = $this->getExplorer('genesis/address/pages/total?' . $query);

        return $data->Right;
    }

    /**
     * Gets the summary of the Genesis Addresses.
     *
     * @return GenesisSummary
     * @throws ExplorerException
     */
    public function getGenesisSummary()
    {
        $data = $this->getExplorer('genesis/summary');

        return GenesisSummary::fromRequest($data->Right);
    }

    /**
     * Get information about the N latest transactions.
     *
     * @return array
     * @throws ExplorerException
     */
    public function getLastTxs()
    {
        $data = $this->getExplorer('txs/last');

        $results = [];

        foreach ($data->Right as $tx) {
            $results[] = TransactionEntry::fromRequest($tx);
        }

        return $results;
    }

    /**
     * Get information about a particular transaction.
     *
     * @param $txid
     * @return TransactionSummary
     * @throws ExplorerException
     */
    public function getTransactionSummary($txid)
    {
        $data = $this->getExplorer('txs/summary/' . $txid);

        return TransactionSummary::fromRequest($data->Right);
    }
}
