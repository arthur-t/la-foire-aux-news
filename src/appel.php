
<?php

    require_once(__DIR__.'/config/config.php');

    require_once(__DIR__.'/config/Autoload.php');
    Autoload::charger();

    include ('./parser/XmlParser.php');
    global $rep;
    global $vues;

    $tab=FluxModele::get_all();
    $gw = new ParserGateway(new Connection($dsn,$login,$password));
    $tab=$gw->requestAll();
    foreach ($tab as $flux){

        $parser = new XmlParser($flux->getLink());
        $tabNews=$parser->parse();
        foreach ($tabNews as $news) {
            $pubDate=date('Y-m-d H:i',strtotime($news->getPubDate()));
            $id=uniqid();
            $gw->insert($id,$news->getTitle(),$news->getDescription(),$pubDate,$news->getLink(),$news->getCategory());
        }


    }




