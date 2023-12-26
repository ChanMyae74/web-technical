<?php

namespace App\Repositories\Items;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemRepository
{
    public function store($request,$item, $attachment)
    {

        try {
            DB::beginTransaction();
            $itemStore  = Item::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'user_id' =>  Auth::id(),
                'price' => $request->price,
                'description' => $request->description,
                'user_name' => $request->user_name,
                'phone' => phone($request->phone)->formatE164(),
                'address' => $request->address,

            ]);

            $this->handleAttachments($request, $itemStore, $attachment);
            return 'success';
        } catch (QueryException $queryException) {
            dd($queryException);
            return null;
        }
    }
    public function handleAttachments($request, $item, $attachment): array
    {
        $attachments = [];

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $attachments[] = $this->storeAttachment($file, $item, $attachment);
            }
        }
        return $attachments;
    }

    private function storeAttachment($file, $item, $attachment)
    {
        $uniqueName = uniqid().'_itemPhoto_'.$file->getClientOriginalName();
        $originalName = $file->getClientOriginalName();
        $extension = $file->extension();
        $path = 'public/ItemPhoto';

        $file->storeAs($path, $uniqueName);

        $attachmentParams = [
            'uuid' => Str::uuid()->toString(),
            'item_id' => $item->id,
            'org_name' => $originalName,
            'unique_name' => $uniqueName,
            'extension' => $extension,
            'path' => $path,
            'status' => 'item_photo'
        ];

        return $attachment->create($attachmentParams);
    }
    public function update($request,$item, $attachment)
    {
        try {
            DB::beginTransaction();
            $item_param = [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'user_id' =>  Auth::id(),
                'price' => $request->price,
                'description' => $request->description,
                'user_name' => $request->user_name,
                'phone' => phone($request->phone)->formatE164(),
                'address' => $request->address,
            ];
            $item->update($item_param);
            $this->handleAttachments($request, $item, $attachment);
            return 'success';
        } catch (QueryException $queryException) {
            dd($queryException);
            return null;
        }
    }
    public function destroy($item, $attachment)
    {
        try {
            DB::beginTransaction();
            $item->delete();
            $attachment->delete();
            return 'success';

        } catch (QueryException $queryException) {
            return null;
        }
    }
}
