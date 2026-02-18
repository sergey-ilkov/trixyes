<?php

namespace App\Services\Admin;



use DOMDocument;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use App\Interface\Admin\PostAdminInterface;

class PostAdminService
{
    /**
     * Create a new class instance.
     */

    public $postInterface;

    public function __construct(PostAdminInterface $postInterface)
    {
        //
        $this->postInterface = $postInterface;
    }


    public function getPosts()
    {

        return $this->postInterface->all();
    }

    public function getPagination($num)
    {
        return $this->postInterface->paginate($num);
    }

    public function getPost($id)
    {

        return $this->postInterface->find($id);
    }

    public function createPost($request)
    {

        $data = $this->getFormDataSaveImages($request);


        return $this->postInterface->create($data);
    }
    public function showPost($id)
    {

        return $this->postInterface->find($id);
    }

    public function updatePost($id, $request)
    {
        $post = $this->postInterface->find($id);

        if (!$post) {

            return false;
        }

        $data = $this->getFormDataSaveImages($request, $post);

        return $this->postInterface->update($post, $data);
    }

    public function deletePost($id)
    {
        $post = $this->postInterface->find($id);

        if (!$post) {
            return false;
        }

        $this->deleteImage($post->image);
        $this->deleteImage($post->image_min);


        foreach ($post->getTranslations('body') as $lang => $content) {


            $domPost = new DOMDocument();
            $domPost->loadHTML('<meta http-equiv="Content-Type" content="charset=utf-8" />' . $content);
            $domImages = $domPost->getElementsByTagName('img');

            foreach ($domImages as $key => $img) {
                $pathReplace = str_replace('/storage', '', $img->getAttribute('src'));
                $this->deleteImage($pathReplace);
            }
        }


        return $this->postInterface->delete($post);
    }


    public function getFormDataSaveImages($request, $post = null)
    {

        $pathImage = '';
        $pathImageMin = '';

        // ? save image
        $image = $request->file('image');


        if (!$image && $post) {
            $pathImage = $post->image;
            $pathImageMin = $post->image_min;
        }


        if ($image) {


            $name = time();
            $ext = $image->getClientOriginalExtension();
            $imageName = $name . '.' . $ext;
            $pathImage = $image->storeAs('/images/blog', $imageName);

            $imgManager = new ImageManager(new Driver());

            $thumbImage = $imgManager->read('storage/' . $pathImage);

            $thumbImage->scale(width: 450);
            $pathImageMin = 'images/blog/' . $name . '-min.' . $ext;
            $thumbImage->save(public_path('storage/' . $pathImageMin));


            if ($post) {
                $this->deleteImage($post->image);
                $this->deleteImage($post->image_min);
            }
        }


        $content_body = $request->body;


        $newPathImages = [];

        foreach ($content_body as $lang => $content) {



            $dom = new DOMDocument();
            $dom->loadHTML('<meta http-equiv="Content-Type" content="charset=utf-8" />' . $content);

            $images = $dom->getElementsByTagName('img');



            if ($images->length > 0) {
                foreach ($images as $key => $img) {
                    if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                        $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                        $image_path = '/storage/images/blog/' . time() . $key . '.png';
                        file_put_contents(public_path($image_path), $data);

                        $img->removeAttribute('data-filename');
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $image_path);
                    }
                    array_push($newPathImages, $img->getAttribute('src'));
                }

                $html = '';
                $body_items = $dom->getElementsByTagName('body')->item(0)->childNodes;

                foreach ($body_items as $node) {
                    $html .= $dom->saveHTML($node);
                }



                $content_body[$lang] = $html;
            }
        }


        if ($post) {

            foreach ($post->getTranslations('body') as $lang => $content) {

                $postPathImages = [];
                $domPost = new DOMDocument();
                $domPost->loadHTML('<meta http-equiv="Content-Type" content="charset=utf-8" />' . $content);
                $domImages = $domPost->getElementsByTagName('img');

                foreach ($domImages as $key => $img) {
                    array_push($postPathImages, $img->getAttribute('src'));
                }

                for ($i = 0; $i < count($postPathImages); $i++) {


                    if (strpos($postPathImages[$i], 'https://') === 0) {
                        continue;
                    }

                    if (!in_array($postPathImages[$i], $newPathImages)) {
                        $pathReplace = str_replace('/storage', '', $postPathImages[$i]);
                        $this->deleteImage($pathReplace);
                    }
                }
            }
        }

        return [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'views' => $request->views,
            'image' => $pathImage,
            'image_min' => $pathImageMin,
            'alt_image' => $request->alt_image,
            'body' => $content_body,
            'published' => $request->has('published') ? true : false,
            'slider' => $request->has('slider') ? true : false,
        ];
    }

    public function deleteImage($imagePath)
    {

        Storage::disk('public')->delete($imagePath);
    }
}