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

namespace Butz\Cardano\Explorer\Models;

/**
 * Class AddressSummary
 * @package Butz\Cardano\Explorer\Models
 */
class AddressSummary
{

    /**
     * The address of associated with the summary.
     *
     * @var string
     */
    private $address;

    /**
     * $type ∈ { CPubKeyAddress , CScriptAddress , CRedeemAddress , CUnknownAddress }
     *
     * @var string
     */
    private $type;

    /**
     * The transaction number (0 <= txNum <= 18446744073709552000)
     *
     * @var integer
     */
    private $txNum;

    /**
     * The balance
     *
     * @var Coin
     */
    private $balance;

    /**
     * The transaction list.
     *
     * @var array
     */
    private $txList = [];

    /**
     * Is redeemed?
     *
     * @var boolean
     */
    private $redeemed;

    /**
     * AddressSummary constructor.
     */
    private function __construct()
    {
        //empty
    }

    /**
     * Transforms the API response into an AddressSummary.
     *
     * @param $data
     * @return AddressSummary
     */
    public static function fromRequest($data)
    {
        $summary = new AddressSummary();

        $summary->address = $data->caAddress;
        $summary->type = $data->caType;
        $summary->txNum = $data->caTxNum;
        $summary->redeemed = isset($data->caIsRedeemed) ? $data->caIsRedeemed : false;
        $summary->balance = Coin::fromRequest($data->caBalance);

        foreach ($data->caTxList as $transaction) {
            $summary->txList[] = TransactionBrief::fromRequest($transaction);
        }

        return $summary;
    }

    /**
     * The address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * The type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * The transaction number
     *
     * @return int
     */
    public function getTxNum()
    {
        return $this->txNum;
    }

    /**
     * The balance
     *
     * @return Coin
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * The transaction list.
     *
     * @return array
     */
    public function getTxList()
    {
        return $this->txList;
    }

    /**
     * Is redeemed?
     *
     * @return bool
     */
    public function isRedeemed()
    {
        return $this->redeemed;
    }
}
