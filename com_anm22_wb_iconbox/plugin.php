<?php
/*
 * Author: ANM22
 * Last modified: 25 Nov 2019 - GMT +1 11:23
 *
 * ANM22 Andrea Menghi all rights reserved
 *
 */

class com_anm22_wb_iconbox extends com_anm22_wb_editor_page_element {

    // client
    public $elementClass = "com_anm22_wb_iconbox";
    public $elementPlugin = "com_anm22_wb_iconbox";
    private $cssClass;
    private $src;
    private $title;
    private $text;
    private $anim;
    private $ratio;
    private $imgOrBg;
    private $link;

    function importXMLdoJob($xml) {
        $this->src = $xml->src;
        $this->title = $xml->title;
        $this->text = $xml->text;
        $this->anim = $xml->anim;
        $this->ratio = $xml->ratio;
        $this->imgOrBg = $xml->imgOrBg;
        $this->cssClass = $xml->cssClass;
        $this->link = $xml->link;
    }

    function show() {
        if ($this->anim != "" && $this->anim != "none") {
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
                if ($this->anim != "" and $this->anim != "none") {
                    echo ' wow ' . $this->anim;
                }
                echo '" id="iconbox-' . $this->id . '">';
                
            if ($this->link!= "") {
                echo '<a href="' . $this->link . '">';
            }
            if ($this->src != "") {
                if ($this->imgOrBg == "bg") {
                    echo '<div class="icon-box-icon-bg" style="background-image: url(\'' . $this->src . '\')"></div>';
                } else {
                    echo '<img class="icon-box-icon" src="' . $this->src . '" alt="" />';
                }
            }
            echo '<h2 class="icon-box-title">' . $this->title . '</h2>';
            echo '<p class="icon-box-desc">' . $this->text . '</p>';
            if ($this->link!= "") {
                echo '</a>';
            }
        echo '</div>';
    }

}