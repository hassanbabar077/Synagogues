<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrayerCategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PrayerCategoryController extends Controller
{
    public function show()
    {
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $prayer_categories = PrayerCategory::get();

        return view('admin.pages.dashboard.prayer-category', compact('prayer_categories'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $prayer_category = new PrayerCategory();
        $prayer_category->name = $request->name;
        if ($request->hasFile('icon')) {
            if ($prayer_category->icon) {
                $oldImage = public_path('admin/assets/images/PrayerCategory/'.basename($prayer_category->icon));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->icon->extension();
            $path = $request->file('icon')->move(public_path('admin/assets/images/PrayerCategory'), $fileName);
            $prayer_category->icon = url('admin/assets/images/PrayerCategory/'.$fileName);
        }
        $prayer_category->description = $request->description;
        $prayer_category->video = $request->video;
        $prayer_category->save();
        if ($prayer_category) {
            return redirect()->route('prayer-category')->with('success', 'Prayer Category Created Successfully.');

        } else {
            return redirect()->route('prayer-category')->with('error', 'Failed To Create Prayer Category.Please Retry..');
        }
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $prayer_category = PrayerCategory::find($id);

        if (! $prayer_category) {
            return redirect()->route('prayer-category')->with('error', 'Prayer Category Not Found.');
        }

        $prayer_category->name = $request->name;

        if ($request->hasFile('icon')) {
            if ($prayer_category->icon) {
                $oldImage = public_path('admin/assets/images/PrayerCategory/'.basename($prayer_category->icon));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->icon->extension();
            $path = $request->file('icon')->move(public_path('admin/assets/images/PrayerCategory'), $fileName);
            $prayer_category->icon = url('admin/assets/images/PrayerCategory/'.$fileName);
        }
        $prayer_category->description = $request->description;
        $prayer_category->video = $request->video;
        $prayer_category->save();

        if ($prayer_category) {
            return redirect()->route('prayer-category')->with('success', 'Prayer Category Updated Successfully.');
        } else {
            return redirect()->route('prayer-category')->with('error', 'Failed To Update Prayer Category. Please Retry.');
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $prayer_category = PrayerCategory::find($id);
        if ($prayer_category->icon) {
            $oldImage = public_path('admin/assets/images/PrayerCategory/'.basename($prayer_category->icon));
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $prayer_category->delete();
        if ($prayer_category) {
            return redirect()->route('prayer-category')->with('success', 'Prayer Category Deleted Successfully.');

        } else {
            return redirect()->route('prayer-category')->with('error', 'Failed To Delete Prayer Category.Please Retry..');
        }
    }
}
