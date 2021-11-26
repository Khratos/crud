<?php

return [
  'db' => [
    'host' => 'localhost',
    'port' => '3306',
    'user' => 'root',
    'pass' => '123456',
    'name' => 'test',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
  ]
];