<?php

namespace servers;

interface RouteInterface
{
   public  function route(string  $namClass , string $name, string $uri);
}