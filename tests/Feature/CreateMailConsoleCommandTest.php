<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateMailConsoleCommandTest extends TestCase
{
    public function test_create_mail_command_requires_arguments()
    {
        // Assert validation
        $this->artisan('jetMailer:CreateMail')->assertExitCode(1);
    }

    public function test_create_mail_command_requires_format_argument()
    {
        // Test missing format
        $this->artisan('jetMailer:CreateMail --fromName="Helaly" --fromEmail=helaly@somedomain.local --toEmail=someone@somedomain.local --subject="My Message Subject" --body="Email Message"')->assertExitCode(1);
    }

    public function test_create_mail_command_requires_body_argument()
    {
        // Test missing body
        $this->artisan('jetMailer:CreateMail --fromName="Helaly" --fromEmail=helaly@somedomain.local --toEmail=someone@somedomain.local --subject="My Message Subject" --format="html"')->assertExitCode(1);
    }

    public function test_create_mail_command_requires_subject_argument()
    {
        // Test missing subject
        $this->artisan('jetMailer:CreateMail --fromName="Helaly" --fromEmail=helaly@somedomain.local --toEmail=someone@somedomain.local --body="Email Message" --format="html"')->assertExitCode(1);
    }

    public function test_create_mail_command_requires_to_argument()
    {
        // Test missing To Email
        $this->artisan('jetMailer:CreateMail --fromName="Helaly" --fromEmail=helaly@somedomain.local --subject="My Message Subject" --body="Email Message" --format="html"')->assertExitCode(1);
    }

    public function test_create_mail_command_requires_from_email_argument()
    {
        // Test missing From Email
        $this->artisan('jetMailer:CreateMail --fromName="Helaly" --toEmail=someone@somedomain.local --subject="My Message Subject" --body="Email Message" --format="html"')->assertExitCode(1);
    }

    public function test_create_mail_command_requires_from_name_argument()
    {
        // Test missing From Name
        $this->artisan('jetMailer:CreateMail --fromEmail=helaly@somedomain.local --toEmail=someone@somedomain.local --subject="My Message Subject" --body="Email Message" --format="html"')->assertExitCode(1);
    }
}
