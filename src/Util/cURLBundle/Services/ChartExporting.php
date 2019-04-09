<?php
/**
 * Exporting Charts to png and jpg images.
 *
 * @author Frank
 */
namespace Util\cURLBundle\Services;

use Exception;

class ChartExporting
{
    private $svg, $type, $width, $height, $temp_name;

    private $ext, $outfile, $type_string, $batik_path;

    /**
     * Configuration from service.
     *
     * @param $svg Data xml from svg image.
     * @param $type Content type from image. (png, jpg)
     * @param $width Width from chart image.
     * @param $height Height  from chart image.
     * @throws Exception
     */
    public function init ($svg, $type, $width, $height)
    {
        $this->svg = $svg;
        $this->type = $type;
        $this->width = "-w $width";
        $this->height = "-h $height";
        $this->outfile = __DIR__.'/../../../../web/temp';
        $this->temp_name = md5(rand());
        $this->batik_path = __DIR__.'/../Resources/java/batik-1.8/batik-rasterizer-1.8.jar';
        // type predefined from image.
        $this->set_predefined_type();
        // return service.
        return $this;
    }

    /**
     * Get extension from file.
     *
     * @return string
     */
    public function name_type ()
    {
        return "Chart.$this->ext";
    }

    /**
     * Converter image svg to png and jpg.
     *
     * @return string
     */
    public function converter ()
    {
        if(isset($this->type_string))
        {   // check for file.
            $this->batik_rasterizer();
            // init parameters.
            $svg = "$this->outfile/$this->temp_name.svg";
            $outfile = "$this->outfile/$this->temp_name.$this->ext";
            // Do the conversion.
            $command = "java -jar ".$this->batik_path." $this->type_string -d $outfile $this->width $this->height $svg";
            $output = shell_exec($command);
            // catch error.
            if (!is_file($outfile) || filesize($outfile) < 10)
            {
                return "$output > Error while converting SVG.";
            }
            else
            {   // stream it.
                $contents = file_get_contents($outfile);
                // delete it.
                unlink("$this->outfile/$this->temp_name.svg");
                unlink($outfile);
                //return contents from image.
                return $contents;
            }
        }
        else if ($this->ext === 'svg')
        {
            return $this->svg;

        } else {
            return "Invalid type";
        }
    }

    /**
     * Save type predefined from image.
     */
    private function set_predefined_type ()
    {
        switch ($this->type)
        {
            case 'image/png':
                $this->ext = 'png';
                $this->type_string = '-m image/png';
                break;
            case 'image/jpeg':
                $this->ext = 'jpg';
                $this->type_string = '-m image/jpeg';
                break;
            case 'application/pdf':
                $this->ext = 'pdf';
                $this->type_string = '-m application/pdf';
                break;
            case 'image/svg+xml':
                $this->ext = 'svg';
                break;
            default:
                $this->ext = 'txt';
        }
    }

    /**
     * Create svg image from data xml.
     *
     * @throws Exception
     */
    private function generate_temporary_file ()
    {
        if (!file_put_contents("$this->outfile/$this->temp_name.svg", $this->svg))
        {
            throw new Exception("Couldn't create temporary file. Check that the directory permissions for the ../web/temp directory are set to 777.");
        }
    }

    /**
     * Tells whether the batik-rasterizer file exists.
     *
     * @throws Exception
     */
    private function batik_rasterizer ()
    {
        if(!is_file($this->batik_path))
        {
            throw new Exception("No existe la libreria > batik-rasterizer.");
        }
        $this->generate_temporary_file();
    }
}