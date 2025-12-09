<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ApiDocumentationController extends Controller
{
    /**
     * Display the API documentation page.
     *
     * @param string|null $section
     * @return View
     */
    public function index(?string $section = null): View
    {
        $sections = $this->getSections();
        
        // Default to first section if none specified
        if (!$section || !isset($sections[$section])) {
            $section = array_key_first($sections);
        }

        return view('docs.api.index', [
            'sections' => $sections,
            'currentSection' => $section,
            'baseUrl' => config('app.url') . '/api/v1',
        ]);
    }

    /**
     * Get all available documentation sections.
     *
     * @return array
     */
    protected function getSections(): array
    {
        return [
            'getting-started' => [
                'title' => 'Getting Started',
                'icon' => 'rocket',
                'content' => [
                    [
                        'title' => 'Introduction',
                        'description' => 'Welcome to the Gramsea API. This API allows you to integrate your applications with our platform.',
                    ],
                    [
                        'title' => 'Authentication',
                        'description' => 'All API requests require authentication using Bearer tokens. You can create tokens in your account settings.',
                        'code' => [
                            'language' => 'bash',
                            'content' => 'curl -H "Authorization: Bearer YOUR_API_TOKEN" \\
     -H "Accept: application/json" \\
     https://gramsea.com/api/v1/user',
                        ],
                    ],
                    [
                        'title' => 'Rate Limiting',
                        'description' => 'API requests are limited to 60 requests per minute. You can check your current rate limit status in the response headers.',
                    ],
                ],
            ],
            'user' => [
                'title' => 'User',
                'icon' => 'user',
                'endpoints' => [
                    [
                        'method' => 'GET',
                        'path' => '/user',
                        'title' => 'Get Profile',
                        'description' => 'Retrieve the authenticated user\'s profile information.',
                        'headers' => [
                            'Authorization' => 'Bearer {token}',
                            'Accept' => 'application/json',
                        ],
                        'response' => [
                            'success' => true,
                            'data' => [
                                'id' => 1,
                                'name' => 'John Doe',
                                'email' => 'john@example.com',
                                'phone' => '+62812345678',
                                'credit' => 150.00,
                                'email_verified_at' => '2024-01-01T00:00:00.000000Z',
                                'two_factor_enabled' => false,
                                'created_at' => '2024-01-01T00:00:00.000000Z',
                            ],
                        ],
                        'abilities' => ['read'],
                    ],
                    [
                        'method' => 'GET',
                        'path' => '/user/credit',
                        'title' => 'Get Credit Balance',
                        'description' => 'Retrieve the authenticated user\'s current credit balance.',
                        'headers' => [
                            'Authorization' => 'Bearer {token}',
                            'Accept' => 'application/json',
                        ],
                        'response' => [
                            'success' => true,
                            'data' => [
                                'credit' => 150.00,
                                'formatted_credit' => '150.00',
                            ],
                        ],
                        'abilities' => ['read'],
                    ],
                ],
            ],
            'errors' => [
                'title' => 'Errors',
                'icon' => 'exclamation-triangle',
                'content' => [
                    [
                        'title' => 'Error Handling',
                        'description' => 'The API uses standard HTTP response codes to indicate success or failure of requests.',
                    ],
                ],
                'error_codes' => [
                    ['code' => '200', 'status' => 'OK', 'description' => 'Request successful'],
                    ['code' => '401', 'status' => 'Unauthorized', 'description' => 'Invalid or missing API token'],
                    ['code' => '403', 'status' => 'Forbidden', 'description' => 'Token does not have required abilities'],
                    ['code' => '404', 'status' => 'Not Found', 'description' => 'Resource not found'],
                    ['code' => '422', 'status' => 'Unprocessable Entity', 'description' => 'Validation error'],
                    ['code' => '429', 'status' => 'Too Many Requests', 'description' => 'Rate limit exceeded'],
                    ['code' => '500', 'status' => 'Server Error', 'description' => 'Internal server error'],
                ],
            ],
        ];
    }
}
