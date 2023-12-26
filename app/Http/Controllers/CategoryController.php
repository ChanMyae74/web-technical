<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\Categories\StoreRequest;
use App\Http\Requests\Dashboard\Categories\UpdateRequest;
use App\Models\Attachment;
use App\Models\Category;
use App\Repositories\Categories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        return $this->categoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {
        $query = Category::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        return Inertia::render('AdminDashboard/Categories/Index',
        [
            'categories' => $query->paginate(7 ?? config('setting.paginate_count'))->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);

    }
    public function create()
    {
        return Inertia::render('AdminDashboard/Categories/Create');
    }
    public function store(StoreRequest $request, Attachment $attachment)
    {
        $result = $this->categoryRepository->store($request, $attachment);
        if (!is_null($result)) {
            DB::commit();
            return redirect()->route('dashboard:categories:all')->with('message', 'Add Category Successfully.');
        }
        DB::rollBack();
        return redirect()->route('dashboard:categories:all')->with('error', 'Something want wrong.');
    }
    public function edit(Category $category)
    {
        return Inertia::render('AdminDashboard/Categories/Edit', [
                'category' => $category,
                'categories' => Category::select('id', 'name as label')->get()
            ]
        );
    }
    public function update(UpdateRequest $request, Category $category, Attachment $attachment)
    {
        $result = $this->categoryRepository->update($request, $category, $attachment);
        if (!is_null($result)) {
            DB::commit();
            return redirect()->route('dashboard:categories:all')->with('message', 'Category Updated.');
        }
        DB::rollBack();
        return redirect()->route('dashboard:categories:all')->with('error', 'Something want wrong.');
    }
    public function destroy(Category $category, Attachment $attachment)
    {

        $result = $this->categoryRepository->destroy($category, $attachment);
        if (!is_null($result)) {
            DB::commit();
            return redirect()->route('dashboard:categories:all')->with("message", "Category deleted.");
        }
        DB::rollBack();
        return redirect()->route('dashboard:categories:all')->with('error', 'Something want wrong.');
    }
}
