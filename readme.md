#  Find the actual activation date of phone number

### Problem Statement

Given a list of at most N = ​50,000,000 records (in CSV format), each record describes an usage period of a specific mobile phone number.  
 
Note that one phone number can occurs multiple times in this list, because of 2 reasons: 
- This phone number can ​change from prepaid plan to postpaid plan​, or vice versa, at anytime just by sending an SMS to the operator. 
- Or, the owner of this phone number can stop using it, and after 1-2 months,​it is reused by another person​.

Also remember that, the reason is not recorded in the data, we just have the phone number and its activation or deactivation date for a usage period record. 
- Activation date is the date that the phone number is started being used by a owner with a specific plan (prepaid or postpaid).
- Deactivation date is the date that the phone number is stopped being used by a owner with the registered plan.

_Moreover, the ​records don't need to follow any specific order of time, and the ​records of the same number don't need to be consecutive​._


**Example of CSV file**
```
PHONE_NUMBER,ACTIVATION_DATE,DEACTIVATION_DATE 
0987000001,2016-03-01,2016-05-01 
0987000002,2016-02-01,2016-03-01 
0987000001,2016-01-01,2016-03-01 
0987000001,2016-12-01, 
0987000002,2016-03-01,2016-05-01 
0987000003,2016-01-01,2016-01-10 
0987000001,2016-09-01,2016-12-01 
0987000002,2016-05-01, 
0987000001,2016-06-01,2016-09-01 
```

In this list, ACTIVATION_DATE and DEACTIVATION_DATE are represented with YYYY-MM-DD format. DEACTIVATION_DATE may be empty, which means that the phone is still being used by its current owner. 
From the given data, we want to find a list of ​unique phone numbers together with the ​actual activation date when its ​current owner started using it. Note that what we need is the first activation date of current owner, not previous owner, and not the date when current owner changes prepaid/postpaid plans. 

_**For example:** The prepaid phone number ​0987000001 was used by A from ​2016-01-01 to 2016-03-01​, then it was changed to postpaid. A continued using it until ​2016-05-01 and stopped using this number. After 1 month, on ​2016-06-01​, this phone number was reused by B with prepaid plan. B used it until ​2016-09-01 then changed to postpaid, and finally changed back to prepaid on ​2016-12-01and he's still using it until now. In this case, the actual activation date of current owner B of ​0987000001​ that we want to find is ​2016-06-01​._
 

**Requirement**

- Describe in detail your ​strategy and algorithm​ to solve this problem. 
- Analyze the ​time complexity and ​memory complexity of your algorithm (including the processing time of any ​data structure​ that you need to use in your implementation). 
- Implement your solution in any programming language (we prefer​Golang​), with input is a CSV file as described above, and write the output as another CSV file with following format: 
```
PHONE_NUMBER,REAL_ACTIVATION_DATE 
0987000001,2016-06-01 
0987000002,2016-02-01 
0987000003,2016-01-01 
```
- Your code should be production ready, which means that it is ​well organised​ and ​well  tested​. Please send us ​your code​ with all ​unit tests​.

**Installation**

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar install
```

**Run**

To generate output.csv file run follow command:
```
php src/Run.php
```

**Run Unit Test**

Command:
```
vendor/bin/phpunit
```

Result:
```
PHPUnit 7.5.8 by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: 96 ms, Memory: 4.00 MB

OK (2 tests, 2 assertions)
```

### Strategy and Algorithm

Assumming that you have data input:
```
PHONE_NUMBER,ACTIVATION_DATE,DEACTIVATION_DATE 
0987000001,2016-03-01,2016-05-01 
0987000002,2016-02-01,2016-03-01 
0987000001,2016-01-01,2016-03-01 
0987000001,2016-12-01, 
0987000002,2016-03-01,2016-05-01 
0987000003,2016-01-01,2016-01-10 
0987000001,2016-09-01,2016-12-01 
0987000002,2016-05-01, 
0987000001,2016-06-01,2016-09-01 
```

**How to find Actual Activation Date**

1) Read CSV file line by line (skip the header), fill an associative array use PHONE_NUMBER is a key, and values as all occurance of ACTIVATION_DATE and DEACTIVATION_DATE:
```
  ["0987000001"]=>
  array(5) {
    [0]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-03-01"
      ["deactivationDate"]=>
      string(10) "2016-05-01"
    }
    [1]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-01-01"
      ["deactivationDate"]=>
      string(10) "2016-03-01"
    }
    [2]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-12-01"
      ["deactivationDate"]=>
      string(0) ""
    }
    [3]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-09-01"
      ["deactivationDate"]=>
      string(10) "2016-12-01"
    }
    [4]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-06-01"
      ["deactivationDate"]=>
      string(10) "2016-09-01"
    }
  }
```

2) With each PHONE_NUMBER, i sort the list of usage period by ACTIVATION_DATE in descending:
```
 ["0987000001"]=>
  array(5) {
    [0]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-12-01"
      ["deactivationDate"]=>
      string(0) ""
    }
    [1]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-09-01"
      ["deactivationDate"]=>
      string(10) "2016-12-01"
    }
    [2]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-06-01"
      ["deactivationDate"]=>
      string(10) "2016-09-01"
    }
    [3]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-03-01"
      ["deactivationDate"]=>
      string(10) "2016-05-01"
    }
    [4]=>
    array(2) {
      ["activationDate"]=>
      string(10) "2016-01-01"
      ["deactivationDate"]=>
      string(10) "2016-03-01"
    }
```

3) With each PHONE_NUMBER, after sort ACTIVATION_DATE I start to find actual activation date by iterating on date:
 - Set ACTIVATION_DATE of the first loop as actualActivationDate
 - Check if actualActivationDate is equals previous date DEACTIVATION_DATE.
    - If yes, then set actualActivationDate = previous date range ACTIVATION_DATE.
    - If not, then stop the loop, that mean actualActivationDate is the current owners ACTIVATION_DATE as per the requirement.


**Data Structure Used:** Associative Array

**Algorithm used:** Sorting with [usort](https://www.php.net/manual/en/function.usort.php) which used Quick Sort (Θ(n log(n)).

**Time & Space Complexity:** Θ(Y(Z log(Z)))

Where:
- **X** is the number of Phone Numbers
- **Y** is the number of Users
- **Z** is the number of Phone Number / User

