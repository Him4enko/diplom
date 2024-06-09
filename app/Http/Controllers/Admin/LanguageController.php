<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    public function index()
    {
        return view('admin.language.index');
    }

    public function getLanguageList(): JsonResponse
    {
        $languages = Language::all(['id', 'name', 'code', 'rtl', 'status', 'is_default']);
        return response()->json($languages);
    }

    public function updateLanguage(Request $request, int $id): JsonResponse
    {
        $language = Language::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'rtl' => 'required|string',
            'status' => 'required|string',
            'is_default' => 'required|string',
        ]);

        $language->update($validatedData);

        return response()->json($language);
    }

    public function deleteLanguage(int $languageId): JsonResponse
    {
        $languages = Language::all(['id', 'name', 'code', 'rtl', 'status', 'is_default']);
        return response()->json($languages);
    }
}
