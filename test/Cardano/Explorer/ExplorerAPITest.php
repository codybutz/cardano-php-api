<?php namespace Butz\Tests\Cardano\Explorer;

use Butz\Cardano\Explorer\Exceptions\AddressNotFoundException;
use Butz\Cardano\Explorer\Exceptions\ExplorerException;
use Butz\Cardano\Explorer\Models\AddressSummary;
use Butz\Cardano\Explorer\Models\BlockEntry;
use Butz\Cardano\Explorer\Models\BlockPageSummary;
use Butz\Cardano\Explorer\Models\BlockSummary;
use Butz\Cardano\Explorer\Models\Coin;
use Butz\Cardano\Explorer\Models\GenesisAddressInfo;
use Butz\Cardano\Explorer\Models\GenesisSummary;
use Butz\Cardano\Explorer\Models\TransactionBrief;
use Butz\Cardano\Explorer\Models\TransactionEntry;
use Butz\Cardano\Explorer\Models\TransactionIO;
use Butz\Cardano\Explorer\Models\TransactionSummary;

/**
 * Class ExplorerAPITest
 * @package Butz\Test\Cardano\Explorer
 *
 */
class ExplorerAPITest extends ExplorerTestBase
{

    /**
     * Tests that when an Address Summary API Call returns a 200 Success that we retrieve the correct data.
     *
     * @throws \Butz\Cardano\Explorer\Exceptions\ExplorerException
     */
    public function testAddressSummarySuccess()
    {
        // Generate a random address.
        $address = $this->generateRandomAddress();

        $this->mock->append($this->mockSuccess('getAddressSummary-Success.json'));

        // Get Response
        $summary = $this->explorer->getAddressSummary($address);

        $this->accountSummaryTest($summary);
    }

    /**
     * @param AddressSummary $summary
     */
    private function accountSummaryTest(AddressSummary $summary)
    {
        $this->assertInstanceOf(AddressSummary::class, $summary, 'AddressSummary was expected but not returned.');

        $this->assertNotNull($summary->getAddress(), 'AddressSummary->address is null');
        $this->assertNotNull($summary->getBalance(), 'AddressSummary->balance is null');
        $this->assertNotNull($summary->getType(), 'AddressSummary->type is null');
        $this->assertNotNull($summary->getTxNum(), 'AddressSummary->balance is null');
        $this->assertNotNull($summary->isRedeemed(), 'AddressSummary->redeemed is null');
        $this->assertNotEmpty($summary->getTxList(), 'AddressSummary->txList is empty');

        $this->coinTest($summary->getBalance());

        foreach ($summary->getTxList() as $transaction) {
            $this->transactionBriefTest($transaction);
        }
    }

    /**
     * @param Coin $coin
     */
    private function coinTest(Coin $coin)
    {
        $this->assertInstanceOf(Coin::class, $coin, 'Coin was expected but not returned.');

        $this->assertNotNull($coin->getCoin());
    }

    /**
     * @param TransactionBrief $transaction
     */
    private function transactionBriefTest(TransactionBrief $transaction)
    {
        $this->assertInstanceOf(TransactionBrief::class, $transaction, 'TransactionBrief was expected but not returned.');

        $this->assertNotNull($transaction->getId(), 'Transaction->id is null');
        $this->assertNotNull($transaction->getTimeIssued(), 'Transaction->timeIssued is null');
        $this->assertNotNull($transaction->getInputSum(), 'Transaction->inputSum is null');
        $this->assertNotNull($transaction->getOutputSum(), 'Transaction->outputSum is null');
        $this->assertNotNull($transaction->getInputs(), 'Transaction->inputs is null');
        $this->assertNotEmpty($transaction->getInputs(), 'Transaction->inputs is empty');
        $this->assertNotNull($transaction->getOutputs(), 'Transaction->outputs is null');
        $this->assertNotEmpty($transaction->getOutputs(), 'Transaction->outputs is empty');

        $this->coinTest($transaction->getInputSum());
        $this->coinTest($transaction->getOutputSum());

        foreach ($transaction->getInputs() as $input) {
            $this->transactionIoTest($input);
        }
        foreach ($transaction->getOutputs() as $output) {
            $this->transactionIoTest($output);
        }
    }

