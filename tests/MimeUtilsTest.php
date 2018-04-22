<?php
require __DIR__ . "/../src/MimeUtils.php";
use PHPUnit\Framework\TestCase;
use imonroe\mimeutils\MimeUtils;

class MimeUtilsTest extends TestCase
{

    private $check_array = array(
        'image' => array(
          "jpg" => "image/jpeg",
          "jpeg" => "image/jpeg",
          "gif" => "image/gif",
          "png" => "image/png",
          "bmp" => "image/bmp",
          "tiff" => "image/tiff",
          "tif" => "image/tiff",
          "ico" => "image/x-icon",
          "svg" => "image/svg+xml",
        ),
        'video' => array(
          "asf" => "video/x-ms-asf",
          "asx" => "video/x-ms-asf",
          "wmv" => "video/x-ms-wmv",
          "wmx" => "video/x-ms-wmx",
          "wm" => "video/x-ms-wm",
          "avi" => "video/avi",
          "divx" => "video/divx",
          "flv" => "video/x-flv",
          "mov" => "video/quicktime",
          "qt" => "video/quicktime",
          "mpeg" => "video/mpeg",
          "mpg" => "video/mpeg",
          "mpe" => "video/mpeg",
          "mp4" => "video/mp4",
          "m4v" => "video/mp4",
          "ogv" => "video/ogg",
          "webm" => "video/webm",
          "mkv" => "video/x-matroska",
          "3gp" => "video/3gpp",
          "3gpp" => "video/3gpp",
          "3g2" => "video/3gpp2",
          "3gp2" => "video/3gpp2",
        ),
        'text' => array(
          "txt" => "text/plain",
          "csv" => "text/csv",
          "tsv" => "text/tab-separated-values",
          "ics" => "text/calendar",
          "rtx" => "text/richtext",
          "css" => "text/css",
          "htm" => "text/html",
          "html" => "text/html",
          "vtt" => "text/vtt",
          "dfxp" => "application/ttaf+xml",
        ),
        'audio' => array(
          "mp3" => "audio/mpeg",
          "m4a" => "audio/mpeg",
          "m4b" => "audio/mpeg",
          "ra" => "audio/x-realaudio",
          "ram" => "audio/x-realaudio",
          "wav" => "audio/wav",
          "ogg" => "audio/ogg",
          "oga" => "audio/ogg",
          "mid" => "audio/midi",
          "midi" => "audio/midi",
          "wma" => "audio/x-ms-wma",
          "wax" => "audio/x-ms-wax",
          "mka" => "audio/x-matroska",
        ),
        'application' => array(
          "rtf" => "application/rtf",
          "js" => "application/javascript",
          "pdf" => "application/pdf",
          "swf" => "application/x-shockwave-flash",
          "class" => "application/java",
          "tar" => "application/x-tar",
          "zip" => "application/zip",
          "gz" => "application/x-gzip",
          "gzip" => "application/x-gzip",
          "rar" => "application/rar",
          "7z" => "application/x-7z-compressed",
          "psd" => "application/octet-stream",
          "xcf" => "application/octet-stream",
          "ai" => "application/postscript",
          "indd" => "application/x-indesign",
        ),
        'ms-office' => array(
          "doc" => "application/msword",
          "pot" => "application/vnd.ms-powerpoint",
          "pps" => "application/vnd.ms-powerpoint",
          "ppt" => "application/vnd.ms-powerpoint",
          "wri" => "application/vnd.ms-write",
          "xla" => "application/vnd.ms-excel",
          "xls" => "application/vnd.ms-excel",
          "xlt" => "application/vnd.ms-excel",
          "xlw" => "application/vnd.ms-excel",
          "mdb" => "application/vnd.ms-access",
          "mpp" => "application/vnd.ms-project",
          "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
          "docm" => "application/vnd.ms-word.document.macroEnabled.12",
          "dotx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
          "dotm" => "application/vnd.ms-word.template.macroEnabled.12",
          "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
          "xlsm" => "application/vnd.ms-excel.sheet.macroEnabled.12",
          "xlsb" => "application/vnd.ms-excel.sheet.binary.macroEnabled.12",
          "xltx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
          "xltm" => "application/vnd.ms-excel.template.macroEnabled.12",
          "xlam" => "application/vnd.ms-excel.addin.macroEnabled.12",
          "pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
          "pptm" => "application/vnd.ms-powerpoint.presentation.macroEnabled.12",
          "ppsx" => "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
          "ppsm" => "application/vnd.ms-powerpoint.slideshow.macroEnabled.12",
          "potx" => "application/vnd.openxmlformats-officedocument.presentationml.template",
          "potm" => "application/vnd.ms-powerpoint.template.macroEnabled.12",
          "ppam" => "application/vnd.ms-powerpoint.addin.macroEnabled.12",
          "sldx" => "application/vnd.openxmlformats-officedocument.presentationml.slide",
          "sldm" => "application/vnd.ms-powerpoint.slide.macroEnabled.12",
          "onetoc" => "application/onenote",
          "onetoc2" => "application/onenote",
          "onetmp" => "application/onenote",
          "onepkg" => "application/onenote",
          "oxps" => "application/oxps",
          "xps" => "application/vnd.ms-xpsdocument",
        ),
        'open-office' => array(
          "odt" => "application/vnd.oasis.opendocument.text",
          "odp" => "application/vnd.oasis.opendocument.presentation",
          "ods" => "application/vnd.oasis.opendocument.spreadsheet",
          "odg" => "application/vnd.oasis.opendocument.graphics",
          "odc" => "application/vnd.oasis.opendocument.chart",
          "odb" => "application/vnd.oasis.opendocument.database",
          "odf" => "application/vnd.oasis.opendocument.formula",
        ),
        'wordperfect' => array(
          "wp" => "application/wordperfect",
          "wpd" => "application/wordperfect",
        ),
        'iwork' => array(
          "key" => "application/vnd.apple.keynote",
          "numbers" => "application/vnd.apple.numbers",
          "pages" => "application/vnd.apple.pages",
        ),
    );

