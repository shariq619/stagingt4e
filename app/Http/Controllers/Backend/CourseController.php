<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AwardingBody;
use App\Models\Category;
use App\Models\Certification;
use App\Models\Course;
use App\Models\License;
use App\Models\Exam;
use App\Models\Qualification;
use App\Models\SubCategory;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$courses = Course::with('category', 'subcategory')->paginate(3);
        // $courses = Course::with('category','exams')->paginate(20);

        $search = $request->input('search');
        $courses = Course::with('category','exams');

        if (!empty($search)) {
            $courses = $courses->where('name', 'like', "%{$search}%");
        }
        $courses = $courses->paginate(50);

        if ($request->ajax()) {
            return view('backend.course.partials.courses_table', compact('courses'))->render();
        }
        return view('backend.course.index', compact('courses'));
    }

    // public function search(Request $request)
    // {
    //     $text = $request->input('text');

    //     if (empty($text)) {
    //         $courses = Course::all();
    //     } else {
    //         $courses = Course::where('name', 'like', '%' . $text . '%')->get();
    //     }

    //     return view('backend.course.search_rows', compact('courses'));
    // }

    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('cat_id', $categoryId)->pluck('name', 'id');
        return response()->json($subcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $licenses  = License::all();
        $categories = Category::all();
        $qualifications = Qualification::all();
        $exams = Exam::all();
        $certifications = Certification::all();
        $awardingBodies = AwardingBody::all();
        $deliveryModes = config('delivery_modes');

        $coursesGeneralEnrolment = Task::where('type', 'GeneralEnrolment')->get();
        $coursesCourseWork = Task::where('type', 'CourseWork')->get();
        $coursesReminders = Task::where('type', 'Reminders')->get();
        $coursesPostCompletion = Task::where('type', 'PostCompletion')->get();

        return view('backend.course.create', compact('certifications','awardingBodies','licenses','categories', 'qualifications', 'exams','deliveryModes','coursesGeneralEnrolment','coursesCourseWork','coursesReminders','coursesPostCompletion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required',
            'color_code' => 'required',
         //   'category_id' => 'required',
            'qualification' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
            'delivery_mode' => 'required',
            'key_information' => 'nullable',
            'requirements' => 'nullable',
            'certification' => 'required',
            'exams' => 'required',
            'awarding_bodies' => 'nullable',
            'long_desc' => 'nullable',
            'faqs' => 'nullable|array',
        ]);

        $qualificationType = $request->has('qualification_type')
            ? implode(',', $request->qualification_type)
            : null;


        $imageName = null;
        if ($request->hasFile('course_image') && $request->file('course_image')->isValid()) {
            $uploadedFile = $request->file('course_image');
            $fileName = time() . '_' . $request->course_name . '_' .$uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('course_images', $fileName, 'public');
            $imageName = 'storage/' . $filePath;
        }

        $bannerImageName = null;
        if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
            $uploadedFile = $request->file('banner_image');
            $fileName = time() . '_' . $request->course_name . '_' .$uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('banner_images', $fileName, 'public');
            $bannerImageName = 'storage/' . $filePath;
        }

        $course = Course::create([
            'name' => $request->course_name,
            'slug' => Str::slug($request->course_name),
            'course_image' => $imageName,
            'banner_image' => $bannerImageName,
            'color_code' => $request->color_code,
            'category_id' => $request->category_id ?? 0,
            'qualification' => $request->qualification,
            'banner_description' => $request->banner_description,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'delivery_mode' => $request->delivery_mode,
            'course_type' => $request->course_type,
            'course_structure' => $request->course_structure,
            'key_information' => $request->key_information,
            'requirements' => $request->requirements,
            'awarding_bodies' => $request->awarding_bodies,
            'certification' => implode(',', $request->certification),
            'qualification_type' => $qualificationType,
            'long_desc' => $request->long_desc,
            'faqs' => json_encode($request->faqs),
            'user_id' => auth()->id(),
        ]);

        // Attach tasks to the course
        $course->tasks()->attach($request->tasks);

        $course->licenses()->attach($request->licences);

        $course->exams()->attach($request->exams);

        // Attach selected licences to the course
        if ($request->has('licences')) {
            $course->elearningLicences()->attach($request->licences);
        }

        return redirect()->route('backend.courses.index')->with('success', 'Course successfully created');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::with('elearningLicences','exams','certifications')->find($id);
        $faqs = $course->faqs ? json_decode($course->faqs, true) : null;


        $coursesGeneralEnrolment = Task::where('type', 'GeneralEnrolment')->get();
        $coursesCourseWork = Task::where('type', 'CourseWork')->get();
        $coursesReminders = Task::where('type', 'Reminders')->get();
        $coursesPostCompletion = Task::where('type', 'PostCompletion')->get();

        // Get selected task IDs for the course
        $selectedTasks = $course->tasks->pluck('id')->toArray();


        //dd($coursesGeneralEnrolment,$selectedTasks);

        $licenses  = License::all();
        $categories = Category::all();
        $qualifications = Qualification::all();
        $exams = Exam::all();
        $selectedExams = $course->exams->pluck('id')->toArray();



        $deliveryModes = config('delivery_modes');
        $licenses  = License::all();
        $awardingBodies = AwardingBody::all();
        $certifications = Certification::all();
        return view('backend.course.edit', compact('certifications','selectedExams','awardingBodies','licenses','course', 'categories', 'qualifications', 'exams','deliveryModes','coursesGeneralEnrolment','coursesCourseWork','coursesReminders','coursesPostCompletion','selectedTasks', 'faqs'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $course = Course::find($id);

        $request->validate([
            'name' => 'required',
            'color_code' => 'required',
         //   'category_id' => 'required',
            'qualification' => 'required',
            'description' => 'required',
            'price' => 'required',
            'banner_description' => 'required',
            'duration' => 'required',
            'key_information' => 'nullable',
            'requirements' => 'nullable',
            'delivery_mode' => 'required',
            'certification' => 'required',
            'awardingBodies' => 'nullable',
            'long_desc' => 'nullable',
            'faqs' => 'nullable|array',
        ]);

        $awarding_bodies = in_array('Internal', $request->certification) ? null : $request->awarding_bodies;

        $qualificationType = $request->has('qualification_type')
            ? implode(',', $request->qualification_type)
            : null;

        $imageName = $course->course_image;
        if ($request->hasFile('course_image') && $request->file('course_image')->isValid()) {
            $uploadedFile = $request->file('course_image');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            $filePath = $uploadedFile->storeAs('course_images', $fileName, 'public');
            $imageName = 'storage/' . $filePath;
        }

        $bannerImageName = $course->banner_image;
        if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
            $uploadedFile = $request->file('banner_image');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            $filePath = $uploadedFile->storeAs('banner_images', $fileName, 'public');
            $bannerImageName = 'storage/' . $filePath;
        }


        // Use a transaction to ensure all operations succeed or fail together
        DB::beginTransaction();

        try {
            $course->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'course_image' => $imageName,
                'banner_image' => $bannerImageName,
                'color_code' => $request->color_code,
                'category_id' => $request->category_id ?? 0,
                'qualification' => $request->qualification,
                'banner_description' => $request->banner_description,
                'description' => $request->description,
                'price' => $request->price,
                'duration' => $request->duration,
                'delivery_mode' => $request->delivery_mode,
                'course_type' => $request->course_type,
                'course_structure' => $request->course_structure,
                'key_information' => $request->key_information,
                'requirements' => $request->requirements,
                'certification' => implode(',', $request->certification),
                'awarding_bodies' => $awarding_bodies,
                'user_id' => auth()->id(),
                'qualification_type' => $qualificationType,
                'long_desc' => $request->long_desc,
                'faqs' => json_encode($request->faqs),
            ]);

            // Synchronize related models only if the course update was successful
            $course->tasks()->sync($request->tasks);
            $course->exams()->sync($request->exams);
            // Sync the elearningLicences
            if ($request->has('licences')) {
                $course->licenses()->sync($request->licences);
            } else {
                $course->licenses()->detach();
            }

            DB::commit();

            return redirect()->route('backend.courses.index')->with('success', 'Course successfully updated');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Failed to update course: ' . $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        // Delete all cohorts associated with the course
        $course->cohorts()->delete();

        // Delete the course
        $course->delete();
        return redirect()->route('backend.courses.index')->with('success', 'Course successfully deleted');
    }

    public function getByDeliveryMode($deliveryMode)
    {
        $courses = Course::where('delivery_mode', $deliveryMode)->get();
        return response()->json($courses);
    }
}
