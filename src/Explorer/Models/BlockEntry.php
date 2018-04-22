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
 * Class BlockEntry
 * @package Butz\Cardano\Explorer\Models
 */
class BlockEntry
{

    /**
     * The epoch associated to this entry.
     *
     * @var integer
     */
    private $epoch;

    /**
     * The slot associated to this entry.
     *
     * @var integer
     */
    private $slot;

    /**
     * The hash associated to this entry.
     *
     * @var string
     */
    private $blockHash;

    /**
     * The time this block was issued.
     *
     * @var integer
     */
    private $timeIssued;

    /**
     * The number of transactions that occured during this block.
     *
     * @var integer
     */
    private $txNum;

    /**
     * The total amount of ADA transferred during this block.
     *
     * @var Coin
     */
    private $totalSent;

    /**
     * The total block size.
     *
     * @var integer
     */
    private $size;

    /**
     * The block leader.
     *
     * @var string
     */
    private $blockLead;

    /**
     * The total amount of ADA fees during this block.
     *
     * @var Coin
     */
    private $fees;

    /**
     * BlockEntry constructor.
     */
    private function __construct()
    {
        // Empty
    }

    /**
     * Takes an API response and transforms into a BlockEntry.
     *
     * @param $data
     * @return BlockEntry
     */
    public static function fromResponse($data)
    {

        $entry = new BlockEntry();

        $entry->epoch = $data->cbeEpoch;
        $entry->slot = $data->cbeSlot;
        $entry->blockHash = $data->cbeBlkHash;
        $entry->timeIssued = $data->cbeTimeIssued;
        $entry->txNum = $data->cbeTxNum;
        $entry->totalSent = Coin::fromRequest($data->cbeTotalSent);
        $entry->size = $data->cbeSize;
        $entry->blockLead = $data->cbeBlockLead;
        $entry->fees = Coin::fromRequest($data->cbeFees);

        return $entry;
    }

    /**
     * The epoch
     *
     * @return int
     */
    public function getEpoch()
    {
        return $this->epoch;
    }

    /**
     * The slot
     *
     * @return int
     */
    public function getSlot()
    {
        return $this->slot;
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
     * The time issued
     *
     * @return int
     */
    public function getTimeIssued()
    {
        return $this->timeIssued;
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
     * The total sent
     *
     * @return Coin
     */
    public function getTotalSent()
    {
        return $this->totalSent;
    }

    /**
     * The size of the block
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * The block leader
     *
     * @return string
     */
    public function getBlockLead()
    {
        return $this->blockLead;
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
}
