<?php
class antiHack
{
    public function filterAll($str)
    {
        $string=strip_tags(trim($str));
        $string=str_replace("#","&#35",$string);
        $string=str_replace("%","&#37",$string);
        $string=str_replace('\"',"&quot;",$string);
        return $string;
    }
    public function filterWithTags($str)
    {
        $string=strip_tags(trim($str),'<p><h1><h2><h3><h4><h5><h6><i><img><b><em><big><br><br /><q><s><tt><small><strike><samp><code><a><ul><ol><li><table><tr><td><th><strong><font><u><iframe><frame><script>');
        $string=str_replace("#","&#35",$string);
        $string=str_replace("%","&#37",$string);
        $string=str_replace('\"',"&quot;",$string);
        return $string;
    }
    public function filterAllWithOutQuots($str)
    {
        $string=strip_tags(trim($str));
        return $string;
    }
    public function mnemoniki ($str) {
        $arrayIn=array(
            '&amp;'=>'&',
            '&nbsp;'=>' ',
            '&brvbar;'=>'¦',
            '&sect;'=>'§',
            '&copy;'=>'©',
            '&laquo;'=>'«',
            '&raquo;'=>'»',
            '&reg;'=>'®',
            '&deg;'=>'°',
            '&plusmn;'=>'±',
            '&sup2;'=>'²',
            '&sup3;'=>'³',
            '&acute;'=>'´',
            '&Xi'=>'Ξ',
            '&Sigma;'=>'Σ',
            '&hellip;'=>'…',
            '&prime;'=>'′',
            '&Prime;'=>'″',
            '&trade;'=>'™',
            '&harr;'=>'↔',
            '&hArr;'=>'⇔',
            '&minus;'=>'−',
            '&asymp;'=>'≈',
            '&equiv;'=>'≡',
            '&le;'=>'≤',
            '&ge;'=>'≥',
            '&apos;'=>'\'',
            '&quot;'=>'"',
            '&lt;'=>'<',
            '&gt;'=>'>',
            '&tilde;'=>'˜',
            '&ndash;'=>'–',
            '&mdash;'=>'—',
            '&lsquo;'=>'‘',
            '&rsquo;'=>'’',
            '&ldquo;'=>'“',
            '&rdquo;'=>'”',
            '&lsaquo;'=>'‹',
            '&rsaquo;'=>'›',
            '&euro;'=>'€'
        );
    }
}
?>