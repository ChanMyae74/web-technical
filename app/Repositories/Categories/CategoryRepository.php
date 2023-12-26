<?php

namespace App\Repositories\Categories;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryRepository
{
    public function store($request, $attachment)
    {
        try {
            DB::beginTransaction();
            $categoryStore  = Category::create([
                'name' => $request->name,
                'user_id' =>  Auth::id(),
                'is_publish' => $request->is_publish ? 'true' : 'false',
            ]);

            $this->handleAttachments($request, $categoryStore, $attachment);
            return 'success';
        } catch (QueryException $queryException) {
            dd($queryException);
            return null;
        }
    }
    public function handleAttachments($request, $category, $attachment): array
    {
        $attachments = [];

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $attachments[] = $this->storeAttachment($file, $category, $attachment);
            }
        }
        return $attachments;
    }

    private function storeAttachment($file, $category, $attachment)
    {
        $uniqueName = uniqid().'_categoryPhoto_'.$file->getClientOriginalName();
        $originalName = $file->getClientOriginalName();
        $extension = $file->extension();
        $path = 'public/CategoryPhoto';

        $file->storeAs($path, $uniqueName);

        $attachmentParams = [
            'uuid' => Str::uuid()->toString(),
            'category_id' => $category->id,
            'org_name' => $originalName,
            'unique_name' => $uniqueName,
            'extension' => $extension,
            'path' => $path,
            'status' => 'category_photo'
        ];

        return $attachment->create($attachmentParams);
    }
    public function update($request,$category, $attachment)
    {
        try {
            DB::beginTransaction();
//
            $category_param = [
                'name' => $request->name,
                'user_id' =>  Auth::id(),
                'is_publish' => $request->is_publish ? 'true' : 'false',
            ];
            $category->update($category_param);
            $this->handleAttachments($request, $category, $attachment);
            return 'success';
        } catch (QueryException $queryException) {
            dd($queryException);
            return null;
        }
    }
    public function destroy($category, $attachment)
    {
        try {
            DB::beginTransaction();
            $category->delete();
            $attachment->delete();
            return 'success';

        } catch (QueryException $queryException) {
            return null;
        }
    }
}
