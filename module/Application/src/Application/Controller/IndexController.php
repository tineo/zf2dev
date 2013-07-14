<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZendGData;
use Zend\Http\Client\Adapter\Curl;
class IndexController extends AbstractActionController
{
    public function indexAction()
    {

    	// Parameters for ClientAuth authentication
		$service = ZendGData\Photos::AUTH_SERVICE_NAME;
		//$user = "itsudatte01@gmail.com";
		//$pass = "docomo@maki";
		$user = "maki.development@gmail.com";
		$pass = "maki@maki";		
		$adapter = new Curl();

		//$adapter = $adapter->setCurlOption(CURLOPT_SSL_VERIFYHOST,false);
		//$adapter = $adapter->setCurlOption(CURLOPT_SSL_VERIFYPEER,false);

		// Create an authenticated HTTP client
		$httpClient = new ZendGData\HttpClient();
		$httpClient->setOptions(array('sslverifypeer' => false));
        //$httpClient->setAdapter($adapter);
        $client = ZendGData\ClientLogin::getHttpClient($user, $pass, $service, $httpClient);
        

		// Create an instance of the service
		$service = new ZendGData\Photos($client);

		//$query = new ZendGData\Photos\UserQuery();
		$query = new ZendGData\Photos\AlbumQuery();
		//$query = new ZendGData\Photos\PhotosQuery();
		$query->setUser("default");
		//$query->setAlbumId(1000000430310944);
		//$query->setPhotoId(114570428327230310944);
		//114570428327230310944
		$query->setAlbumId(5894662952100736817);
		try {

			$userFeed = $service->getUserFeed("default");
    		foreach ($userFeed as $userEntry) {
        		//echo $userEntry->title->text . "<br />\n";
    		}
    		
    		echo "<br/><br/><br/>";

    		echo "<pre>";

    		if ($this->zfcUserAuthentication()->hasIdentity()) {
    			//get the email of the user
    			//echo $this->zfcUserAuthentication()->getIdentity()->getEmail();
   				//get the user_id of the user
    			//echo $this->zfcUserAuthentication()->getIdentity()->getId();
    			//get the username of the user
    			//echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
    			//get the display name of the user
    			echo $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
			}else{
				echo "no user";
			}
			echo "</pre>";
			
    		
			$albumFeed = $service->getAlbumFeed($query);
			//echo "<pre>";
    		//var_dump(get_class_methods("ZendGData\Photos\PhotoEntry"));
    		//var_dump(get_class_methods( get_class( $albumFeed ) ));

    		//var_dump(get_class_methods( get_class( $albumFeed ) ));
    		//var_dump($albumFeed->getLink());
    		$link = $albumFeed->getLink();
    		echo "<a href=".$link[3]->getHref().">";
    		echo $albumFeed->getTitle();
    		//var_dump($link);
    		//echo "</pre>";
    		echo "</a>";

			//echo $albumFeed->getAlbumName();			
			foreach ($albumFeed as $entry) {
				//echo "<img href='";
				//echo $albumEntry->getId();
				//echo $entry->description->text . "<br />\n";
				$update_time = $entry->getUpdated();
				//print $update_time. '<br/>';
				$photo_id = $entry->getId();
				$photo_id_index = strrpos($photo_id, '/photoid/');
				$account_id_index = strpos($photo_id, '/user/');
				$album_id_index = strpos($photo_id, '/albumid/');
				
				$account_id = substr($photo_id, $account_id_index+ 6, $album_id_index - ($account_id_index + 6));
				$picasa_album_id = $entry->getGphotoAlbumId();
				$photo_id = substr($photo_id, $photo_id_index + 9);
				//echo "' />\n";
				//echo $photo_id;
				//echo "<br />";

				$thumb = $entry->getMediaGroup()->getThumbnail();

    			$content = $entry->getMediaGroup()->getContent();

    			echo "<pre>";
    			//
    			//var_dump(get_object_vars($entry));
    			//var_dump(get_class_methods("ZendGData\Photos\PhotoEntry"));
    			//var_dump(get_class_methods( get_class( $entry->getMediaGroup() ) ));
    			echo $entry->getMediaGroup()->getDescription();
    			echo "</pre>";
    			echo "<img src='" . $content[0]->getUrl() . "' />";      
    			echo "<img src='" . $thumb[1]->getUrl() . "' />"; 
			}



			
			//$photoFeed = $service->getPhotoFeed($query);
			/*foreach ($photoFeed as $photoEntry) {
				//echo "<img href='";
				//echo $albumEntry->getPhotoId();
				//echo "' />\n";
				echo $photoEntry->getMediaThumbnails();
			}*/
			//echo $photoFeed->getMediaThumbnails()->get(0)->getUrl();
			
			/*$profiler = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')->getProfiler();
			$queryProfiles = $profiler->getQueryProfiles();
 
			foreach($queryProfiles as $key=>$row)
			{
    			print_r($row->toArray());
			}*/


		} catch (ZendGData\App\Exception $e) {
			echo "Error: " . $e->getMessage();
		}

		/*try {
    		$userFeed = $service->getUserFeed(null, $query);
    		echo "<pre>";
    		var_dump($userFeed);
    		echo "</pre>";
		} catch (ZendGData\App\Exception $e) {
    		echo "Error: " . $e->getMessage();
		}*/

        return new ViewModel();
    }
}
