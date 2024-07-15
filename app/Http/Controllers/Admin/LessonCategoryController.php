<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LessonCategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LessonCategoryController extends Controller
{
    public function show()
    {
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lesson_categories = LessonCategory::all();

        return view('admin.pages.dashboard.lesson-category', compact('lesson_categories'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make($request->all(), [
            'lesson_category' => 'required',
            'icon' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $lesson_categories = new LessonCategory();
        $lesson_categories->lesson_category = $request->lesson_category;
        if ($request->hasFile('icon')) {
            if ($lesson_categories->icon) {
                $oldImage = public_path('admin/assets/images/LessonCategory/'.basename($lesson_categories->icon));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->icon->extension();
            $path = $request->file('icon')->move(public_path('admin/assets/images/LessonCategory'), $fileName);
            $lesson_categories->icon = url('admin/assets/images/LessonCategory/'.$fileName);
        }
        $lesson_categories->description = $request->description;

        $lesson_categories->save();
        if ($lesson_categories) {
            return redirect()->route('lesson-category')->with('success', 'Lesson Category Created Successfully.');

        } else {
            return redirect()->route('lesson-category')->with('error', 'Failed To Create Lesson Category.Please Retry..');
        }
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make($request->all(), [
            'lesson_category' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $lesson_categories = LessonCategory::find($id);
        $lesson_categories->lesson_category = $request->lesson_category;
        if ($request->hasFile('icon')) {
            if ($lesson_categories->icon) {
                $oldImage = public_path('admin/assets/images/LessonCategory/'.basename($lesson_categories->icon));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->icon->extension();
            $path = $request->file('icon')->move(public_path('admin/assets/images/LessonCategory'), $fileName);
            $lesson_categories->icon = url('admin/assets/images/LessonCategory/'.$fileName);
        }
        $lesson_categories->description = $request->description;
        $lesson_categories->update();
        if ($lesson_categories) {
            return redirect()->route('lesson-category')->with('success', 'Lesson Category Updated Successfully.');

        } else {
            return redirect()->route('lesson-category')->with('error', 'Failed To Update Lesson Category.Please Retry..');
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lesson_categories = LessonCategory::find($id);
        $lesson_categories->delete();
        if ($lesson_categories) {
            return redirect()->route('lesson-category')->with('success', 'Lesson Category Deleted Successfully.');

        } else {
            return redirect()->route('lesson-category')->with('error', 'Failed To Delete Lesson Category.Please Retry..');
        }
    }
}
