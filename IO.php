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

