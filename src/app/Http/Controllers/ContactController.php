<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Contact;
use App\Models\Category;
use App\Models\AdminUsers;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
    public  function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }
    public  function confirm(ContactRequest $request)
    {
        $contact = $request->only( ['first_name','last_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);
        $categories = Category::all();
        return view('confirm', ['contact' => $contact, 'categories' => $categories]);
    }
    public  function store(Request $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);
        return view('thanks');
    }
    public  function register()
    {
        return view('register');
    }
    public  function registerStore(RegisterRequest $request)
    {
        $register = $request->only(['name', 'email', 'password']);
        AdminUsers::create($register);
        return redirect('/register');
    }
    public  function search()
    {
        $contacts = Contact::paginate(7);
        return view('admin', compact('contacts'));
    }
    public  function adminSearch(Request $request)
    {
        //$contacts = Contact::with('contacts') -> keywordSearch($request) -> get();
        $contacts = Contact::keywordSearch($request)->paginate(7)->appends($request->all());
        $categories = Category::all();
        return view('admin', compact('contacts','categories'));
    }
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    public function export(Request $request)
    {
        $contacts = Contact::with('contacts') -> keywordSearch($request) -> get();

        $csvHeader = [
            '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容', '作成日'
        ];

        $csvData = [];

        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->first_name,
                $contact->last_name,
                $contact->gender,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category_id,
                $contact->detail,
                $contact->created_at->format('Y-m-d H:i:s'),
            ];
        }

        $callback = function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=contacts.csv',
        ]);
    }
}
