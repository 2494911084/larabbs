<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Handlers\ImageUploadHandler;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic)
	{
        // dd($request->order);
		$topics = $topic->orderWith($request->order)->with('category', 'user')->paginate();
        // dd($topics);
		return view('topics.index', compact('topics'));
	}

    public function show(Request $request, Topic $topic)
    {
        if (!empty($request->slug) && $request->slug != $topic->slug) {
            return redirect($topic->link(), 301);
        }
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
        $topic->fill($request->all());
        $topic->user_id = $request->user()->id;
		$topic->save();

		return redirect()->to($topic->link())->with('success', '帖子发布成功.');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

        return redirect()->to($topic->link())->with('success', '帖子更新成功.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '帖子删除成功.');
	}

    public function uploadImage(Request $request, ImageUploadHandler $upload)
    {
        $data = [
            'success' => false,
            'msg' => '图片上传成功',
            'file_path' => ''
        ];

        if ($file = $request->upload_file) {
            $result = $upload->save($file, 'topics', $request->user()->id, 1024);
            $data['success'] = 'true';
            $data['msg'] = '图片上传成功';
            $data['file_path'] = $result['path'];
        }

        return $data;
    }
}
