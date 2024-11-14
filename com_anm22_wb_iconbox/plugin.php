<?php

/**
 * Iconbox plugin
 *
 * @author Andrea Menghi <andrea.menghi@anm22.it>
 */
class com_anm22_wb_iconbox extends com_anm22_wb_editor_page_element
{

    // client
    public $elementClass = "com_anm22_wb_iconbox";
    public $elementPlugin = "com_anm22_wb_iconbox";
    private $cssClass;
    private $src;
    private $title;
    private $text;
    private $anim = null;
    private $ratio;
    private $imgOrBg;
    private $link = null;

    /**
     * @deprecated since editor 3.0
     * 
     * Method to init the element.
     * 
     * @param SimpleXMLElement $xml Element data
     * @return void
     */
    function importXMLdoJob($xml)
    {
        $this->src = $xml->src;
        $this->title = $xml->title;
        $this->text = $xml->text;
        if ($xml->anim && $xml->anim != "" && $xml->anim != "none") {
            $this->anim = $xml->anim;
        }
        $this->ratio = $xml->ratio;
        $this->imgOrBg = $xml->imgOrBg;
        $this->cssClass = $xml->cssClass;
        $this->link = $xml->link;
    }

    /**
     * Method to init the element.
     * 
     * @param mixed[] $data Element data
     * @return void
     */
    public function initData($data)
    {
        $this->src = $data['src'];
        $this->title = $data['title'];
        if (isset($data['text'])) {
            if ($data['text']) {
                $this->text = $data['text'];
            }
        }
        if (isset($data['anim']) && $data['anim'] && $data['anim'] != "" && $data['anim'] != "none") {
            $this->anim = $data['anim'];
        }
        $this->ratio = $data['ratio'];
        $this->imgOrBg = $data['imgOrBg'];
        if (isset($data['cssClass'])) {
            if ($data['cssClass']) {
                $this->cssClass = $data['cssClass'];
            }
        }
        if (isset($data['link']) && $data['link']) {
            $this->link = $data['link'];
        }
    }

    /**
     * Render the page element
     * 
     * @return void
     */
    function show()
    {
        if ($this->anim) {
            /* Animate.css */
            include_once $this->page->getHomeFolderRelativePHPURL() . "ANM22WebBase/website/plugins/com_anm22_wb_libs/js/wow.php";
            /* Scroll reveal */
            include_once $this->page->getHomeFolderRelativePHPURL() . "ANM22WebBase/website/plugins/com_anm22_wb_libs/css/animate.php";
        }
        
        echo '<style>';
            echo '.' . $this->elementClass . '_' . $this->elementPlugin . '_' . $this->id . ' .icon-box-icon-bg {';
                echo 'background-size:cover;';
                echo 'background-position:center center;';
                echo 'background-repeat:no-repeat;';
            echo '}';
        echo '</style>';
        
        if ($this->imgOrBg == "bg") {
            ?><script>
                $(document).ready(function () {

                    var bgClass = ".<?= $this->elementClass . "_" . $this->elementPlugin ?>_<?= $this->id ?> .icon-box-icon-bg";
                    var ratio = parseFloat("<?= $this->ratio ?>");

                    $(bgClass).height($(bgClass).width() * ratio);
                    $(window).resize(function () {
                        $(bgClass).height($(bgClass).width() * ratio);
                    });

                });
            </script><?
        }
        
        echo '<div class="' . $this->elementClass . "_" . $this->elementPlugin . ' ' . $this->elementClass . "_" . $this->elementPlugin . "_" . $this->id;
                if ($this->cssClass != "" and $this->cssClass != "") {
                    echo ' ' . $this->cssClass;
                }
                if ($this->anim) {
                    echo ' wow ' . $this->anim;
                }
                echo '" id="iconbox-' . $this->id . '">';
                
            if ($this->link && $this->link != "") {
                echo '<a href="' . $this->link . '">';
            }
            if ($this->src != "") {
                if ($this->imgOrBg == "bg") {
                    echo '<div class="icon-box-icon-bg" style="background-image: url(\'' . $this->src . '\')"></div>';
                } else {
                    echo '<img class="icon-box-icon" src="' . $this->src . '" alt="" />';
                }
            }
            if ($this->title) {
                echo '<h2 class="icon-box-title">' . $this->title . '</h2>';
            }
            echo '<p class="icon-box-desc">' . $this->text . '</p>';
            if ($this->link && $this->link != "") {
                echo '</a>';
            }
        echo '</div>';
    }

}