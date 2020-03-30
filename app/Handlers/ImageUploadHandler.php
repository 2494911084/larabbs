<?php
namespace App\Handlers;
use Image;

class ImageUploadHandler
{
    protected $typeLimit = ['png', 'jpg', 'jpeg', 'gif'];

    /**
     * @param  $file 文件
     * @param  $iden 文件路径标识 /upload/images/$iden/202012/12
     * @param  $mid 当前用户的id 用于文件命名
     * @return ['path' => '文件路径']
     */
    public function save($file, $iden, $mid, $max_width)
    {
        // 构建文件存储路径命名
        $path_name = "upload/images/$iden/" . date('Ym/d', time());
        // 构建文件上传路径
        $upload_path = public_path() . '/' . $path_name;
        // 获取文件后缀名
        $extension = $file->extension()?:'png';
        // 校验文件后缀名
        if (!in_array($extension, $this->typeLimit)) {
            return false;
        }
        // 拼接文件名
        $file_name = $mid . '_' . \Str::random(10) . '_' . time() . '.' . $extension;
        // 文件上传
        $file->move($upload_path, $file_name);
        // 图片裁剪
        if ($max_width && $extension != 'gif') {
            $this->makeImage($path_name . '/' . $file_name, $max_width);
        }
        // 返回文件路径
        return [
            'path' => config('app.url') . '/' . $path_name . '/' . $file_name,
        ];
    }

    public function makeImage($file, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file);

        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }
}
