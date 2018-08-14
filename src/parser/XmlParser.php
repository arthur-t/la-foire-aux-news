<?php
/**
 * Created by PhpStorm.
 * User: Arthur
 * Date: 17/12/2017
 * Time: 18:06
 */

class XmlParser
{
    private $lien;
    private $path;
    private $result;
    private $depth;
    private $itemBool=false;
    private $linkBool=false;
    private $titleBool=false;
    private $categBool=false;
    private $dateBool=false;
    private $descBool=false;
    private $currentNews;
    private $newsTable;
    private $descriptionParts;
    private $titleParts;

    public function __construct($path)
    {
        $this->path=$path;


    }

    public function getResult() {
        return $this->result;
    }

    public function parse()
    {
        ob_start();
        $xml_parser = xml_parser_create();
        xml_set_object($xml_parser,$this);
        xml_set_element_handler($xml_parser,"startElement","endElement");
        xml_set_character_data_handler($xml_parser,'characterData');
        if (!($fp = fopen($this -> path, "r"))) {
            die("could not open XML input");
        }


        while ($data = fread($fp, 4096)) {
            if (!xml_parse($xml_parser, $data, feof($fp))) {
                die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($xml_parser)),
                    xml_get_current_line_number($xml_parser)));
            }
        }

        $this -> result = ob_get_contents();
        ob_end_clean();
        fclose($fp);
        xml_parser_free($xml_parser);
        return $this->newsTable;
    }


    private function startElement($parser,$name,$attrs)
    {

        switch ($name){
            case "ITEM":
                $this->currentNews = new News();
                $this->descriptionParts=array();
                $this->titleParts=array();
                $this->itemBool = true;
                break;

            case "LINK":
                $this->linkBool=true;
                break;

            case "TITLE":
                $this->titleBool=true;
                break;

            case "CATEGORY":
                $this->categBool=true;
                break;

            case "DESCRIPTION":
                $this->descBool=true;
                break;

            case "PUBDATE":
                $this->dateBool=true;
                break;
        }
    }



    private function endElement($parser,$name)
    {

        switch ($name){

            case "ITEM":
                $this->currentNews->setTitle(implode($this->titleParts));
                $this->currentNews->setDescription(implode($this->descriptionParts));
                $this->newsTable[]=$this->currentNews;
                //NewsModele::add_news($this->currentNews->getTitle(),$this->currentNews->getDescription(),$this->currentNews->getLink(),$this->currentNews->getCategory(),$this->currentNews->getPubDate());
                break;

            case "LINK":
                $this->linkBool=false;
                break;

            case "CATEGORY":
                $this->categBool=false;
                break;

            case "TITLE":
                $this->titleBool=false;
                break;

            case "DESCRIPTION":
                $this->descBool=false;
                break;

            case "PUBDATE":
                $this->dateBool=false;
                break;
        }

    }

    private function characterData($parser,$data)
    {

        $data = trim($data);

        if($this->itemBool){
            if ($this->linkBool){
                $this->currentNews->setLink($data);
            }
            if ($this->titleBool) {
                $this->titleParts[]=$data;
                //$this->currentNews->setTitle($data);
            }
            if ($this->categBool) {

                $this->currentNews->addCategory($data);
            }

            if ($this->descBool){
                $this->descriptionParts[]=$data;
               // $this->currentNews->setDescription($data);
            }

            if($this->dateBool) {
                $this->currentNews->setPubDate($data);
            }
        }

    }
}