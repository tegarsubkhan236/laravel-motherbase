<?php

namespace Modules\Blog\Http\Controllers;

use App\Casts\UserStatus;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Http\Models\BlogCategory;
use Modules\Blog\Http\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('SUPER ADMIN')){
            $data = BlogPost::with('user','blog_post_categories')->paginate(3);
        } else {
            $data = BlogPost::with('user','blog_post_categories')->where('authorId', $user['id'])->paginate(3);
        }

        return view('blog::pages.post.index',[
            'title' => 'Blog Post',
            'data' => $data
        ]);
    }

    public function create()
    {
        $categories = BlogCategory::with('children')->where('parentId', null)->get();
        $user = Auth::user();
        if ($user->hasRole('SUPER ADMIN')){
            $written_by = User::query()->where('status', UserStatus::ACTIVE)->get();
        } else {
            $written_by = ['name'=>$user['name'], 'id'=>$user['id']];
        }
        return view('blog::pages.post.form', [
            'categories' => $categories,
            'written_by' => $written_by
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'meta_title' => 'nullable',
            'written_by' => 'required',
            'created_at' => 'required',
            'categories' => 'required|array',
            'published' => 'nullable'
        ]);
        $data = $request->all();
        unset($data['__token']);
        DB::beginTransaction();
        try {
            $store = BlogPost::query()->create([
                'title' => $data['title'],
                'meta_title' => $data['meta_title'],
                'content' => $data['content'],
                'authorId' => $data['written_by'],
                'parentId' => null,
                'summary' => null,
                'published' => $data['published'] == 'on' ? 1 : 0,
                'publishedAt' => date("Y-m-d h:i:s",strtotime($data['created_at'])),
                'createdAt' => date("Y-m-d h:i:s",strtotime($data['created_at'])),
                'updatedAt' => date("Y-m-d h:i:s",strtotime($data['created_at'])),
            ]);
            if ($store) {
                $sync = BlogPost::query()->find($store->id);
                $sync->blog_post_categories()->sync($request->get('categories'));
            }
            DB::commit();
            return redirect()->back()->with('success', 'Data has been created successfully');
        } catch (Exception $e){
            DB::rollBack();
            return $e;
        }
    }

    public function show($id)
    {
        return view('blog::show');
    }

    public function edit($id)
    {
        return view('blog::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
