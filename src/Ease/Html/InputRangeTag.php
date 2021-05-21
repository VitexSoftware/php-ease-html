<?php
declare (strict_types=1);

namespace Ease\Html;

/**
 * HTML5 range input tag.
 *
 * @author Vitex <vitex@hippy.cz>
 */
class InputRangeTag extends InputTag {

    /**
     * The &lt;input type="range"&gt; defines a control for entering a number whose exact value is not important 
     * 
     * @see https://www.w3schools.com/tags/att_input_type_range.asp
     *
     * @param string $name       name
     * @param string $value      initial value
     * @param array  $properties additional properties min,max,step...
     */
    public function __construct($name, $value = null, $properties = []) {
        $properties['type'] = 'range';
        $properties['value'] = $value;
        $properties['name'] = $name;
        parent::__construct($name, $value, $properties);
    }

}
