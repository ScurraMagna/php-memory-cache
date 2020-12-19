# php-memory-cache

Add a simple function "Cache::get()" that takes three parameters: a file name, a timer and a callback function. As long as the diference between current time and the last update of the file is smaller than parametered time, the content of the file is valid and therefore is returned, else, the function is used and the content of the file is updated.

```php
<?php

$fileName = "someName"; 

$time = 600; // (seconds) 

$value = Cache::get($fileName, $time, function () {
  $result = 0;
  // do
  return $result;
});    
```