    /**
     * @param TransactionIO $io
     */
    private function transactionIoTest(TransactionIO $io)
    {
        $this->assertInstanceOf(TransactionIO::class, $io, 'TransactionIO was expected but not returned.');

        $this->assertNotNull($io->getAddress(), 'TransactionIO->address is null');
        $this->assertNotNull($io->getCoin(), 'TransactionIO->coin is null');

        $this->coinTest($io->getCoin());
    }

    /**
     * Tests that when an Address Summary API Call returns a AddressNotFoundException that we retrieve an invalid address.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\AddressNotFoundException
     * @throws AddressNotFoundException
     * @throws ExplorerException
     */
    public function testAddressSummaryFailure()
    {
        // Generate a random address.
        $address = $this->generateRandomAddress();

        // Mock failure
        $this->mock->append($this->mockSuccess('getAddressSummary-Failure.json'));

        // Get Response
        $this->explorer->getAddressSummary($address);
    }

    /**
     * Tests that when an Address Summary API Call returns a AddressNotFoundException when an empty address is given.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\AddressNotFoundException
     * @throws AddressNotFoundException
     * @throws ExplorerException
     */
    public function testAddressSummaryNotFound()
    {
        $this->explorer->getAddressSummary('');
    }

    /**
     * Tests that when an Block Page API Call returns a success the data is decoded properly.
     *
     * @throws ExplorerException
     */
    public function testBlockPageSizeSuccess()
    {

        $this->mock->append($this->mockSuccess('getBlockPages-Success.json'));

        $response = $this->explorer->getBlockPages();

        $this->blockPageSummaryTest($response);
    }

    /**
     * @param BlockPageSummary $response
     */
    private function blockPageSummaryTest(BlockPageSummary $response)
    {
        $this->assertInstanceOf(BlockPageSummary::class, $response, 'BlockPageSummary was expected.');

        $this->assertNotNull($response->getTotalSlots());
        $this->assertNotEmpty($response->getEntries());

        foreach ($response->getEntries() as $entry) {
            $this->blockEntryTest($entry);
        }
    }

    /**
     * @param BlockEntry $entry
     */
    private function blockEntryTest(BlockEntry $entry)
    {
        $this->assertInstanceOf(BlockEntry::class, $entry, 'BlockEntry was expected.');

        $this->assertNotNull($entry->getTimeIssued());
        $this->assertNotNull($entry->getTxNum());
        $this->assertNotNull($entry->getBlockHash());
        $this->assertNotNull($entry->getBlockLead());
        $this->assertNotNull($entry->getEpoch());
        $this->assertNotNull($entry->getFees());
        $this->assertNotNull($entry->getSlot());
        $this->assertNotNull($entry->getTotalSent());
        $this->assertNotNull($entry->getSize());

        $this->coinTest($entry->getFees());
        $this->coinTest($entry->getTotalSent());
    }

    /**
     * Tests that when an Block Page API Call returns a success the data is decoded properly.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testBlockPageSizeFailure()
    {

        $this->mock->append($this->mockSuccess('getBlockPages-Failure.json'));

        $this->explorer->getBlockPages();
    }

    /**
     * Tests that when an Block Page Total API Call returns a success the data is decoded properly.
     *
     * @throws ExplorerException
     */
    public function testBlockPageSizeTotalSuccess()
    {

        $this->mock->append($this->mockSuccess('getBlockPagesTotal-Success.json'));

        $response = $this->explorer->getBlockPageTotal();

        $this->assertGreaterThan(0, $response);
    }

