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
 * Class TransactionBrief
 * @package Butz\Cardano\Explorer\Models
 */
class TransactionBrief extends BaseModel
{
    /**
     * The transaction ID
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
     * The input sum
     *
     * @var Coin
     */
    private $inputSum;

    /**
     * The output sum
     *
     * @var Coin
     */
    private $outputSum;

    /**
     * The input TransactionIO
     *
     * @var array
     */
    private $inputs = [];

    /**
     * The output TransactionIO
     *
     * @var array
     */
    private $outputs = [];

    /**
     * Coin constructor.
     */
    private function __construct()
    {
        //empty
    }

    /**
     * Takes an object from a response and translates into a TransactionBrief Object.
     *
     * @param $data
     * @return TransactionBrief
     */
    public static function fromRequest($data)
    {
        $transaction = new TransactionBrief();

        $transaction->id = $data->ctbId;
        $transaction->timeIssued = $data->ctbTimeIssued;
        $transaction->inputSum = Coin::fromRequest($data->ctbInputSum);
        $transaction->outputSum = Coin::fromRequest($data->ctbOutputSum);

        foreach ($data->ctbOutputs as $output) {
            $transaction->outputs[] = TransactionIO::fromRequest($output);
        }

        foreach ($data->ctbInputs as $input) {
            $transaction->inputs[] = TransactionIO::fromRequest($input);
        }

        return $transaction;
    }

    /**
     * The tx id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The time issued
     *
     * @return int
     */
    public function getTimeIssued()
    {
        return $this->timeIssued;
    }

    /**
     * The input sum
     *
     * @return Coin
     */
    public function getInputSum()
    {
        return $this->inputSum;
    }

    /**
     * The output sum
     *
     * @return Coin
     */
    public function getOutputSum()
    {
        return $this->outputSum;
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
