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
 * Class BlockSummary
 * @package Butz\Cardano\Explorer\Models
 */
class BlockSummary
{

    /**
     * The associated block entry
     *
     * @var BlockEntry
     */
    private $entry;

    /**
     * The previous hash.
     *
     * @var string
     */
    private $prevHash;

    /**
     * The next hash.
     *
     * @var string
     */
    private $nextHash;

    /**
     * The root of the merkle tree.
     *
     * @var string
     */
    private $merkleRoot;

    /**
     * BlockSummary constructor.
     */
    private function __construct()
    {
        // Empty
    }

    /**
     * Build a BlockSummary from the API.
     *
     * @param $data
     * @return BlockSummary
     */
    public static function fromResponse($data)
    {
        $summary = new BlockSummary();

        $summary->entry = BlockEntry::fromResponse($data->cbsEntry);
        $summary->prevHash = $data->cbsPrevHash;
        $summary->nextHash = $data->cbsNextHash; // Optional
        $summary->merkleRoot = $data->cbsMerkleRoot;

        return $summary;
    }

    /**
     * Gets associated BlockEntry to this summary.
     *
     * @return BlockEntry
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Retrieves the previous hash to this block.
     *
     * @return string
     */
    public function getPrevHash()
    {
        return $this->prevHash;
    }

    /**
     * Retrieves the next hash to this block
     *
     * @return string|null
     */
    public function getNextHash()
    {
        return $this->nextHash;
    }

    /**
     * Gets the root node in the merkle tree.
     *
     * @return string
     */
    public function getMerkleRoot()
    {
        return $this->merkleRoot;
    }
}
