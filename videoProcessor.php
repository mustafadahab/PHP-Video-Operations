<?php

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Format\Audio\Mp3;

class videoProcessor{

public $ffprobe;
public $ffmpeg;
public $audioFilePath=__DIR__.'/audio';
public $videoFilePath=__DIR__.'/video';


    public function __construct()
    {
        $this->ffprobe = FFProbe::create();
        $this->ffmpeg = FFMpeg::create();
    }

    public function getSize($video){
        $size=$this->ffprobe
            ->format($video)                        // extracts file informations
            ->get('size');                  // returns the size property

        return $size;
    }

    public function getDuration($video){
        $videoDuration=$this->ffprobe
            ->format($video)                        // extracts file informations
            ->get('duration');             // returns the duration property
        return $videoDuration; }

    public function mergeVideosHorizontally($video1,$video2){

         $video1=$this->ffprobe->format($video1)->get('filename');
         $video2=$this->ffprobe->format($video2)->get('filename');
         $outputPath = $this->videoFilePath."/".rand().".mp4";

         $output = exec( "ffmpeg -i ".$video1." -i ".$video2." -filter_complex [0:v]pad=iw*2:ih[int];[int][1:v]overlay=W/2:0[vid] -map [vid] -c:v libx264 -crf 23 -preset veryfast ".$outputPath ." 2>&1" );

         if($output)return $outputPath;

         return "Something went wrong !";
    }

/*    public function mergeVideosVertically($video1,$video2){ return $outputVideo; }*/

    public function separateSoundLayer($video){
        $videoName=$this->ffprobe->format($video)->get('filename');
        // Open your video file
        $video = $this->ffmpeg->open( $video );
        // Set an audio format
        $audio_format = new Mp3();
        // Extract the audio into a new file as mp3
        $outputPath = $this->audioFilePath."/".rand().".mp3";

        $outputAudio=$video->save($audio_format, $outputPath);

        return [ 'video' => $videoName, 'audio' => $outputPath];
    }
}