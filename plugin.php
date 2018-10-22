<?php

class pluginYandexTools extends Plugin {

	public function init()
	{
		$this->dbFields = array(
			'yametrika-id'=>'',
			'yandex-verification'=>''
		);
	}

	public function form()
	{
		global $L;

		$html  = '<div>';
		$html .= '<label for="yaverification">'.$L->get('Yandex.Webmaster').'</label>';
		$html .= '<input id="yaverification" type="text" name="yandex-verification" value="'.$this->getValue('yandex-verification').'">';
		$html .= '<span class="tip">'.$L->get('complete-this-field-with-the-yandex-verification').'</span>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label for="yametrika">'.$L->get('Yandex.Metrika Counter ID').'</label>';
		$html .= '<input id="yametrika" type="text" name="yametrika-id" value="'.$this->getValue('yametrika-id').'">';
		$html .= '<span class="tip">'.$L->get('complete-this-field-with-the-yametrika-id').'</span>';
		$html .= '</div>';

		return $html;
	}

	public function siteHead()
	{
                global $url;

                if( $this->getValue('yandex-verification') && $url->whereAmI()=='home' ) {
	                $html   = PHP_EOL.'<!-- Yandex.Webmaster ID -->'.PHP_EOL;
        	        $html  .= '<meta name="yandex-verification" content="'.$this->getValue('yandex-verification').'" />'.PHP_EOL;
                	return $html;
		}
		return false;

	}

	public function siteBodyEnd()
	{
		
	if( $this->getValue('yametrika-id') ) {
		$html  = PHP_EOL.'<!-- Yandex.Metrika counter -->'.PHP_EOL;
		$html .= "<script type='text/javascript'>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter".$this->getValue('yametrika-id')." = new Ya.Metrika({
                    id:".$this->getValue('yametrika-id').",
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName('script')[0],
            s = d.createElement('script'),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'https://mc.yandex.ru/metrika/watch.js';

        if (w.opera == '[object Opera]') {
            d.addEventListener('DOMContentLoaded', f, false);
        } else { f(); }
    })(document, window, 'yandex_metrika_callbacks');
</script>
<noscript><div><img src='https://mc.yandex.ru/watch/".$this->getValue('yametrika-id')."' style='position:absolute; left:-9999px;' alt='' /></div></noscript>".PHP_EOL;
			return $html;
		}

		return false;
	}
}

