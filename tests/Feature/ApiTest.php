<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    
    public function test_get_mails_response_fromat()
    {
        // Test Getting Mails
        $response = $this->get('/api/mail');
        $response->assertStatus(200);
        $response->assertJsonCount(4);
        $response->assertJsonStructure([
            'items',
            'itemsCount'
        ]);
    }

    public function test_get_statistics_response_fromat()
    {
        // Test Getting Statistics
        $response = $this->get('/api/mail/statistics');
        $response->assertStatus(200);
        $response->assertJsonCount(6);
        $response->assertJsonStructure([
            'totalEmails',
            'scheduledEmails',
            'failedEmails',
            'deliveredEmails',
            'totalMTAs',
            'activeMTAs'
        ]);
    }

    public function test_create_new_mail_validation_rules()
    {
        // Test Sending Mail Missing Arguments
        $response = $this->post('/api/mail/', []);
        $response->assertJsonCount(6,'errors');
        $response->assertSee('The from name field is required.');
        $response->assertSee('The from email field is required.');
        $response->assertSee('The to email field is required.');
        $response->assertSee('The subject field is required.');
        $response->assertSee('The body field is required.');
        
    }

    public function test_email_delivery_using_any_mta_server()
    {
        // Test Mail Delivery
        $response = $this->post('/api/mail/', [
            "fromName" => "Helaly", 
            "fromEmail" => "helaly@somedomain.local", 
            "toEmail" => "someone@somedomain.local", 
            "subject" => "My Message Subject", 
            "body" => "Email Message Body",
            "format" => "markdown"
        ]);
        $response->assertJsonStructure([
            'statusCode',
            'statusMessage'
        ]);
        $response->assertJsonPath('statusCode', 1);
    }
}