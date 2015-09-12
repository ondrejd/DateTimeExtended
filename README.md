# DateTimeExtended

> __For non-Czech users__: This project contains sources aimed primarily for Czech environment. This file is thus just in Czech. Anyway sources self are commented in English.

Rozšíření standartní [PHP](http://php.net/) třídy [DateTime](http://php.net/manual/en/class.datetime.php) pro snadné zjišťování nejbližšího pracovního dne - v tomto se počítá s víkendy i českými státními svátky.

Použité data pro státní svátky (přesněji pro dny pracovního klidu) vychází ze zákonů:

1. [Zákon č. 129/2006 Sb. ze dne 14. března 2006](http://www.mpsv.cz/cs/4745)
2. [Zákon č. 101/2004 Sb. ze dne 10. února 2004](http://www.mpsv.cz/cs/4748)
3. [Zákon č. 245/2000 Sb. ze dne 29. června 2000](http://www.mpsv.cz/cs/75)

## Použití

Použití je snadné:

```php
<?php
/**
 * @var DateTimeExtended $helper
 */
$helper = new DateTimeExtended();

// Prints next working day
echo $helper->getNextWorkingDay()->format('Y-m-d H:i:s');

```
