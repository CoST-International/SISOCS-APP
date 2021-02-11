
<?php

/**
 * Knob class file.
 *
 * PHP Version 5.1
 *
 * @package  Widget
 * @author   FBurhan <sefburhan@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://www.yiiframework.com/user/62626/
 */
class Knob extends CWidget {

    public $data = array();  // for extension options
    public $jsFile;   // for js file

    public function init() {

        // Put togehther options for plugin
        $path = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.knob.assets', -1, false));
        $this->jsFile = $path . '/jquery.knob.js';
        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile($this->jsFile);

        $script = '
                $(".knob").knob({
                    change : function (value) {
                        //console.log("change : " + value);
                    },
                    release : function (value) {
                        //console.log(this.$.attr("value"));
                        console.log("release : " + value);
                    },
                    cancel : function () {
                        console.log("cancel : ", this);
                    },
                    draw : function () {

                        // "tron" case
                        if(this.$.data("skin") == "tron") {

                            var a = this.angle(this.cv)  // Angle
                                , sa = this.startAngle          // Previous start angle
                                , sat = this.startAngle         // Start angle
                                , ea                            // Previous end angle
                                , eat = sat + a                 // End angle
                                , r = 1;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                                && (sat = eat - 0.3)
                                && (eat = eat + 0.3);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.v);
                                this.o.cursor
                                    && (sa = ea - 0.3)
                                    && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.pColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });
        '
        ;
        //$cs->registerScript('knob', $script);
    }

    /**
     * Run this widget.
     * This method registers necessary javascript and renders the needed HTML code.
     */
    public function run() {
        /*$knob = '<div class="demo"><input class="knob"';

        foreach ($this->data as $key => $value) {
            $knob.=$key . '=' . $value . ' ';
        }
        $knob.=' ></div>';
        echo $knob;*/
    }

}

?>
