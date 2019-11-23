# PHP-Video-Operations
manipulate videos using PHP and FFMpeg commands

# How this library works:

## Requirements


- FFmpeg:
    - install ffmpeg on the system and add it to terminal environment
-  [PHP-FFMpeg](https://github.com/PHP-FFMpeg/PHP-FFMpeg "Heading link")

- Install using composer
    ```sh
    composer install
    ```
Using videoProcessorv class:
-------------
    require_once 'vendor/autoload.php';

	include "videoProcessor.php";

	create videoProcessor object 
	    
	example:
	    $videoProcessor = new videoProcessor();

### Current functions


| Function | Parameters | Returns
| ------ | ------ |------ |
| getSize() | $VideoPath | Video Size in Bytes
| getDuration() | $VideoPath | Vdieo Durations in sconds
| mergeVideosHorizontally() | $VideoPath1 , $VideoPath2 | Merged file 
| separateSoundLayer | $video | Array($videoFile,$extractAudio)


# Example
    <?php
    require_once 'vendor/autoload.php';

    header("Content-Type: text/html;charset=UTF-8");

    include "videoProcessor.php";

    $processType=$_REQUEST['process'];

    $videoProcessor = new videoProcessor();
        switch ($processType){
            case "size":{
                echo $videoProcessor->getSize($_REQUEST['file_path']);
            }break;
            case "duration":{
                echo $videoProcessor->getDuration($_REQUEST['file_path']);
            }break;
            case "mergeVideosHorizontally":{
                echo $videoProcessor->mergeVideosHorizontally($_REQUEST['file1_path'],$_REQUEST['file2_path']);
            }break;
            case "separateSoundLayer":{
                echo json_encode($videoProcessor->separateSoundLayer($_REQUEST['file_path']));
            }break;

        }
