# Cardano API

## Table of Contents

* [AddressNotFoundException](#addressnotfoundexception)
* [AddressSummary](#addresssummary)
    * [jsonSerialize](#jsonserialize)
    * [fromRequest](#fromrequest)
    * [getAddress](#getaddress)
    * [getType](#gettype)
    * [getTxNum](#gettxnum)
    * [getBalance](#getbalance)
    * [getTxList](#gettxlist)
    * [isRedeemed](#isredeemed)
* [BaseModel](#basemodel)
    * [jsonSerialize](#jsonserialize-1)
* [BlockEntry](#blockentry)
    * [jsonSerialize](#jsonserialize-2)
    * [fromResponse](#fromresponse)
    * [getEpoch](#getepoch)
    * [getSlot](#getslot)
    * [getBlockHash](#getblockhash)
    * [getTimeIssued](#gettimeissued)
    * [getTxNum](#gettxnum-1)
    * [getTotalSent](#gettotalsent)
    * [getSize](#getsize)
    * [getBlockLead](#getblocklead)
    * [getFees](#getfees)
* [BlockPageSummary](#blockpagesummary)
    * [jsonSerialize](#jsonserialize-3)
    * [fromResponse](#fromresponse-1)
    * [getTotalSlots](#gettotalslots)
    * [getEntries](#getentries)
* [BlockSummary](#blocksummary)
    * [jsonSerialize](#jsonserialize-4)
    * [fromResponse](#fromresponse-2)
    * [getEntry](#getentry)
    * [getPrevHash](#getprevhash)
    * [getNextHash](#getnexthash)
    * [getMerkleRoot](#getmerkleroot)
* [Coin](#coin)
    * [jsonSerialize](#jsonserialize-5)
    * [fromRequest](#fromrequest-1)
    * [getCoin](#getcoin)
* [ExplorerAPI](#explorerapi)
    * [__construct](#__construct)
    * [getAddressSummary](#getaddresssummary)
    * [getBlockPages](#getblockpages)
    * [getBlockPageTotal](#getblockpagetotal)
    * [getBlockSummary](#getblocksummary)
    * [getBlockTransactions](#getblocktransactions)
    * [getGenesisAddresses](#getgenesisaddresses)
    * [getGenesisAddressesPages](#getgenesisaddressespages)
    * [getGenesisSummary](#getgenesissummary)
    * [getLastTxs](#getlasttxs)
    * [getTransactionSummary](#gettransactionsummary)
* [ExplorerException](#explorerexception)
* [GenesisAddressInfo](#genesisaddressinfo)
    * [jsonSerialize](#jsonserialize-6)
    * [fromRequest](#fromrequest-2)
    * [getAddress](#getaddress-1)
    * [getAmount](#getamount)
    * [isRedeemed](#isredeemed-1)
* [GenesisSummary](#genesissummary)
    * [jsonSerialize](#jsonserialize-7)
    * [fromRequest](#fromrequest-3)
    * [getTotal](#gettotal)
    * [getRedeemed](#getredeemed)
    * [getNotRedeemed](#getnotredeemed)
    * [getAmountRedeemed](#getamountredeemed)
    * [getAmountNotRedeemed](#getamountnotredeemed)
* [TransactionBrief](#transactionbrief)
    * [jsonSerialize](#jsonserialize-8)
    * [fromRequest](#fromrequest-4)
    * [getId](#getid)
    * [getTimeIssued](#gettimeissued-1)
    * [getInputSum](#getinputsum)
    * [getOutputSum](#getoutputsum)
    * [getInputs](#getinputs)
    * [getOutputs](#getoutputs)
* [TransactionEntry](#transactionentry)
    * [jsonSerialize](#jsonserialize-9)
    * [fromRequest](#fromrequest-5)
    * [getId](#getid-1)
    * [getTimeIssued](#gettimeissued-2)
    * [getAmount](#getamount-1)
* [TransactionIO](#transactionio)
    * [jsonSerialize](#jsonserialize-10)
    * [fromRequest](#fromrequest-6)
    * [getAddress](#getaddress-2)
    * [getCoin](#getcoin-1)
* [TransactionSummary](#transactionsummary)
    * [jsonSerialize](#jsonserialize-11)
    * [fromRequest](#fromrequest-7)
    * [getId](#getid-2)
    * [getTimeIssued](#gettimeissued-3)
    * [getBlockTimeIssued](#getblocktimeissued)
    * [getBlockHeight](#getblockheight)
    * [getBlockEpoch](#getblockepoch)
    * [getBlockSlot](#getblockslot)
    * [getBlockHash](#getblockhash-1)
    * [getRelayedBy](#getrelayedby)
    * [getTotalInput](#gettotalinput)
    * [getTotalOutput](#gettotaloutput)
    * [getFees](#getfees-1)
    * [getInputs](#getinputs-1)
    * [getOutputs](#getoutputs-1)

## AddressNotFoundException

Class AddressNotFoundException



* Full name: \Butz\Cardano\Explorer\Exceptions\AddressNotFoundException
* Parent class: \Butz\Cardano\Explorer\Exceptions\ExplorerException


## AddressSummary

Class AddressSummary



* Full name: \Butz\Cardano\Explorer\Models\AddressSummary
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
AddressSummary::jsonSerialize(  ): object
```







---

### fromRequest

Transforms the API response into an AddressSummary.

```php
AddressSummary::fromRequest(  $data ): \Butz\Cardano\Explorer\Models\AddressSummary
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getAddress

The address

```php
AddressSummary::getAddress(  ): string
```







---

### getType

The type

```php
AddressSummary::getType(  ): string
```







---

### getTxNum

The transaction number

```php
AddressSummary::getTxNum(  ): integer
```







---

### getBalance

The balance

```php
AddressSummary::getBalance(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### getTxList

The transaction list.

```php
AddressSummary::getTxList(  ): array
```







---

### isRedeemed

Is redeemed?

```php
AddressSummary::isRedeemed(  ): boolean
```







---

## BaseModel

Class BaseModel



* Full name: \Butz\Cardano\Explorer\Models\BaseModel
* This class implements: \JsonSerializable


### jsonSerialize

Specify data which should be serialized to JSON

```php
BaseModel::jsonSerialize(  ): object
```







---

## BlockEntry

Class BlockEntry



* Full name: \Butz\Cardano\Explorer\Models\BlockEntry
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
BlockEntry::jsonSerialize(  ): object
```







---

### fromResponse

Takes an API response and transforms into a BlockEntry.

```php
BlockEntry::fromResponse(  $data ): \Butz\Cardano\Explorer\Models\BlockEntry
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getEpoch

The epoch

```php
BlockEntry::getEpoch(  ): integer
```







---

### getSlot

The slot

```php
BlockEntry::getSlot(  ): integer
```







---

### getBlockHash

The block hash

```php
BlockEntry::getBlockHash(  ): string
```







---

### getTimeIssued

The time issued

```php
BlockEntry::getTimeIssued(  ): integer
```







---

### getTxNum

The transaction number

```php
BlockEntry::getTxNum(  ): integer
```







---

### getTotalSent

The total sent

```php
BlockEntry::getTotalSent(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### getSize

The size of the block

```php
BlockEntry::getSize(  ): integer
```







---

### getBlockLead

The block leader

```php
BlockEntry::getBlockLead(  ): string
```







---

### getFees

The fees

```php
BlockEntry::getFees(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

## BlockPageSummary

Class BlockPageSummary



* Full name: \Butz\Cardano\Explorer\Models\BlockPageSummary
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
BlockPageSummary::jsonSerialize(  ): object
```







---

### fromResponse

Transforms an API response into a BlockPageSummary.

```php
BlockPageSummary::fromResponse(  $data ): \Butz\Cardano\Explorer\Models\BlockPageSummary
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getTotalSlots

The total slots

```php
BlockPageSummary::getTotalSlots(  ): string
```







---

### getEntries

The entries

```php
BlockPageSummary::getEntries(  ): array
```







---

## BlockSummary

Class BlockSummary



* Full name: \Butz\Cardano\Explorer\Models\BlockSummary
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
BlockSummary::jsonSerialize(  ): object
```







---

### fromResponse

Build a BlockSummary from the API.

```php
BlockSummary::fromResponse(  $data ): \Butz\Cardano\Explorer\Models\BlockSummary
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getEntry

Gets associated BlockEntry to this summary.

```php
BlockSummary::getEntry(  ): \Butz\Cardano\Explorer\Models\BlockEntry
```







---

### getPrevHash

Retrieves the previous hash to this block.

```php
BlockSummary::getPrevHash(  ): string
```







---

### getNextHash

Retrieves the next hash to this block

```php
BlockSummary::getNextHash(  ): string|null
```







---

### getMerkleRoot

Gets the root node in the merkle tree.

```php
BlockSummary::getMerkleRoot(  ): string
```







---

## Coin

Class Coin



* Full name: \Butz\Cardano\Explorer\Models\Coin
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
Coin::jsonSerialize(  ): object
```







---

### fromRequest

Takes an object from a response and translates into a Coin Object.

```php
Coin::fromRequest(  $data ): \Butz\Cardano\Explorer\Models\Coin
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getCoin

The coin

```php
Coin::getCoin(  ): string
```







---

## ExplorerAPI

Class ExplorerAPI



* Full name: \Butz\Cardano\Explorer\ExplorerAPI


### __construct

ExplorerAPI constructor.

```php
ExplorerAPI::__construct( \GuzzleHttp\HandlerStack|null $handler = null )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$handler` | **\GuzzleHttp\HandlerStack&#124;null** |  |




---

### getAddressSummary

Get summary information about an address.

```php
ExplorerAPI::getAddressSummary(  $address ): \Butz\Cardano\Explorer\Models\AddressSummary
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$address` | **** |  |




---

### getBlockPages

Get summary info from a block page.

```php
ExplorerAPI::getBlockPages( integer $page = 1, integer $pageSize = 10 ): \Butz\Cardano\Explorer\Models\BlockPageSummary
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$page` | **integer** |  |
| `$pageSize` | **integer** |  |




---

### getBlockPageTotal

Get total blocks.

```php
ExplorerAPI::getBlockPageTotal( integer $pageSize = 10 ): integer
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$pageSize` | **integer** |  |




---

### getBlockSummary

Get summary information about an block.

```php
ExplorerAPI::getBlockSummary(  $hash ): \Butz\Cardano\Explorer\Models\BlockSummary
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$hash` | **** |  |




---

### getBlockTransactions

Get transactions that took place during an block.

```php
ExplorerAPI::getBlockTransactions(  $hash ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$hash` | **** |  |




---

### getGenesisAddresses

Get all genesis addresses.

```php
ExplorerAPI::getGenesisAddresses( integer $page = 1, integer $pageSize = 15, string $filter = &#039;all&#039; ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$page` | **integer** |  |
| `$pageSize` | **integer** |  |
| `$filter` | **string** |  |




---

### getGenesisAddressesPages

Get the number of pages for a particular genesis address query.

```php
ExplorerAPI::getGenesisAddressesPages( integer $pageSize = 15, string $filter = &#039;all&#039; ): integer
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$pageSize` | **integer** |  |
| `$filter` | **string** |  |




---

### getGenesisSummary

Gets the summary of the Genesis Addresses.

```php
ExplorerAPI::getGenesisSummary(  ): \Butz\Cardano\Explorer\Models\GenesisSummary
```







---

### getLastTxs

Get information about the N latest transactions.

```php
ExplorerAPI::getLastTxs(  ): array
```







---

### getTransactionSummary

Get information about a particular transaction.

```php
ExplorerAPI::getTransactionSummary(  $txid ): \Butz\Cardano\Explorer\Models\TransactionSummary
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$txid` | **** |  |




---

## ExplorerException

Class ExplorerException



* Full name: \Butz\Cardano\Explorer\Exceptions\ExplorerException
* Parent class: 


## GenesisAddressInfo

Class GenesisAddressInfo



* Full name: \Butz\Cardano\Explorer\Models\GenesisAddressInfo
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
GenesisAddressInfo::jsonSerialize(  ): object
```







---

### fromRequest

Takes an object from a response and translates into a Coin Object.

```php
GenesisAddressInfo::fromRequest(  $data ): \Butz\Cardano\Explorer\Models\GenesisAddressInfo
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getAddress

The address

```php
GenesisAddressInfo::getAddress(  ): string
```







---

### getAmount

The amount

```php
GenesisAddressInfo::getAmount(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### isRedeemed

Is redeemed?

```php
GenesisAddressInfo::isRedeemed(  ): boolean
```







---

## GenesisSummary

Class GenesisSummary



* Full name: \Butz\Cardano\Explorer\Models\GenesisSummary
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
GenesisSummary::jsonSerialize(  ): object
```







---

### fromRequest

Transforms an API response to a Genesis Summary

```php
GenesisSummary::fromRequest(  $data ): \Butz\Cardano\Explorer\Models\GenesisSummary
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getTotal

The total

```php
GenesisSummary::getTotal(  ): integer
```







---

### getRedeemed

The redeemed address count

```php
GenesisSummary::getRedeemed(  ): integer
```







---

### getNotRedeemed

The not redeemed address count

```php
GenesisSummary::getNotRedeemed(  ): integer
```







---

### getAmountRedeemed

The amount redeemed

```php
GenesisSummary::getAmountRedeemed(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### getAmountNotRedeemed

The amount not redeemed.

```php
GenesisSummary::getAmountNotRedeemed(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

## TransactionBrief

Class TransactionBrief



* Full name: \Butz\Cardano\Explorer\Models\TransactionBrief
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
TransactionBrief::jsonSerialize(  ): object
```







---

### fromRequest

Takes an object from a response and translates into a TransactionBrief Object.

```php
TransactionBrief::fromRequest(  $data ): \Butz\Cardano\Explorer\Models\TransactionBrief
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getId

The tx id

```php
TransactionBrief::getId(  ): string
```







---

### getTimeIssued

The time issued

```php
TransactionBrief::getTimeIssued(  ): integer
```







---

### getInputSum

The input sum

```php
TransactionBrief::getInputSum(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### getOutputSum

The output sum

```php
TransactionBrief::getOutputSum(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### getInputs

The inputs

```php
TransactionBrief::getInputs(  ): array
```







---

### getOutputs

The outputs

```php
TransactionBrief::getOutputs(  ): array
```







---

## TransactionEntry

Class TransactionEntry



* Full name: \Butz\Cardano\Explorer\Models\TransactionEntry
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
TransactionEntry::jsonSerialize(  ): object
```







---

### fromRequest

Takes an object from a response and translates into a TransactionEntry Object.

```php
TransactionEntry::fromRequest(  $data ): \Butz\Cardano\Explorer\Models\TransactionEntry
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getId

The id

```php
TransactionEntry::getId(  ): string
```







---

### getTimeIssued

The time issued

```php
TransactionEntry::getTimeIssued(  ): integer
```







---

### getAmount

The amount

```php
TransactionEntry::getAmount(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

## TransactionIO

Class TransactionIO



* Full name: \Butz\Cardano\Explorer\Models\TransactionIO
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
TransactionIO::jsonSerialize(  ): object
```







---

### fromRequest

Takes an object from a response and translates into a Coin Object.

```php
TransactionIO::fromRequest(  $data ): \Butz\Cardano\Explorer\Models\TransactionIO
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getAddress

The address

```php
TransactionIO::getAddress(  ): string
```







---

### getCoin

The coin

```php
TransactionIO::getCoin(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

## TransactionSummary

Class TransactionSummary



* Full name: \Butz\Cardano\Explorer\Models\TransactionSummary
* Parent class: \Butz\Cardano\Explorer\Models\BaseModel


### jsonSerialize

Specify data which should be serialized to JSON

```php
TransactionSummary::jsonSerialize(  ): object
```







---

### fromRequest

Takes an object from a response and translates into a TransactionSummary Object.

```php
TransactionSummary::fromRequest(  $data ): \Butz\Cardano\Explorer\Models\TransactionSummary
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **** |  |




---

### getId

The id

```php
TransactionSummary::getId(  ): string
```







---

### getTimeIssued

Get time issued.

```php
TransactionSummary::getTimeIssued(  ): integer
```







---

### getBlockTimeIssued

The block time issued

```php
TransactionSummary::getBlockTimeIssued(  ): integer
```







---

### getBlockHeight

The block height

```php
TransactionSummary::getBlockHeight(  ): integer
```







---

### getBlockEpoch

The block epoch

```php
TransactionSummary::getBlockEpoch(  ): integer
```







---

### getBlockSlot

The block slot

```php
TransactionSummary::getBlockSlot(  ): integer
```







---

### getBlockHash

The block hash

```php
TransactionSummary::getBlockHash(  ): string
```







---

### getRelayedBy

The relayed bby network address

```php
TransactionSummary::getRelayedBy(  ): string
```







---

### getTotalInput

The total input

```php
TransactionSummary::getTotalInput(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### getTotalOutput

The total output

```php
TransactionSummary::getTotalOutput(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### getFees

The fees

```php
TransactionSummary::getFees(  ): \Butz\Cardano\Explorer\Models\Coin
```







---

### getInputs

The inputs

```php
TransactionSummary::getInputs(  ): array
```







---

### getOutputs

The outputs

```php
TransactionSummary::getOutputs(  ): array
```







---



--------
> This document was automatically generated from source code comments on 2018-04-24 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
