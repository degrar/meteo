<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Content\LocalizedSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * MainController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // ...
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $language='es')
    {
        App::setLocale($language);
        if($language === 'es'){
            $change_language = '/en';
            $lang_code_string = 'ENG';
        }else{
            $change_language = '/';
            $lang_code_string = 'ESP';
        }
        return view('main', [
            'change_language' => $change_language,
            'lang_code_string' => $lang_code_string,
            'show_cookies_message' => !(array_key_exists('show_cookies_message',$_COOKIE) && $_COOKIE['show_cookies_message']==1)
            ]);
    }

    /**
     * @param Request $request
     */
    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'form_name' => 'required',
            'form_phone' => 'required',
            'form_mail' => 'required|email',
            'form_subject' => '',
            'form_body' => '',
            'form_terms_and_conditions' => 'required|accepted'
        ]);

        Mail::send('emails.contact', ['request' => $request], function ($m) use ($request) {
            $m->from($request->form_mail, $request->form_name);
            $m->to(config('morillas.mail'), config('morillas.mail_user'))->subject($request->form_subject);
        });
    }

    /**
     * @param $languageUri
     * @return string
     */
    protected function extractLanguage($languageUri) {
        $languageUri = explode("/", $languageUri);
        if(count($languageUri)==1) array_unshift($languageUri, "es");
        return current($languageUri);
    }

    /**
     * @param Request $request
     * @param $language
     */
    public function privacyPolicy(Request $request, $language)
    {
        $language =  $this->extractLanguage($language);
        $content = LocalizedSection::sectionName('Privacy Policy')->languageAbbr($language)->first();
        App::setLocale($language);
        if($language === 'es'){
            $home = '/';
            $change_language = Lang::get('web.linkprivacy',[],'en');
            $lang_code_string = 'ENG';

        }else{
            $home = '/en';
            $change_language = Lang::get('web.linkprivacy',[],'es');
            $lang_code_string = 'ESP';
        }
        return view('policy', [
            'content' => $content,
            'change_language' => $change_language,
            'lang_code_string' => $lang_code_string,
            'home' => $home,
        ]);
    }

    /**
     * @param Request $request
     * @param $language
     */
    public function cookiesPolicy(Request $request, $language)
    {
        $language =  $this->extractLanguage($language);
        $content = LocalizedSection::sectionName('Cookies Policy')->languageAbbr($language)->first();

        App::setLocale($language);
        if($language === 'es'){
            $home = '/';
            $change_language = Lang::get('web.linkcookies',[],'en');
            $lang_code_string = 'ENG';

        }else{
            $home = '/en';
            $change_language = Lang::get('web.linkcookies',[],'es');
            $lang_code_string = 'ESP';
        }
        return view('policy', [
            'content' => $content,
            'change_language' => $change_language,
            'lang_code_string' => $lang_code_string,
            'home' => $home,
        ]);
    }
}