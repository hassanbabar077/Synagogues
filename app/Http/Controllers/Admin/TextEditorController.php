<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TextEditor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TextEditorController extends Controller
{
    public function show()
    {
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = TextEditor::first();
        if (! $data) {
            // Handle case where no records are found, you may choose to initialize default values or handle it in another way.
            $tab_main_tab = 'default';
            $tab_torah_lessons = 'default';
            $tab_synagogues = 'default';
            $tab_today_times = 'default';
            $tab_contact_us = 'default';
            $info_about_us = 'default';
            $info_share = 'default';
        } else {
            $tab_main_tab = $data->tab_main_tab;
            $tab_torah_lessons = $data->tab_torah_lessons;
            $tab_synagogues = $data->tab_synagogues;
            $tab_today_times = $data->tab_today_times;
            $tab_contact_us = $data->tab_contact_us;
            $info_about_us = $data->info_about_us;
            $info_share = $data->info_share;
        }

        return view('admin.pages.dashboard.app-settings', compact(
            'tab_main_tab',
            'tab_torah_lessons',
            'tab_synagogues',
            'tab_today_times',
            'tab_contact_us',
            'info_about_us',
            'info_share'
        ));
    }

    public function Data(Request $request)
    {
        abort_if(Gate::denies('permission_app_settings'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jsonData = $request->input('data');
        $decodedData = json_decode($jsonData, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Please provide valid JSON Data.'], 400);
        }

        // Extracting fields from JSON data
        $tab_main_tab = $decodedData['tab_main_tab'] ?? null;
        $tab_torah_lessons = $decodedData['tab_torah_lessons'] ?? null;
        $tab_synagogues = $decodedData['tab_synagogues'] ?? null;
        $tab_today_times = $decodedData['tab_today_times'] ?? null;
        $tab_contact_us = $decodedData['tab_contact_us'] ?? null;
        $info_about_us = $decodedData['info_about_us'] ?? null;
        $info_share = $decodedData['info_share'] ?? null;

        // Save to the database
        $text_editor = TextEditor::first();
        $text_editor->tab_main_tab = $tab_main_tab;
        $text_editor->tab_torah_lessons = $tab_torah_lessons;
        $text_editor->tab_synagogues = $tab_synagogues;
        $text_editor->tab_today_times = $tab_today_times;
        $text_editor->tab_contact_us = $tab_contact_us;
        $text_editor->info_about_us = $info_about_us;
        $text_editor->info_share = $info_share;
        $text_editor->update();

        // Return response
        return response()->json([
            'tab_main_tab' => $tab_main_tab,
            'tab_torah_lessons' => $tab_torah_lessons,
            'tab_synagogues' => $tab_synagogues,
            'tab_today_times' => $tab_today_times,
            'tab_contact_us' => $tab_contact_us,
            'info_about_us' => $info_about_us,
            'info_share' => $info_share,
        ]);
    }
}