    private $flatten_check_array = [
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "gif" => "image/gif",
        "png" => "image/png",
        "bmp" => "image/bmp",
        "tiff" => "image/tiff",
        "tif" => "image/tiff",
        "ico" => "image/x-icon",
        "svg" => "image/svg+xml",
        "asf" => "video/x-ms-asf",
        "asx" => "video/x-ms-asf",
        "wmv" => "video/x-ms-wmv",
        "wmx" => "video/x-ms-wmx",
        "wm" => "video/x-ms-wm",
        "avi" => "video/avi",
        "divx" => "video/divx",
        "flv" => "video/x-flv",
        "mov" => "video/quicktime",
        "qt" => "video/quicktime",
        "mpeg" => "video/mpeg",
        "mpg" => "video/mpeg",
        "mpe" => "video/mpeg",
        "mp4" => "video/mp4",
        "m4v" => "video/mp4",
        "ogv" => "video/ogg",
        "webm" => "video/webm",
        "mkv" => "video/x-matroska",
        "3gp" => "video/3gpp",
        "3gpp" => "video/3gpp",
        "3g2" => "video/3gpp2",
        "3gp2" => "video/3gpp2",
        "txt" => "text/plain",
        "csv" => "text/csv",
        "tsv" => "text/tab-separated-values",
        "ics" => "text/calendar",
        "rtx" => "text/richtext",
        "css" => "text/css",
        "htm" => "text/html",
        "html" => "text/html",
        "vtt" => "text/vtt",
        "dfxp" => "application/ttaf+xml",
        "mp3" => "audio/mpeg",
        "m4a" => "audio/mpeg",
        "m4b" => "audio/mpeg",
        "ra" => "audio/x-realaudio",
        "ram" => "audio/x-realaudio",
        "wav" => "audio/wav",
        "ogg" => "audio/ogg",
        "oga" => "audio/ogg",
        "mid" => "audio/midi",
        "midi" => "audio/midi",
        "wma" => "audio/x-ms-wma",
        "wax" => "audio/x-ms-wax",
        "mka" => "audio/x-matroska",
        "rtf" => "application/rtf",
        "js" => "application/javascript",
        "pdf" => "application/pdf",
        "swf" => "application/x-shockwave-flash",
        "class" => "application/java",
        "tar" => "application/x-tar",
        "zip" => "application/zip",
        "gz" => "application/x-gzip",
        "gzip" => "application/x-gzip",
        "rar" => "application/rar",
        "7z" => "application/x-7z-compressed",
        "psd" => "application/octet-stream",
        "xcf" => "application/octet-stream",
        "ai" => "application/postscript",
        "indd" => "application/x-indesign",
        "doc" => "application/msword",
        "pot" => "application/vnd.ms-powerpoint",
        "pps" => "application/vnd.ms-powerpoint",
        "ppt" => "application/vnd.ms-powerpoint",
        "wri" => "application/vnd.ms-write",
        "xla" => "application/vnd.ms-excel",
        "xls" => "application/vnd.ms-excel",
        "xlt" => "application/vnd.ms-excel",
        "xlw" => "application/vnd.ms-excel",
        "mdb" => "application/vnd.ms-access",
        "mpp" => "application/vnd.ms-project",
        "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "docm" => "application/vnd.ms-word.document.macroEnabled.12",
        "dotx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
        "dotm" => "application/vnd.ms-word.template.macroEnabled.12",
        "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "xlsm" => "application/vnd.ms-excel.sheet.macroEnabled.12",
        "xlsb" => "application/vnd.ms-excel.sheet.binary.macroEnabled.12",
        "xltx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
        "xltm" => "application/vnd.ms-excel.template.macroEnabled.12",
        "xlam" => "application/vnd.ms-excel.addin.macroEnabled.12",
        "pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
        "pptm" => "application/vnd.ms-powerpoint.presentation.macroEnabled.12",
        "ppsx" => "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
        "ppsm" => "application/vnd.ms-powerpoint.slideshow.macroEnabled.12",
        "potx" => "application/vnd.openxmlformats-officedocument.presentationml.template",
        "potm" => "application/vnd.ms-powerpoint.template.macroEnabled.12",
        "ppam" => "application/vnd.ms-powerpoint.addin.macroEnabled.12",
        "sldx" => "application/vnd.openxmlformats-officedocument.presentationml.slide",
        "sldm" => "application/vnd.ms-powerpoint.slide.macroEnabled.12",
        "onetoc" => "application/onenote",
        "onetoc2" => "application/onenote",
        "onetmp" => "application/onenote",
        "onepkg" => "application/onenote",
        "oxps" => "application/oxps",
        "xps" => "application/vnd.ms-xpsdocument",
        "odt" => "application/vnd.oasis.opendocument.text",
        "odp" => "application/vnd.oasis.opendocument.presentation",
        "ods" => "application/vnd.oasis.opendocument.spreadsheet",
        "odg" => "application/vnd.oasis.opendocument.graphics",
        "odc" => "application/vnd.oasis.opendocument.chart",
        "odb" => "application/vnd.oasis.opendocument.database",
        "odf" => "application/vnd.oasis.opendocument.formula",
        "wp" => "application/wordperfect",
        "wpd" => "application/wordperfect",
        "key" => "application/vnd.apple.keynote",
        "numbers" => "application/vnd.apple.numbers",
        "pages" => "application/vnd.apple.pages",
    ];

