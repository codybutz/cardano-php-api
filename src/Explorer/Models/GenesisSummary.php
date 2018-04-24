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
 * Class GenesisSummary
 * @package Butz\Cardano\Explorer\Models
 */
class GenesisSummary extends BaseModel
{

    /**
     * @var int Total Genesis Coins
     */
    private $total;

    /**
     * @var int Total Redeemed Genesis Coins
     */
    private $redeemed;

    /**
     * @var int Total Non-Redeemed Genesis Coins
     */
    private $notRedeemed;

    /**
     * @var Coin Amount of Redeemed Coin
     */
    private $amountRedeemed;

    /**
     * @var Coin Amount of Non-Redeemed Coin
     */
    private $amountNotRedeemed;

    /**
     * GenesisSummary constructor.
     */
    private function __construct()
    {
        //empty
    }

    /**
     * Transforms an API response to a Genesis Summary
     *
     * @param $data
     * @return GenesisSummary
     */
    public static function fromRequest($data)
    {

        $summary = new GenesisSummary();

        $summary->total = $data->cgsNumTotal;
        $summary->redeemed = $data->cgsNumRedeemed;
        $summary->notRedeemed = $data->cgsNumNotRedeemed;
        $summary->amountRedeemed = Coin::fromRequest($data->cgsRedeemedAmountTotal);
        $summary->amountNotRedeemed = Coin::fromRequest($data->cgsNonRedeemedAmountTotal);

        return $summary;
    }

    /**
     * The total
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * The redeemed address count
     *
     * @return int
     */
    public function getRedeemed()
    {
        return $this->redeemed;
    }

    /**
     * The not redeemed address count
     *
     * @return int
     */
    public function getNotRedeemed()
    {
        return $this->notRedeemed;
    }

    /**
     * The amount redeemed
     *
     * @return Coin
     */
    public function getAmountRedeemed()
    {
        return $this->amountRedeemed;
    }

    /**
     * The amount not redeemed.
     *
     * @return Coin
     */
    public function getAmountNotRedeemed()
    {
        return $this->amountNotRedeemed;
    }
}
