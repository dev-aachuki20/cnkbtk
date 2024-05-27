<?php
use App\Models\Uploads;
use App\Models\Setting;
use App\Models\Points;

// require_once('vendor/autoload.php');

// $client = new \GuzzleHttp\Client();


/**
 * uploadImage function
 * to upload an image.
 * @param  $directory
 * @param  $file
 * @param string $folder
 * @return array $response
 */
if (!function_exists('uploadImage')) {

	function uploadImage($directory, $file, $folder)
	{
		$upload               = new Uploads;
		$upload->path         = $file->store($folder, 'public');
		$upload->type         = $file->getClientOriginalExtension();
		$response             = $directory->uploads()->save($upload);
	}

}


/**
 * deleteFile function
 * to destroy an old Image.
 * @param int $upload_id
 * @return void
 */
if (!function_exists('deleteFile')) {

	function deleteFile($upload_id)
	{
		$upload = Uploads::find($upload_id);
		\Storage::disk('public')->delete($upload->path);
		$upload->delete();
	}

}


if(!function_exists('getSiteSetting')){
	function getSiteSetting()
	{
		$settings = Setting::where('status',1)->get();
		$data = [];
		foreach($settings as $key => $val){
			$data[$val->key] = $val->value;
		}
		return $data;
		
	}
}
if(!function_exists('getLangUrl')){
	function getLangUrl()
	{
		$url = app()->getLocale() == config('constant.language.english')  ?  config("constant.datatableLangUrl.english") : config("constant.datatableLangUrl.chinese");
		return $url;
		
	}
}

if(!function_exists('getbannerType')){
	function getbannerType()
	{	
		if(app()->getLocale() == "en"){
			$data = ["home_banner_image" =>  "Home Banner Image" ,
			// "home_banner_upper_img" => "Home Banner Uppper Image",
			// "home_banner_lower_img" => "Home Banner Lower Image",
			"notification_image" =>  "Notification Image"];
		}else{
			$data = ["home_banner_image" =>  "主页横幅图片" ,
			// "home_banner_upper_img" => "Home Banner Uppper Image",
			// "home_banner_lower_img" => "Home Banner Lower Image",
			"notification_image" =>  "通知图片"];
		}
		
		
		return $data;
		
	}
}

if(!function_exists('getExplodedName')){
	function getExplodedName($str)
	{	
		$data = explode(' ',$str,2);
		return $data;
		
	}
}




if(!function_exists('getCurrentAvailablePoint')){
	function getCurrentAvailablePoint($userId = null)
	{	
		if($userId){
			$data = Points::where("user_id",$userId)->orderBy("id","desc")->first();
		}else{
			$data = Points::where("user_id",auth()->user()->id)->orderBy("id","desc")->first();
		}
			
		$points = 0;
		if(!empty($data)){
			$points = $data->available_general_point;
		}
		return $points;
	}
}

if (!function_exists('renderStars')) {
    function renderStars($rating)
    {
        $html = '<div class="ratingWrapper">
                    <div class="rating" role="radiogroup" id="starRatings" aria-labelledby="rating">';

        for ($i = 5; $i >= 1; $i--) {
            $checked = ($i <= $rating) ? 'checked' : '';
			$className = ($i <= $rating) ? 'check-active' : '';
            $html .= '<input type="radio" class="'.$className.'" id="star' . $i . '" name="star_rating" value="' . $i . '" ' . $checked . ' disabled>
                      <label for="star' . $i . '" aria-label="' . $i . ' stars" class="mb-1 '.$className.'"></label>';
        }

        $html .= '</div></div>';

        return $html;
    }
}









