<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Libraries\ScormCloud_Php_Sample;
use App\Models\Category;
use Illuminate\Http\Request;

class ScormController extends Controller
{
    function main() {

        // Configure HTTP basic authorization: APP_NORMAL
        $config = new ScormCloud\Configuration();
        $config->setUsername(env('APP_ID'));
        $config->setPassword(env('SECRET_KEY'));

        ScormCloud\Configuration::setDefaultConfiguration($config);

        $sc = new ScormCloud_Php_Sample();

        try {

            $course_id = 'ACTAwarenesse-learningSCORM1.2v5.0.3d226061b-ad18-4173-b78f-bf66574cfe65';
            $learner_id = 'kane';
            $learnerEmail = 'kane@gmail.com';
            $learnerFirstName = 'kane';
            $learnerLastName = 'joe';
            $registration_id = 'reg_' . $course_id . '_' . uniqid();


            $sc->createRegistration($course_id, $learner_id, $learnerEmail, $learnerFirstName, $learnerLastName, $registration_id);

            // Show details of the newly imported course
            //echo 'Newly Imported Course Details: ', PHP_EOL;
            //echo $courseDetails, PHP_EOL;

            // Create the registration launch link
            $launchLink = $sc->buildLaunchLink($registration_id);

            // Show the launch link
            //echo OUTPUT_BORDER, PHP_EOL;
            echo "Launch Link: {$launchLink}", PHP_EOL;
//            echo 'Navigate to the url above to take the course. Hit enter once complete.', PHP_EOL;
//            readline();



            // Get the results for the registration
           // $registrationProgress = $sc->getResultForRegistration($registration_id);

            // Show details of the registration progress
            //echo OUTPUT_BORDER, PHP_EOL;
           // echo 'Registration Progess: ', PHP_EOL;
           // echo $registrationProgress, PHP_EOL;



            // Get information about all the courses in ScormCloud
           // $courseList = $sc->getAllCourses();

            // Show details of the courses
            //echo OUTPUT_BORDER, PHP_EOL;
//            echo 'Course List: ', PHP_EOL;
//            foreach ($courseList as $course) {
//                echo $course, PHP_EOL;
//            }



            // Get information about all the registrations in ScormCloud
          //  $registrationList = $sc->getAllRegistrations();

            // Show details of the registrations
            //echo OUTPUT_BORDER, PHP_EOL;
//            echo 'Registration List: ', PHP_EOL;
//            foreach ($registrationList as $registration) {
//                echo $registration, PHP_EOL;
//            }
        } catch (ScormCloud\ApiException | InvalidArgumentException $e) {
            echo $e->getMessage(), PHP_EOL;
        } finally {
            // Delete all the data created by this sample
            //$sc->cleanUp(COURSE_ID, REGISTRATION_ID);
        }
    }


}
