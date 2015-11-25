<?php namespace Penst\Cores\Repositories\Us;

use Config;
use Penst\Cores\Exceptions\ValidationException;
use Response;
use Str;
use Event;
use Image;
use File;
use Penst\Models\Us\User;
use Penst\Cores\Repositories\AbstractValidator as Validator;
use Penst\Cores\Repositories\RepositoryAbstract;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class SettingRepository
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
class UserRepository extends RepositoryAbstract implements UserRepositoryInterface
{

    /*
     * @var \Setting
     */
    private $user;
    protected $width;
    protected $height;
    protected $thumbWidth;
    protected $thumbHeight;
    protected $imgDir;
    protected $perPage;

    protected static $rules = [
        'username' => 'required',
        'email' => 'required|email',


    ];

    /*
     * @param Setting $setting
     */
    public function __construct(User $user)
    {

        $this->user = $user;
        $config = Config::get('penst');
        $this->perPage = $config['per_page'];
        $this->width = $config['modules']['user']['image_size']['width'];
        $this->height = $config['modules']['user']['image_size']['height'];
        $this->thumbWidth = $config['modules']['user']['thumb_size']['width'];
        $this->thumbHeight = $config['modules']['user']['thumb_size']['height'];
        $this->imgDir = $config['modules']['user']['image_dir'];
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    /*
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            //--------------------------------------------------------

            $file = null;

            if (isset($attributes['image']))
                $file = $attributes['image'];


            if ($file) {
                $destinationPath = public_path() . $this->imgDir;
                $fileName = $file->getClientOriginalName();
                $fileSize = $file->getClientSize();

                $upload_success = $file->move($destinationPath, $fileName);

                if ($upload_success) {

                    // resizing an uploaded file
                    Image::make($destinationPath . $fileName)
                        ->resize($this->width, $this->height)
                        ->save($destinationPath . $fileName);

                    // thumb
                    Image::make($destinationPath . $fileName)
                        ->resize($this->thumbWidth, $this->thumbHeight)
                        ->save($destinationPath . "thumb_" . $fileName);


                    $this->project->file_name = $fileName;
                    $this->project->file_size = $fileSize;
                    $this->project->path = $this->imgDir;
                }
            }


            //--------------------------------------------------------

            $this->user->fill($attributes);
            $this->user->save();

            return $this->user;
        }

        throw new ValidationException('Project validation failed', $this->getErrors());
    }

    public function update($id, $attributes)
    {
        try {
            $this->user = $this->find($id);
            $attributes['activated'] = isset($attributes['activated']) ? true : false;
            $attributes['username'] = $this->user->username;
            if ($this->isValid($attributes)) {

                //-------------------------------------------------------
                if (isset($attributes['photo'])) {

                    $file = $attributes['photo'];

                    // delete old image
                    $destinationPath = public_path() . $this->imgDir;
                    File::delete($destinationPath . $this->user->file_name);
                    File::delete($destinationPath . "thumb_" . $this->user->file_name);

                    $destinationPath = public_path() . $this->imgDir;
                    $fileName = $file->getClientOriginalName();
                    $fileSize = $file->getClientSize();

                    $upload_success = $file->move($destinationPath, $fileName);

                    if ($upload_success) {

                        // resizing an uploaded file
                        Image::make($destinationPath . $fileName)->resize($this->width, $this->height)->save($destinationPath . $fileName);

                        // thumb
                        Image::make($destinationPath . $fileName)->resize($this->thumbWidth, $this->thumbHeight)->save($destinationPath . "thumb_" . $fileName);

                        $this->user->file_name = $fileName;
                        $this->user->file_size = $fileSize;
                        $this->user->photo = $this->imgDir;
                    }
                }
                //-------------------------------------------------------

                if ($this->user->fill($attributes)->save()) {

////                $this->user->resluggify();
//                $category = Category::find($attributes['category']);
//                $category->articles()->save($this->article);
                }


                return $this->user;
            }
        }
        catch (FileException $e) {

            throw new \Penst\Cores\Exceptions\ValidationException($e->getMessage(),$this->getErrors());
        }

        throw new \Penst\Cores\Exceptions\ValidationException('User validation failed', $this->getErrors());  // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function table()

    {
        return $this->user;
    }


}
