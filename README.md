Unit tests were implemented to verify:

Deposit functionality
Withdrawal functionality
Rebate creation
Insufficient balance validation

Concurrency handling was tested by executing simultaneous deposit and withdrawal requests against the same wallet.

The wallet row is protected using pessimistic locking (lockForUpdate) inside a database transaction, ensuring that concurrent updates are processed sequentially and preventing race conditions.


Test Scenario:

Initial balance: 500

Deposit 100 and withdraw 50 simultaneously, earning a 1% rebate during the process.

Final balance: 151
