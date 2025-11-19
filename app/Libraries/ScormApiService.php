<?php

namespace App\Libraries;
use Illuminate\Support\Facades\Http;

class ScormApiService
{
    private $apiBaseUrl = 'https://cloud.scorm.com/api/v2/';
    private $authorizationHeader = 'Basic U1NESTZCS1lIODpDQ1o0Z1M0Szd3OXd2V0I3NG1ZQmtQMWRwTjhLNnI3Zk1tc3lJQTd3';

    /**
     * Create a new SCORM registration.
     *
     * @param string $registrationId
     * @param array $learner
     * @param string $courseId
     * @return array|null
     */
    public function createRegistration(string $registrationId, array $learner, string $courseId)
    {
        $response = Http::withHeaders($this->getHeaders())
            ->post($this->apiBaseUrl . 'registrations', [
                'courseId' => $courseId,
                'learner' => $learner,
                'registrationId' => $registrationId,
            ]);

        return $this->handleResponse($response);
    }

    /**
     * Generate a launch link for a SCORM registration.
     *
     * @param string $registrationId
     * @param int $expiry
     * @param string $redirectOnExitUrl
     * @return array|null
     */
    public function generateLaunchLink(string $registrationId, int $expiry, string $redirectOnExitUrl)
    {
        $response = Http::withHeaders($this->getHeaders())
            ->post($this->apiBaseUrl . "registrations/{$registrationId}/launchLink", [
                'registrationId' => $registrationId,
                'expiry' => $expiry,
                'redirectOnExitUrl' => $redirectOnExitUrl,
            ]);

        return $this->handleResponse($response);
    }

    /**
     * Get the headers for the API requests.
     *
     * @return array
     */
    private function getHeaders()
    {
        return [
            'Authorization' => $this->authorizationHeader,
            'Content-Type' => 'application/json',
        ];
    }

    public function getRegistrationDetails(string $registrationId)
    {
        $response = Http::withHeaders($this->getHeaders())
            ->get($this->apiBaseUrl . "registrations/{$registrationId}");

        return $this->handleResponse($response);
    }

    public function getCourse(string $courseId, bool $includeRegistrationCount = false, bool $includeCourseMetadata = false)
    {
        $queryParams = http_build_query([
            'includeRegistrationCount' => $includeRegistrationCount ? 'true' : 'false',
            'includeCourseMetadata' => $includeCourseMetadata ? 'true' : 'false',
        ]);

        $response = Http::withHeaders($this->getHeaders())
            ->get($this->apiBaseUrl . "courses/{$courseId}?{$queryParams}");

        return $this->handleResponse($response);
    }

    /**
     * Handle the API response.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return array|null
     */
    private function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json();
        } else {
            // Log the error or handle it as needed
            \Log::error('SCORM API Error: ' . $response->body());
            return null;
        }
    }
}
