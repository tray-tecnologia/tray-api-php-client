<?php

namespace Tests;

use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BeforeFirstTestHook;

class Bootstrap implements BeforeFirstTestHook, AfterLastTestHook
{
    /*
    |--------------------------------------------------------------------------
    | Bootstrap The Test Environment
    |--------------------------------------------------------------------------
    |
    | You may specify console commands that execute once before your test is
    | run. You are free to add your own additional commands or logic into
    | this file as needed in order to help your test suite run quicker.
    |
    */

    public function executeBeforeFirstTest(): void
    {
    }

    public function executeAfterLastTest(): void
    {
    }
}
