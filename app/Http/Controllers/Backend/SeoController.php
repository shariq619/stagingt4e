<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SEO;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $seos = SEO::when(!empty($search), function($query) use ($search) {
            return $query->where('slug', 'like', "%{$search}%");
        })->paginate(50);

        return view('backend.seo.index', compact('seos'));
    }

    public function create()
    {
        $seo = new SEO();
        $idFormEdit = false;

        // Get only the pages that are not in the database
        $filteredPages = $this->getFilteredPages();

        return view('backend.seo.create', compact('seo', 'idFormEdit', 'filteredPages'));
    }


    public function store(Request $request)
    {

        // Extract the slug from the full URL if necessary
        $inputSlug = trim($request->input('slug'), '/');

        // Validate the slug
        $request->validate([
            'slug' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Extract the last segment of the slug
                    $lastSegment = trim(parse_url($value, PHP_URL_PATH), '/');

                    // Check if this last segment already exists in the database
                    if (Seo::where('slug', 'LIKE', "%/$lastSegment")->exists()) {
                        $fail('The url already exists.');
                    }
                },
            ],
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'robots' => 'required',
        ]);

        $seo = new SEO();
        $seo->slug = $request->slug;
        $seo->meta_title = $request->meta_title;
        $seo->meta_description = $request->meta_description;
        $seo->meta_keywords = $request->meta_keywords;
        $seo->robots = $request->robots;
		$seo->seo_score = calculateSeoScore($request->meta_title, $request->meta_description, $request->meta_keywords);
        $seo->save();

        return redirect()->route('backend.seo.index')->with('success', 'SEO created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit(SEO $seo)
    {
        $idFormEdit = true;

        // Get all pages (so user can select any)
        $filteredPages = $this->getAllPages();

        return view('backend.seo.edit', compact('seo', 'idFormEdit', 'filteredPages'));
    }

    public function update(Request $request, SEO $seo)
    {
        //$seo->slug = $request->slug;
        $seo->meta_title = $request->meta_title;
        $seo->meta_description = $request->meta_description;
        $seo->meta_keywords = $request->meta_keywords;
        $seo->robots = $request->robots;
		$seo->seo_score = calculateSeoScore($request->meta_title, $request->meta_description, $request->meta_keywords);
        //$seo->page_schema = json_encode($request->page_schema);
        $seo->save();

        return redirect()->route('backend.seo.index')->with('success', 'SEO updated successfully');
    }

    public function destroy(SEO $seo)
    {
        $seo->delete();
        return redirect()->route('backend.seo.index')->with('success', 'SEO deleted successfully');
    }


// Function to filter available pages (only unused ones)
    private function getFilteredPages()
    {
        $availablePages = $this->getAllPages();

        // Get existing SEO slugs from the database
        $existingSlugs = SEO::pluck('slug')->toArray();

        // Filter out pages that already exist
        return array_filter($availablePages, function ($slug) use ($existingSlugs) {
            return !in_array($slug, $existingSlugs);
        });
    }

// Function to get all pages (for edit form)
    private function getAllPages()
    {
        return [
            'home.index' => route('home.index'),
            'about' => route('about'),
            'courses.index' => route('courses.index'),
            'elearning.index' => route('elearning.index'),
            'examination.requirements' => route('examination.requirements'),
            'expert.resources' => route('expert.resources'),
            'contact' => route('contact'),
        ];
    }

}
