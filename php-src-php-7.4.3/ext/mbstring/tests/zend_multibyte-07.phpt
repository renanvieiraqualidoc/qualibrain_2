--TEST--
zend multibyte (7)
--SKIPIF--
<?php require 'skipif.inc'; ?>
--INI--
zend.multibyte=On
zend.script_encoding=ISO-8859-1
internal_encoding=EUC-JP
--FILE--
<?php
declare(encoding="UTF-8");
var_dump(bin2hex("ใในใ"));
?>
--EXPECT--
string(12) "a5c6a5b9a5c8"