    /**
     * Tests that when an Block Page Total API Call returns a success the data is decoded properly
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testBlockPageSizeTotalFailure()
    {

        $this->mock->append($this->mockSuccess('getBlockPagesTotal-Failure.json'));

        $this->explorer->getBlockPageTotal();
    }

    /**
     * Tests that when an Block Summary API Call returns a success the data is decoded properly.
     *
     * @throws ExplorerException
     */
    public function testBlockSummarySuccess()
    {

        $hash = $this->generateRandomAddress();

        $this->mock->append($this->mockSuccess('getBlockSummary-Success.json'));

        $response = $this->explorer->getBlockSummary($hash);

        $this->blockSummaryTest($response);
    }

    /**
     * @param BlockSummary $summary
     */
    private function blockSummaryTest(BlockSummary $summary)
    {
        $this->assertInstanceOf(BlockSummary::class, $summary, 'BlockSummary was expected');

        $this->assertNotNull($summary->getEntry());
        $this->blockEntryTest($summary->getEntry());
        $this->assertNotNull($summary->getPrevHash());
        $this->assertNotNull($summary->getNextHash());
        $this->assertNotNull($summary->getMerkleRoot());
    }

    /**
     * Tests that when an Block Summary API Call returns a failure an exception is thrown.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testBlockSummaryFailure()
    {
        $hash = $this->generateRandomAddress();

        $this->mock->append($this->mockSuccess('getBlockSummary-Failure.json'));

        $this->explorer->getBlockSummary($hash);
    }

    /**
     * Tests that when an Block Transactions API Call returns a success we receive the correct data.
     *
     * @throws ExplorerException
     */
    public function testBlockTransactionListSuccess()
    {
        $hash = $this->generateRandomAddress();

        $this->mock->append($this->mockSuccess('getBlockTransactions-Success.json'));

        $response = $this->explorer->getBlockTransactions($hash);

        foreach ($response as $transaction) {
            $this->transactionBriefTest($transaction);
        }
    }

    /**
     * Tests that when an Block Transactions API Call returns a failure an exception is thrown.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testBlockTransactionListFailure()
    {
        $hash = $this->generateRandomAddress();

        $this->mock->append($this->mockSuccess('getBlockTransactions-Failure.json'));

        $this->explorer->getBlockTransactions($hash);
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @throws ExplorerException
     */
    public function testGenesisAddressInfoSuccess()
    {
        $this->mock->append($this->mockSuccess('getGenesisAddresses-Success.json'));

        $response = $this->explorer->getGenesisAddresses();

        foreach ($response as $info) {
            $this->genesisAddressInfoTest($info);
        }
    }

