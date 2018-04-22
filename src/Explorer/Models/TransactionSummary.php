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
 * Class TransactionSummary
 * @package Butz\Cardano\Explorer\Models
 */
class TransactionSummary
{
    /**
     * The id
     *
     * @var string
     */
    private $id;

    /**
     * The time issued
     *
     * @var integer
     */
    private $timeIssued;

    /**
     * The block time issued
     *
     * @var integer
     */
    private $blockTimeIssued;

    /**
     * The block height
     *
     * @var integer
     */
    private $blockHeight;

    /**
     * The block epoch
     *
     * @var integer
     */
    private $blockEpoch;

    /**
     * The block slot
     *
     * @var integer
     */
    private $blockSlot;

    /**
     * The block hash
     *
     * @var string
     */
    private $blockHash;

    /**
     * The relayed by network address
     *
     * @var string
     */
    private $relayedBy;

    /**
     * The total input
     *
     * @var Coin
     */
    private $totalInput;

    /**
     * The total output
     *
     * @var Coin
     */
    private $totalOutput;

    /**
     * The total fees
     *
     * @var Coin
     */
    private $fees;

    /**
     * The inputs
     *
     * @var array
     */
    private $inputs = [];

    /**
     * The outputs
     *
     * @var array
     */
    private $outputs = [];

    /**
     * TransactionSummary constructor.
     */
    private function __construct()
    {
        //empty
    }

    /**
     * Takes an object from a response and translates into a TransactionSummary Object.
     *
     * @param $data
     * @return TransactionSummary
     */
    public static function fromRequest($data)
    {
        $transaction = new TransactionSummary();

        $transaction->id = $data->ctsId;
        $transaction->timeIssued = $data->ctsTxTimeIssued;
        $transaction->blockTimeIssued = $data->ctsBlockTimeIssued;
        $transaction->blockHeight = $data->ctsBlockHeight;
        $transaction->blockEpoch = $data->ctsBlockEpoch;
        $transaction->blockSlot = $data->ctsBlockSlot;
        $transaction->blockHash = $data->ctsBlockHash;
        $transaction->relayedBy = $data->ctsRelayedBy;

        $transaction->fees = Coin::fromRequest($data->ctsFees);
        $transaction->totalInput = Coin::fromRequest($data->ctsTotalInput);
        $transaction->totalOutput = Coin::fromRequest($data->ctsTotalOutput);

        foreach ($data->ctsOutputs as $output) {
            $transaction->outputs[] = TransactionIO::fromRequest($output);
        }

        foreach ($data->ctsInputs as $input) {
            $transaction->inputs[] = TransactionIO::fromRequest($input);
        }

        return $transaction;
    }

    /**
     * The id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get time issued.
     *
     * @return int
     */
    public function getTimeIssued()
    {
        return $this->timeIssued;
    }

    /**
     * The block time issued
     *
     * @return int
     */
    public function getBlockTimeIssued()
    {
        return $this->blockTimeIssued;
    }

    /**
     * The block height
     *
     * @return int
     */
    public function getBlockHeight()
    {
        return $this->blockHeight;
    }

    /**
     * The block epoch
     *
     * @return int
     */
    public function getBlockEpoch()
    {
        return $this->blockEpoch;
    }

    /**
     * The block slot
     *
     * @return int
     */
    public function getBlockSlot()
    {
        return $this->blockSlot;
    }

    /**
     * The block hash
     *
     * @return string
     */
    public function getBlockHash()
    {
        return $this->blockHash;
    }

    /**
     * The relayed bby network address
     *
     * @return string
     */
    public function getRelayedBy()
    {
        return $this->relayedBy;
    }

    /**
     * The total input
     *
     * @return Coin
     */
    public function getTotalInput()
    {
        return $this->totalInput;
    }

    /**
     * The total output
     *
     * @return Coin
     */
    public function getTotalOutput()
    {
        return $this->totalOutput;
    }

    /**
     * The fees
     *
     * @return Coin
     */
    public function getFees()
    {
        return $this->fees;
    }

    /**
     * The inputs
     *
     * @return array
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * The outputs
     *
     * @return array
     */
    public function getOutputs()
    {
        return $this->outputs;
    }
}