    public function test_mime_array()
    {
        $mu = new MimeUtils; 
        $this->assertEquals( $this->check_array, $mu->mime_array() );
    }

    public function test_available_filters()
    {
        $available_filters = [
            0 => 'image',
            1 => 'video',
            2 => 'text',
            3 => 'audio',
            4 => 'application',
            5 => 'ms-office',
            6 => 'open-office',
            7 => 'wordperfect',
            8 => 'iwork',
        ];
        $mu = new MimeUtils; 
        $this->assertEquals( $available_filters, $mu->available_filters() );
    }

    public function test_allow()
    {
        $mu = new MimeUtils;  
        $key='image';
        $mu->allow($key);
        $this->assertEquals( $this->check_array['image'], $mu->allowed_types );
    }

    public function test_allow_all()
    {
        $flattened_array = [];
        foreach ($this->check_array as $key => $val) {
            foreach($val as $type){
                $flattened_array[] = $type;
            }
        }
        $mu = new MimeUtils;  
        $mu->allow_all();
        $this->assertEquals( $this->flatten_check_array, $mu->allowed_types );
    }

    public function test_get_types()
    {
        $mu = new MimeUtils;  
        $key='image';
        $mu->allow($key);
        $this->assertEquals( 'image/jpeg,image/jpeg,image/gif,image/png,image/bmp,image/tiff,image/tiff,image/x-icon,image/svg+xml' , $mu->get_types($format = 'string') );
    }

    public function test_get_extensions()
    {
        $mu = new MimeUtils;  
        $key='image';
        $mu->allow($key);
        $this->assertEquals( 'jpg,jpeg,gif,png,bmp,tiff,tif,ico,svg', $mu->get_extensions() );
    }

}