    /**
     * @param GenesisAddressInfo $info
     */
    private function genesisAddressInfoTest(GenesisAddressInfo $info)
    {
        $this->assertInstanceOf(GenesisAddressInfo::class, $info, 'GenesisAddressInfo was expected');

        $this->assertNotNull($info->getAddress());
        $this->coinTest($info->getAmount());
        $this->assertNotNull($info->isRedeemed());
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testGenesisAddressInfoFailure()
    {
        $this->mock->append($this->mockSuccess('getGenesisAddresses-Failure.json'));

        $this->explorer->getGenesisAddresses();
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testGenesisAddressInfoFilterFailure()
    {
        $this->mock->append($this->mockSuccess('getGenesisAddresses-Failure.json'));

        $this->explorer->getGenesisAddresses(5, 5, 'someinvlaidtest');
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @throws ExplorerException
     */
    public function testGenesisAddressPagesSuccess()
    {
        $this->mock->append($this->mockSuccess('getGenesisAddressesPages-Success.json'));

        $pages = $this->explorer->getGenesisAddressesPages();

        $this->assertEquals(1414, $pages);
    }

    /**
     * Tests that when requesting pages it gets the correct response.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testGenesisAddressPagesFailure()
    {
        $this->mock->append($this->mockSuccess('getGenesisAddressesPages-Failure.json'));

        $this->explorer->getGenesisAddressesPages();
    }

    /**
     * Tests that when requesting pages it gets the correct response.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testGenesisAddressPagesFilterFailure()
    {
        $this->mock->append($this->mockSuccess('getGenesisAddressesPages-Failure.json'));

        $this->explorer->getGenesisAddressesPages(5, 'someinvalidvalue');
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @throws ExplorerException
     */
    public function testGenesisSummarySuccess()
    {
        $this->mock->append($this->mockSuccess('getGenesisSummary-Success.json'));

        $response = $this->explorer->getGenesisSummary();

        $this->genesisSummaryTest($response);
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testGenesisSummaryFailure()
    {
        $this->mock->append($this->mockSuccess('getGenesisSummary-Failure.json'));

        $this->explorer->getGenesisAddressesPages();
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @throws ExplorerException
     */
    public function testLastTransactionsSuccess()
    {
        $this->mock->append($this->mockSuccess('getLastTransactions-Success.json'));

        $response = $this->explorer->getLastTxs();

        foreach ($response as $tx) {
            $this->transactionEntryTest($tx);
        }
    }

    /**
     * @param TransactionEntry $transaction
     */
    private function transactionEntryTest(TransactionEntry $transaction)
    {
        $this->assertInstanceOf(TransactionEntry::class, $transaction, 'TransactionEntry was expected but not returned.');

        $this->assertNotNull($transaction->getId(), 'Transaction->id is null');
        $this->assertNotNull($transaction->getTimeIssued(), 'Transaction->timeIssued is null');
        $this->assertNotEmpty($transaction->getAmount(), 'Transaction->outputs is empty');

        $this->coinTest($transaction->getAmount());
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testLastTransactionsFailure()
    {
        $this->mock->append($this->mockSuccess('getLastTransactions-Failure.json'));

        $this->explorer->getLastTxs();
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @throws ExplorerException
     */
    public function testTransactionSummarySuccess()
    {
        $this->mock->append($this->mockSuccess('getTransactionSummary-Success.json'));

        $response = $this->explorer->getTransactionSummary('9a8d6f4f9508abd23c3a3073df1dc3c1668977768c77abc3137b7ae831d25fea');

        $this->transactionSummaryTest($response);
    }

    /**
     * @param TransactionSummary $summary
     */
    private function transactionSummaryTest(TransactionSummary $summary)
    {
        $this->assertInstanceOf(TransactionSummary::class, $summary, 'TransactionSummary was expected');


        $this->assertNotNull($summary->getId(), 'Transaction->id is null');
        $this->assertNotNull($summary->getTimeIssued(), 'Transaction->timeIssued is null');
        $this->assertNotNull($summary->getBlockEpoch());
        $this->assertNotNull($summary->getBlockSlot());
        $this->assertNotNull($summary->getBlockHash());
        $this->assertNotNull($summary->getBlockTimeIssued());
        $this->assertNotNull($summary->getFees());
        $this->assertNotNull($summary->getTotalInput());
        $this->assertNotNull($summary->getTotalOutput());
        $this->assertNotNull($summary->getInputs());
        $this->assertNotNull($summary->getOutputs());

        foreach ($summary->getInputs() as $input) {
            $this->transactionIoTest($input);
        }
        foreach ($summary->getOutputs() as $output) {
            $this->transactionIoTest($output);
        }
    }

    /**
     * Tests that when an Genesis Address Info is generated it gets the correct response.
     *
     * @expectedException \Butz\Cardano\Explorer\Exceptions\ExplorerException
     * @throws ExplorerException
     */
    public function testTransactionSummaryFailure()
    {
        $this->mock->append($this->mockSuccess('getTransactionSummary-Failure.json'));

        $this->explorer->getLastTxs();
    }

    /**
     * @param GenesisSummary $summary
     */
    private function genesisSummaryTest(GenesisSummary $summary)
    {
        $this->assertInstanceOf(GenesisSummary::class, $summary, 'GenesisSummary was expected');

        $this->assertNotNull($summary->getTotal());
        $this->assertNotNull($summary->getRedeemed());
        $this->assertNotNull($summary->getNotRedeemed());

        $this->coinTest($summary->getAmountRedeemed());
        $this->coinTest($summary->getAmountNotRedeemed());
    }
}
