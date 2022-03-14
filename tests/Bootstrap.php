<?php

namespace Tests;

use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BeforeFirstTestHook;
use Symfony\Component\Dotenv\Dotenv;

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
        $envFile = realpath(__DIR__ . '/../.env');
        if (!is_readable($envFile)) {
            return;
        }

        $dotenv  = new Dotenv();
        $dotenv->usePutenv(true);
        $dotenv->loadEnv($envFile);
    }

    public function executeAfterLastTest(): void
    {
    }
}
