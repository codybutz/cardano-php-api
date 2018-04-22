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
 * Class BlockPageSummary
 * @package Butz\Cardano\Explorer\Models
 */
class BlockPageSummary
{

    /**
     * The total number of slots created to date.
     *
     * @var string
     */
    private $totalSlots;

    /**
     * All the entries from the response.
     *
     * @var array
     */
    private $entries = [];

    /**
     * BlockPageSummary constructor.
     */
    private function __construct()
    {
        // Empty
    }

    /**
     * Transforms an API response into a BlockPageSummary.
     *
     * @param $data
     * @return BlockPageSummary
     */
    public static function fromResponse($data)
    {
        $summary = new BlockPageSummary();

        $summary->totalSlots = $data[0];

        foreach ($data[1] as $entry) {
            $summary->entries[] = BlockEntry::fromResponse($entry);
        }

        return $summary;
    }

    /**
     * The total slots
     *
     * @return string
     */
    public function getTotalSlots()
    {
        return $this->totalSlots;
    }

    /**
     * The entries
     *
     * @return array
     */
    public function getEntries()
    {
        return $this->entries;
    }
}
