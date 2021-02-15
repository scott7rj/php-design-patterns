<?php
namespace phpDesignPatterns;

class YouTubeDownloader {
    protected $yoututbe;
    protected $ffmpeg;

    public function __construct(string $youtubeApiKey) {
        $this->youtube = new YouTube($youtubeApiKey);
        $this->ffmpeg = new FFMpeg();
    }

    public function downloadVideo(string $url): void {
        echo "fetching metadata<br/>";
        echo "saving tmp file<br/>";
        echo "processing source video<br/>";
        echo "done<br/>";
    }
}

class YouTube {
    public function fetchVideo(): string {

    }
    public function saveAs(strting $path): void {

    }
}

class FFMpeg {
    public static function create(): FFMpeg {

    }
    public function open(string $video): void {

    }
}

class FFMpegVideo {
    public function filters(): self {}
    public function resize(): self {}
    public function synchronize(): self {}
    public function frame(): self {}
    public function save(): self {}
}

function clientCode(YoutubeDownloader $facade) {
    $facade->downloadVideo("https://www.youtube.com/watch?v=wpoeriwpri");
}

$facade = new YouTubeDownloader("APIKEY=XXXXXXX");
clientCode($facade);