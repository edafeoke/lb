<?php

namespace App\Http\Controllers\AdminControllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Artisan;
use Setting;
use URL;
use Str;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','web','role:admin','permission:manage-setting','2fa']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin-views.settings.index', [
        'backups' => $this->getBackups(),
      ]);
    }

    /**
     *	Change the Application Name
     * @param  \Illuminate\Http\Request  $request
     */
    public function appNameUpdate(Request $request)
    {
        $this->validate($request, [
                'app_name' => 'required|string|max:20|min:4',
            ]);

        $data = ['app_name'=> $request->app_name];

        $this->updateSettings($data);

        return redirect()->back()->with('success', 'App-name changed successfully');
    }

    /**
     *	Change the Application Logo
     * @param  \Illuminate\Http\Request  $request
     */
    public function appLogoUpdate(Request $request)
    {
        $this->validate($request, [
                 'app_dark_logo' => 'required|image|max:2048|mimes:jpeg,bmp,png,jpg',
                 'app_light_logo' => 'required|image|max:2048|mimes:jpeg,bmp,png,jpg',
             ]);

        $dark_logo = $request->file('app_dark_logo');
        $light_logo = $request->file('app_light_logo');

        $app_dark_logo = 'app-logo-dark'.'.'.'png';
        $app_light_logo = 'app-logo-light'.'.'.'png';

        $logoPath = "uploads/appLogo";
        $dark_logo->move($logoPath, $app_dark_logo);
        $light_logo->move($logoPath, $app_light_logo);

        $dark_logo_url = URL::to('/')."/uploads/appLogo/".$app_dark_logo;
        $light_logo_url = URL::to('/')."/uploads/appLogo/".$app_light_logo;

        $data = [
           'app_dark_logo'=> $dark_logo_url,
           'app_light_logo'=> $light_logo_url
         ];

        $this->updateSettings($data);

        return redirect()->back()->with('success', 'App-logo changed successfully');
    }

    /**
     *	Change the Application Logo
     * @param  \Illuminate\Http\Request  $request
     */
    public function appBackgroundImageUpdate(Request $request)
    {
        $this->validate($request, [
            'app_background_image' => 'required|image|max:2048|mimes:jpeg,bmp,png,jpg',
        ]);

        $app_background_image = $request->file('app_background_image');

        $app_background_imageTitle = 'app-background-image'.'.'.'png';

        $app_background_imagePath = "uploads/appBackgroundImage";
        $app_background_image->move($app_background_imagePath, $app_background_imageTitle);

        $app_background_image_url = url('/')."/uploads/appBackgroundImage/".$app_background_imageTitle;

        $data = [
            'app_background_image'=> $app_background_image_url,
        ];

        $this->updateSettings($data);

        return redirect()->back()->with('success', 'Background Image changed successfully');
    }

    /**
     *	Change the Application Theme
     * @param  \Illuminate\Http\Request  $request
     */
    public function appThemeUpdate(Request $request)
    {
        $this->validate($request, [
            'app_theme' => 'required',
        ]);
        $data = [
            'app_theme' => $request->app_theme,
            'app_sidebar' => $request->app_sidebar,
            'app_navbar' => $request->app_navbar,
            'app_dashboardBg' => $request->app_dashboardBg,
            'app_font_color' => $request->app_font_color,
        ];

        $this->updateSettings($data);

        return redirect()->back()->with('success', 'App-theme changed successfully');
    }

    public function authSettingsUpdate(Request $request)
    {
        $data = [
        '2fa' => ($request->two_factor_auth == 'on') ? 1 : 0,
        'captcha' => ($request->captcha == 'on') ? 1 : 0,
        'email_verification' => ($request->email_verification == 'on') ? 1 : 0,
      ];
        $this->updateSettings($data);

        return redirect()->back()->with('success', 'Authentication Settings Updated Successfully');
    }

    private function updateSettings($input)
    {
        foreach ($input as $key => $value) {
            setting([$key => $value])->save();
        }
    }

    /**
     * Run Application Files Backup
     * @param  string $value
     * @return [type]        [description]
     */
    public function backupFiles()
    {
        Artisan::call('backup:run', [ '--only-files' => true]);
        $output = Artisan::output();

        if (Str::contains($output, 'Backup completed!')) {
            return redirect()->back()->with('success', 'Application Files Backed-up successgully');
        } else {
            return redirect()->back()->with('error', 'Application Files Backed-up failed');
        }
    }

    /**
     * Run Application DB Backup
     * @param  string $value
     * @return [type]        [description]
     */
    public function backupDb()
    {
        Artisan::call('backup:run', [ '--only-db' => true]);
        $output = Artisan::output();

        if (Str::contains($output, 'Backup completed!')) {
            return redirect()->back()->with('success', 'Application Database Backed-up successgully');
        } else {
            return redirect()->back()->with('error', 'Application Database Backed-up failed');
        }
    }

    private function getBackups()
    {
        $path = storage_path('app/app-backups');

        // Check if backup-file-path already exist
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $files = File::allFiles($path);
        $backups = collect([]);
        foreach ($files as $dt) {
            $backups->push([
          'filename' => pathinfo($dt->getFilename(), PATHINFO_FILENAME),
          'extension' => pathinfo($dt->getFilename(), PATHINFO_EXTENSION),
          'path' => $dt->getPath(),
          'size' => $dt->getSize(),
          'time' => $dt->getMTime(),
        ]);
        }
        return $backups;
    }

    public function downloadBackup($name, $ext)
    {
        $path = storage_path('app/app-backups');
        $file = $path.'/'.$name.'.'.$ext;
        $status = Storage::disk('backup')->download($name.'.'.$ext, $name.'.'.$ext);
        return $status;
        // dd();
      // if($status){
      //   return redirect()->back()->with('success','Backup deleted successfully');
      // }else{
      //   return redirect()->back()->with('error','Ops! an error occured, Try Again');
      // }
    }
    public function deleteBackup($name, $ext)
    {
        $path = storage_path('app/app-backups');
        $file = $path.'/'.$name.'.'.$ext;
        $status = File::delete($file);
        if ($status) {
            return redirect()->back()->with('success', 'Backup deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Ops! an error occured, Try Again');
        }
    }
}
