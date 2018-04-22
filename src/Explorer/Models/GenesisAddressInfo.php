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
 * Class GenesisAddressInfo
 * @package Butz\Cardano\Explorer\Models
 */
class GenesisAddressInfo
{
    /**
     * @var string The Genesis Address
     */
    private $address;

    /**
     * @var Coin
     */
    private $amount;

    /**
     * @var bool Is the coin redeemed?
     */
    private $redeemed;

    /**
     * GenesisAddressInfo constructor.
     */
    private function __construct()
    {
        //empty
    }

    /**
     * Takes an object from a response and translates into a Coin Object.
     *
     * @param $data
     * @return GenesisAddressInfo
     */
    public static function fromRequest($data)
    {

        $address = new self;

        $address->address = $data->cgaiCardanoAddress;
        $address->amount = Coin::fromRequest($data->cgaiGenesisAmount);
        $address->redeemed = $data->cgaiIsRedeemed;

        return $address;
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
     * The amount
     *
     * @return Coin
     */
    public function getAmount()
    {
        return $this->amount;
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
