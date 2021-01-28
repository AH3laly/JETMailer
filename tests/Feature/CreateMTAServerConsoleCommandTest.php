<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateMTAServerConsoleCommandTest extends TestCase
{
    public function test_create_mta_server_command_requires_arguments()
    {
        $this->artisan('jetMailer:CreateMTA')->assertExitCode(1);
    }

    public function test_create_mta_server_command_requires_password_argument()
    {
        $this->artisan('jetMailer:CreateMTA --host=smtp.somedomain.local --port=587 --security=tls --username=smtpuser')->assertExitCode(1);
    }

    public function test_create_mta_server_command_requires_username_argument()
    {
        $this->artisan('jetMailer:CreateMTA --host=smtp.somedomain.local --port=587 --security=tls --password="MyVeryLongAndComplexPassword"')->assertExitCode(1);
    }

    public function test_create_mta_server_command_requires_port_argument()
    {
        $this->artisan('jetMailer:CreateMTA --host=smtp.somedomain.local --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"')->assertExitCode(1);
    }

    public function test_create_mta_server_command_requires_security_argument()
    {
        $this->artisan('jetMailer:CreateMTA --host=smtp.somedomain.local --port=587 --username=smtpuser --password="MyVeryLongAndComplexPassword"')->assertExitCode(1);
    }

    public function test_create_mta_server_command_requires_host_argument()
    {
        $this->artisan('jetMailer:CreateMTA --port=587 --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"')->assertExitCode(1);
    }
}
