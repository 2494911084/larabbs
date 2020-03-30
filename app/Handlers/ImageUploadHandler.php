<?php
namespace App\Handlers;

class ImageUploadHandler
{
    protected $typeLimit = ['png', 'jpg', 'jpeg', 'gif'];

    /**
     * @param  $file 文件
     * @param  $iden 文件路径标识 /upload/images/$iden/202012/12
     * @param  $mid 当前用户的id 用于文件命名
     * @return ['path' => '文件路径']
     */
    public function save($file, $iden, $mid)
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
        // 返回文件路径
        return [
            'path' => config('app.url') . '/' . $path_name . '/' . $file_name,
        ];
    }
}
