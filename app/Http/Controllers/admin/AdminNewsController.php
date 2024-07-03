<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    public function list()
    {
        $news = News::latest()->paginate(10);
        return view('list_news', compact('news'));
    }
    public function delete($id)
    {
        $product = News::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('newslist')->with('success', 'Xóa tin thành công');
        } else {
            return redirect()->route('newslist')->with('error', 'Xóa tin thất bại');
        }
    }
    public function hidden($id)
    {
        $product = News::find($id);
        if ($product) {
            $product->is_show = 0;
            $product->save();
            return redirect()->route('newslist')->with('success', 'Ẩn tin thành công');
        } else {
            return redirect()->route('newslist')->with('error', 'Ẩn tin thất bại');
        }

    }
    public function show($id)
    {
        $product = News::find($id);
        if ($product) {
            $product->is_show = 1;
            $product->save();
            return redirect()->route('newslist')->with('success', 'Hiển thị tin thành công');
        } else {
            return redirect()->route('newslist')->with('error', 'Hiển thị tin thất bại');
        }
    }
}
