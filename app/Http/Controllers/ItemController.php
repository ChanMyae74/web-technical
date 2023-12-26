<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\Items\StoreRequest;
use App\Http\Requests\Dashboard\Items\UpdateRequest;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Item;
use App\Repositories\Items\ItemRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ItemController extends Controller

{
    public $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        return $this->itemRepository = $itemRepository;
    }

    public function index(Request $request)
    {
        $query = Item::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('category_id', 'LIKE', '%' . request('search') . '%')
                ->orWhere('description', 'LIKE', '%' . request('search') . '%')
                ->orWhere('price', 'LIKE', '%' . request('search') . '%')
                ->orWhere('user_name', 'LIKE', '%' . request('search') . '%');
        }
        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        return Inertia::render('AdminDashboard/Items/Index', [
            'items' => $query->paginate(7 ?? config('setting.paginate_count'))->withQueryString(),
            'category' => Category::select('id', 'name')->get(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

    public function create()
    {
        return Inertia::render('AdminDashboard/Items/Create', [
            'categories' => Category::all()
        ]);
    }

    public function store(StoreRequest $request, Item $item, Attachment $attachment)
    {
        $result = $this->itemRepository->store($request, $item, $attachment);
        if (!is_null($result)) {
            DB::commit();
            return redirect()->route('dashboard:items:all')->with('message', 'Add Item Successfully.');
        }
        DB::rollBack();
        return redirect()->route('dashboard:items:all')->with('error', 'Something want wrong.');
    }

    public function edit(Item $item)
    {
        return Inertia::render('AdminDashboard/Items/Edit', [
                'item' => $item,
                'categories' => Category::select('id', 'name')->get()
            ]
        );
    }

    public function update(UpdateRequest $request, Item $item, Attachment $attachment)
    {
        $result = $this->itemRepository->update($request, $item, $attachment);
        if (!is_null($result)) {
            DB::commit();
            return redirect()->route('dashboard:items:all')->with('message', 'Item Updated.');
        }
        DB::rollBack();
        return redirect()->route('dashboard:items:all')->with('error', 'Something want wrong.');
    }

    public function destroy(Item $item, Attachment $attachment)
    {

        $result = $this->itemRepository->destroy($item, $attachment);
        if (!is_null($result)) {
            DB::commit();
            return redirect()->route('dashboard:items:all')->with("message", "Item deleted.");
        }
        DB::rollBack();
        return redirect()->route('dashboard:items:all')->with('error', 'Something want wrong.');
    }
}
