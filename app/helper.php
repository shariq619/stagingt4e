<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\FrontOrder;
use Illuminate\Support\Str;
use App\Models\EmailMapping;
use App\Models\RequestBespoke;
use App\Models\TaskSubmission;
use App\Models\FrontOrderDetails;
use App\Models\UserCohortPayment;
use App\Models\UserPostQualification;
use App\Libraries\ScormCloud_Php_Sample;
use Darryldecode\Cart\Facades\CartFacade;
use RusticiSoftware\Cloud\V2 as ScormCloud;
use RusticiSoftware\Cloud\V2\Configuration;

if (!function_exists('getRegions')) {
    function getRegions()
    {
        $regions = [
            'East of England',
            'East Midlands',
            'London',
            'North East',
            'North West',
            'South East',
            'South West',
            'West Midlands',
            'Yorkshire and the Humber',
            'Northern Ireland',
            'Scotland',
            'Wales'
        ];

        return $regions;
    }
}

if (!function_exists('getRoles')) {
    function getRoles($role_name)
    {
        $learners = User::role($role_name)->get();
        return $learners;
    }
}
if (!function_exists('getFrontOrder')) {
    function getFrontOrder($userId, $cohortId)
    {
        return FrontOrderDetails::with(['frontOrder','latestInvoice'])
            ->where('cohort_id', $cohortId)
            ->whereHas('frontOrder', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->latest('id')
            ->first();
    }
}

if (!function_exists('getTotalLeadsCount')) {
    function getTotalLeadsCount()
    {
        $bespokeLeads = RequestBespoke::where('is_read', 0)->count();
        return $bespokeLeads;
    }
}

if (!function_exists('getTotalUnreadMessages')) {
    function getTotalUnreadMessages()
    {
        $unreadCount = auth()->user()->receivedMessages()->where('is_read', 0)->count();
        return $unreadCount;
    }
}

if (!function_exists('getUserPostQualification')) {
    function getUserPostQualification($userId, $cohortId)
    {
        $data = UserPostQualification::where(['user_id' => $userId, 'cohort_id' => $cohortId])->first();
        return $data;
    }
}
if (!function_exists('getCities')) {
    function getCities($region = null)
    {
        $cities = [
            'East of England' => ['Cambridge', 'Norwich', 'Ipswich'],
            'East Midlands' => ['Nottingham', 'Leicester', 'Derby'],
            'London' => ['City of London', 'Westminster', 'Camden'],
            'North East' => ['Newcastle', 'Sunderland', 'Durham'],
            'North West' => ['Manchester', 'Liverpool', 'Blackpool'],
            'South East' => ['Brighton', 'Oxford', 'Southampton'],
            'South West' => ['Bristol', 'Bath', 'Exeter'],
            'West Midlands' => ['Birmingham', 'Coventry', 'Wolverhampton'],
            'Yorkshire and the Humber' => ['Leeds', 'Sheffield', 'York'],
            'Northern Ireland' => ['Belfast', 'Derry', 'Lisburn'],
            'Scotland' => ['Edinburgh', 'Glasgow', 'Aberdeen'],
            'Wales' => ['Cardiff', 'Swansea', 'Newport']
        ];

        return $cities[$region] ?? [];
    }
}


if (!function_exists('sendPlainEmail')) {
    function sendPlainEmail($to, $subject, $message, $headers = '')
    {
        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('getFirstLettersOfWord')) {
    function getFirstLettersOfWord($word)
    {
        $words = preg_split('/[\s\-]+/', $word);
        $code = '';
        foreach ($words as $word) {
            if (!empty($word) && ctype_alpha($word[0])) {
                $code .= strtoupper($word[0]);
            }
        }
        return $code;
    }
}

if (! function_exists('crmGetFirstLettersOfWord')) {
    function crmGetFirstLettersOfWord(?string $text): string
    {
        if (!$text) {
            return '';
        }

        $ignore = [
            'at', 'in', 'on', 'of', 'for', 'and', 'the',
            'to', 'a', 'an', 'by', 'with', 'from'
        ];

        $text = trim(preg_replace('/\s+/', ' ', $text));
        $words = explode(' ', $text);

        $letters = [];

        foreach ($words as $word) {
            $clean = strtolower(preg_replace('/[^a-zA-Z]/', '', $word));
            if ($clean === '' || in_array($clean, $ignore, true)) {
                continue;
            }
            $letters[] = strtoupper(mb_substr($clean, 0, 1));
        }

        return implode('', $letters);
    }
}

if (!function_exists('limit_text')) {
    /**
     * Limit the text to a specified number of characters.
     *
     * @param string $text
     * @param int $limit
     * @return string
     */
    function limit_text($text, $limit = 100)
    {
        return strlen($text) > $limit ? substr($text, 0, $limit) . '...' : $text;
    }
}
if (!function_exists('getScormCourseInfo')) {
    function getScormCourseInfo($registration_id)
    {
        $config = new ScormCloud\Configuration();
        $config->setUsername(env('APP_ID'));
        $config->setPassword(env('SECRET_KEY'));
        ScormCloud\Configuration::setDefaultConfiguration($config);

        $sc = new ScormCloud_Php_Sample();
        return $sc->getResultForRegistration($registration_id);
    }
}

if (!function_exists('getAcronym')) {
    function getAcronym($name)
    {
        $words = explode(' ', $name);
        $acronym = '';
        foreach ($words as $word) {
            $acronym .= strtoupper($word[0]);
        }
        return $acronym;
    }
}

if (!function_exists('deslug')) {
    function deslug($slug)
    {
        return Str::title(str_replace('-', ' ', $slug));
    }
}

if (!function_exists('addOrdinalSuffix')) {
    function addOrdinalSuffix($day)
    {
        $suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        if (($day % 100 >= 11) && ($day % 100 <= 13)) {
            return $day . 'th';
        }
        return $day . $suffix[$day % 10];
    }
}

if (!function_exists('displayDates')) {
    function displayDates($start_date, $end_date)
    {
        $startDateTime = \Carbon\Carbon::parse($start_date);
        $endDateTime = \Carbon\Carbon::parse($end_date);

        if ($startDateTime->isSameDay($endDateTime)) {
            $formattedDate = addOrdinalSuffix($startDateTime->day) . ' ' . $startDateTime->format('M Y');
            $formattedTime = $startDateTime->format('g:iA') . ' to ' . $endDateTime->format('g:iA');
        } else {
            $formattedDate =
                addOrdinalSuffix($startDateTime->day) .
                ' – ' .
                addOrdinalSuffix($endDateTime->day) .
                ' ' .
                $startDateTime->format('M Y');
            $formattedTime =
                $startDateTime->format('g:iA') .
                ' to ' .
                $endDateTime->format('g:iA');
        }

        return $formattedDate . ',' . $formattedTime;
    }
}

if (!function_exists('cartCount')) {
    function cartCount()
    {
        return CartFacade::getContent()->count();
    }
}


if (!function_exists('formatCourseDate')) {
    function formatCourseDate($course)
    {


        // dd($course);

        $is_weekend = $course->is_weekend ?? "";
        $is_soldout = $course->is_soldout ?? "";


        $startDate = Carbon::parse($course->start_date_time);
        $endDate = Carbon::parse($course->end_date_time);
        $additionalTimes = json_decode($course->additional_times, true);

        // Format dates
        $startDay = $startDate->format('dS M Y');
        $startTime = $startDate->format('g:i A');
        $endDay = $endDate->format('dS M Y');
        $endTime = $endDate->format('g:i A');

        // Condition 1: Single full-day session
        if (is_null($additionalTimes) && $startDate->isSameDay($endDate)) {
            return "$startDay $startTime to $endTime" . (($is_weekend == 1) ? " (Divided Into Weekends)" : "") . (($is_soldout == 1) ? " (Sold Out)" : "");
        }

        // Condition 2: Split session on the same day
        elseif (!is_null($additionalTimes) && $startDate->isSameDay($endDate)) {
            $secondStartTime = Carbon::createFromFormat('H:i', $additionalTimes['second_start_time'])->format('g:i A');
            $secondEndTime = Carbon::createFromFormat('H:i', $additionalTimes['second_end_time'])->format('g:i A');

            return "$startDay $startTime to $endTime to $secondStartTime to $secondEndTime" . (($is_weekend == 1) ? " (Divided Into Weekends)" : "") . (($is_soldout == 1) ? " (Sold Out)" : "");
        }

        // Condition 3: Multi-day session (continuous)
        elseif (is_null($additionalTimes) && !$startDate->isSameDay($endDate)) {
            return "$startDay - $endDay $startTime to $endTime" . (($is_weekend == 1) ? " (Divided Into Weekends)" : "") . (($is_soldout == 1) ? " (Sold Out)" : "");
        }

        // Condition 4: Multi-day session with breaks
        elseif (!is_null($additionalTimes) && !$startDate->isSameDay($endDate)) {
            $secondStartTime = Carbon::createFromFormat('H:i', $additionalTimes['second_start_time'])->format('g:i A');
            $secondEndTime = Carbon::createFromFormat('H:i', $additionalTimes['second_end_time'])->format('g:i A');

            return "$startDay, $startTime to $endTime – $endDay, $secondStartTime to $secondEndTime" . (($is_weekend == 1) ? " (Divided Into Weekends)" : "") . (($is_soldout == 1) ? " (Sold Out)" : "");
        }

        return null; // Default case (should not happen)
    }
}


if (!function_exists('formatCourseDateBold')) {
    function formatCourseDateBold($course)
    {
        $startDate = Carbon::parse($course->start_date_time);
        $endDate = Carbon::parse($course->end_date_time);
        $additionalTimes = json_decode($course->additional_times, true);

        // Format dates
        $startDay = '<strong>' . $startDate->format('dS M Y') . '</strong>';
        $startTime = $startDate->format('g:i A');
        $endDay = '<strong>' . $endDate->format('dS M Y') . '</strong>';
        $endTime = $endDate->format('g:i A');

        // Condition 1: Single full-day session
        if (is_null($additionalTimes) && $startDate->isSameDay($endDate)) {
            return "$startDay $startTime to $endTime";
        }

        // Condition 2: Split session on the same day
        elseif (!is_null($additionalTimes) && $startDate->isSameDay($endDate)) {
            $secondStartTime = Carbon::createFromFormat('H:i', $additionalTimes['second_start_time'])->format('g:i A');
            $secondEndTime = Carbon::createFromFormat('H:i', $additionalTimes['second_end_time'])->format('g:i A');

            return "$startDay $startTime to $endTime, $secondStartTime to $secondEndTime";
        }

        // Condition 3: Multi-day session (continuous)
        elseif (is_null($additionalTimes) && !$startDate->isSameDay($endDate)) {
            return "$startDay - $endDay $startTime to $endTime";
        }

        // Condition 4: Multi-day session with breaks
        elseif (!is_null($additionalTimes) && !$startDate->isSameDay($endDate)) {
            $secondStartTime = Carbon::createFromFormat('H:i', $additionalTimes['second_start_time'])->format('g:i A');
            $secondEndTime = Carbon::createFromFormat('H:i', $additionalTimes['second_end_time'])->format('g:i A');

            return "$startDay, $startTime to $endTime – $endDay, $secondStartTime to $secondEndTime";
        }

        return null; // Default case (should not happen)
    }
}


if (!function_exists('formatCourseCalDate')) {
    function formatCourseCalDate($course)
    {
        $is_weekend = $course->is_weekend ?? "";
        $is_soldout = $course->is_soldout ?? "";

        $startDate = Carbon::parse($course->start_date_time);
        $endDate = Carbon::parse($course->end_date_time);
        $additionalTimes = json_decode($course->additional_times, true);

        // Format dates
        $startDay = '<b>' . $startDate->format('dS M Y') . '</b>';
        $startTime = $startDate->format('g:i A');
        $endDay = '<b>' . $endDate->format('dS M Y') . '</b>';
        $endTime = $endDate->format('g:i A');

        // Weekend/Sold Out label
        $labels = '';
        if ($is_weekend == 1) $labels .= " (Divided Into Weekends)";
        if ($is_soldout == 1) $labels .= " (Sold Out)";

        // Condition 1: Single full-day session
        if (is_null($additionalTimes) && $startDate->isSameDay($endDate)) {
            return "$startDay $startTime to $endTime$labels";
        }

        // Condition 2: Split session on the same day
        elseif (!is_null($additionalTimes) && $startDate->isSameDay($endDate)) {
            $secondStartTime = Carbon::createFromFormat('H:i', $additionalTimes['second_start_time'])->format('g:i A');
            $secondEndTime = Carbon::createFromFormat('H:i', $additionalTimes['second_end_time'])->format('g:i A');

            return "$startDay $startTime to $endTime to $secondStartTime to $secondEndTime$labels";
        }

        // Condition 3: Multi-day session (continuous)
        elseif (is_null($additionalTimes) && !$startDate->isSameDay($endDate)) {
            return "$startDay - $endDay $startTime to $endTime$labels";
        }

        // Condition 4: Multi-day session with breaks
        elseif (!is_null($additionalTimes) && !$startDate->isSameDay($endDate)) {
            $secondStartTime = Carbon::createFromFormat('H:i', $additionalTimes['second_start_time'])->format('g:i A');
            $secondEndTime = Carbon::createFromFormat('H:i', $additionalTimes['second_end_time'])->format('g:i A');

            return "$startDay, $startTime to $endTime – $endDay, $secondStartTime to $secondEndTime$labels";
        }

        return null; // Default case
    }
}


if (!function_exists('calculateSeoScore')) {
    function calculateSeoScore($title, $description, $keywords)
    {
        $score = 0;
        $maxScore = 100; // Max possible score

        // ✅ Title Length (Max: 25 points)
        $titleLength = strlen($title);
        if ($titleLength >= 50 && $titleLength <= 60) {
            $score += 25; // Perfect title length
        } elseif ($titleLength >= 30 && $titleLength < 50) {
            $score += 15; // Decent but short
        }

        // ✅ Description Length (Max: 25 points)
        $descLength = strlen($description);
        if ($descLength >= 150 && $descLength <= 160) {
            $score += 25; // Perfect description length
        } elseif ($descLength >= 100 && $descLength < 150) {
            $score += 15; // Decent but short
        }

        // ✅ Keyword Presence (Max: 30 points)
        $keywordsArray = explode(',', $keywords);
        $keywordsFound = 0;

        foreach ($keywordsArray as $keyword) {
            $keyword = trim($keyword); // Remove spaces
            if (!empty($keyword)) {
                if (stripos($title, $keyword) !== false) {
                    $keywordsFound += 1;
                }
                if (stripos($description, $keyword) !== false) {
                    $keywordsFound += 1;
                }
            }
        }

        if ($keywordsFound >= 2) {
            $score += 30; // Keywords found in both title & description
        } elseif ($keywordsFound == 1) {
            $score += 15; // Keyword found in either title or description
        }

        // ✅ Stop Words Penalty (Max: -5 points total)
        $stopWords = ['and', 'but', 'or', 'the', 'with', 'for', 'in', 'on']; // Common stop words
        $stopWordCount = 0;
        foreach ($stopWords as $word) {
            if (stripos($title, " $word ") !== false || stripos($description, " $word ") !== false) {
                $stopWordCount++;
            }
        }
        if ($stopWordCount > 0) {
            $score -= 5; // Apply max -5 penalty
        }

        // ✅ URL Optimization Check (Max: 5 points)
        if (!empty($_SERVER['REQUEST_URI']) && !empty($keywordsArray[0]) && stripos($_SERVER['REQUEST_URI'], trim($keywordsArray[0])) !== false) {
            $score += 5; // If URL contains the primary keyword
        }

        // Ensure score is between 0 and 100
        return min(max($score, 0), 100);
    }
}



if (!function_exists('getSeoScoreClass')) {
    function getSeoScoreClass($score)
    {
        if ($score >= 80) {
            return 'badge bg-success'; // Green for strong SEO
        } elseif ($score >= 50) {
            return 'badge bg-warning text-dark'; // Yellow for normal SEO
        } else {
            return 'badge bg-danger'; // Red for weak SEO
        }
    }
}


if (!function_exists('resolveDocumentPath')) {
    function resolveDocumentPath($relativePath)
    {
        if (!$relativePath) return null;

        $relativePath = str_replace('storage/', '', $relativePath);
        $basePath = storage_path('app/public');
        $fullPath = $basePath . '/' . $relativePath;

        if (file_exists($fullPath)) {
            return asset('storage/' . $relativePath);
        }

        $parts = explode('/', $relativePath);
        $currentPath = $basePath;

        foreach ($parts as $part) {
            $files = is_dir($currentPath) ? scandir($currentPath) : [];
            $match = collect($files)->first(fn($file) => strtolower($file) === strtolower($part));

            if (!$match) return null;

            $currentPath .= '/' . $match;
        }

        $finalRelative = str_replace($basePath . '/', '', $currentPath);
        return asset('storage/' . $finalRelative);
    }
}

if (!function_exists('getLearnerStatuses')) {
    function getLearnerStatuses()
    {
        return [
            'Cancelled',
            'Confirmed',
            'Drop-Out',
            'Failed',
            'HSA Resit',
            'No Show',
            'Non-Attendance',
            'Passed',
            'Provisional',
            'Transferred',
        ];
    }
}
if (!function_exists('getMappingVariables')) {
    function getMappingVariables()
    {
        $templates = EmailMapping::all();
        return $templates;
    }
}
if (!function_exists('getDataSources')) {
    function getDataSources()
    {
        return [
            'Address Book',
            'Appointments',
            'CustomerRecords',
            'Customers',
            'LearnerDelegates',
            'DbContacts',
            'ProductInvoice',
            'Sales Enquiries',
            'ServiceInvoice',
            'SourceRecords',
            'Sources',
            'Staff',
            'Tasks',
            'TrainingCourse',
        ];
    }
}
if (!function_exists('getStatusBadgeColor')) {
    function getStatusBadgeColor($status)
    {
        $colors = [
            'Cancelled' => 'dark',
            'Confirmed' => 'primary',
            'Drop-Out' => 'warning',
            'Failed' => 'danger',
            'HSA Resit' => 'info',
            'No Show' => 'dark',
            'Non-Attendance' => 'dark',
            'Passed' => 'success',
            'Provisional' => 'warning',
            'Transferred' => 'secondary',
        ];
        return $colors[$status] ?? 'secondary';
    }
}

if (!function_exists('getPaymentStatus')) {
    function getPaymentStatus()
    {
        return [
            'Unpaid',
            'Outstanding',
            'Paid',
        ];
    }
}
if (!function_exists('getFilterationData')) {
    function getFilterationData()
    {
        $query = TaskSubmission::with('trainer', 'course', 'cohort', 'cohort.venue')
            ->where('task_id', 11)
            ->orderBy('created_at', 'desc')
            ->get();
        $data = [
            'courses' => $query->pluck('course')->unique('id')->values(),
            'trainers' => $query->pluck('trainer')->unique('id')->values(),
            'cohorts' => $query->pluck('cohort')->unique('id')->values(),
            'venues' => $query->pluck('cohort.venue')->unique('id')->values(),
        ];
        return $data;
    }
}
// app/Helpers/CohortHelper.php

if (!function_exists('getCohortClientName')) {
    function getCohortClientName($cohort)
    {
        if (!isset($cohort->learners) || !count($cohort->learners)) {
            return null;
        }

        $clientId = $cohort->learners[0]->client_id;

        foreach ($cohort->learners as $trainer) {
            if ($trainer->client_id !== $clientId) {
                return null;
            }
        }
        $client = $cohort->learners[0]->client ?? null;
        if (!$client) {
            return null;
        }
        $nameParts = [];
        if (!empty($client->name)) {
            $nameParts[] = $client->name;
        }
        if (!empty($client->middle_name)) {
            $nameParts[] = $client->middle_name;
        }
        if (!empty($client->last_name)) {
            $nameParts[] = $client->last_name;
        }
        return count($nameParts) ? implode(' ', $nameParts) : null;
    }

    // if (!function_exists('hearAboutItData')) {
    //     function hearAboutItData()
    //     {
    //         $data = [
    //             '1' => 'Social Media (Facebook, Instagram, LinkedIn, X, TikTok, YouTube, etc.)',
    //             '2' => 'Search Engine (Google, Yahoo, etc)',
    //             '3' => 'Paid Google Advertisement',
    //             '4' => 'Paid Bing Advertisement',
    //             '5' => 'Word of Mouth',
    //             '6' => 'Email',
    //             '7' => 'Referred by a Trainer',
    //             '8' => 'Referred by a Friend',
    //             '9' => 'Third Party (Hurak, Get Licenced, etc)',
    //             '10' => 'Other',
    //         ];

    //         return $data;
    //     }
    // }
}

if (!function_exists('getInvoiceStatuses')) {
    function getInvoiceStatuses(): array
    {
        return [
            'Unpaid',
            'Outstanding',
            'Paid',
        ];
    }
}

if (!function_exists('invoiceStatusDefault')) {
    function invoiceStatusDefault(): string
    {
        return 'Outstanding';
    }
}

if (!function_exists('invoiceStatusOptionsHtml')) {
    function invoiceStatusOptionsHtml(?string $current = null): string
    {
        $current = $current ?: invoiceStatusDefault();
        $html = '';
        foreach (getInvoiceStatuses() as $s) {
            $sel = $current === $s ? ' selected' : '';
            $html .= '<option value="'.$s.'"'.$sel.'>'.$s.'</option>';
        }
        return $html;
    }
}

if (! function_exists('paymentTypes')) {
    function paymentTypes(): array
    {
        return [
            'BACS Transfer',
            'Cash',
            'Cheque',
            'Credit / Debit Card',
            'Direct Debit',
            'Hurak Marketplace Platform',
            'Payl8r',
            'PayPal',
            'Reed Courses',
            'Website',
        ];
    }
}


