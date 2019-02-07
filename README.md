cakephp2-specify
=====

Specification Pattern Implementation targeting CakePHP 2.x

## Usage

### Create And Compose Specifications

```php
<?php

use jlttt\Specification\Specification;

$activeUsersRule = new Specification('deleted', null);
$adminUsersRole = new Specification('group_slug', 'ADMIN');
$nonAdminUsersRole = $adminUsersRole->not();
$nonAdminActiveUsersRule = $activeUsersRule
    ->andX($nonAdminUsersRole);
```

### Use It For Condition...
```php
<?php

/*
 * $user should contain:
 * - `null` in its `deleted` key
 * - a value different from `ADMIN` in its `group_slug` key
 */ 

if ($nonAdminActiveUsersRule->isSatisfiedBy($user)) {
    // ...
}
```

### Or For DQL !
```php
<?php

/*
 * the conditions of the query is equivalent to: 
 * [
 *     'deleted' => null,
 *     [
 *         'NOT' => [
 *             'group_slug' => 'ADMIN'
 *         ]
 *     ]
 * ]
 */
 
$nonAdminActiveUsers = $User->find(
    'all',
    array(
        'conditions' => $nonAdminActiveUsersRule->buildDQL(),
   )
);
```

## Requirements

 * PHP 5.6+
