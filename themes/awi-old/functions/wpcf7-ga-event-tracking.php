<?php
/**
 * CF7 Google Analytics Event Tracking
 * Enables GA event tracking on successful form send
 */

// Add ACF Options page support
add_filter('wpcf7_ajax_json_echo', 'awi_cf7_ga_event_tracking', 10, 2);

function awi_cf7_ga_event_tracking($items, $result) {
	$form = WPCF7_ContactForm::get_current();

	if('mail_sent' === $result['status']) {
		if(!isset($items['onSentOk'])) {
			$items['onSentOk'] = array();
		}

		$items['onSentOk'][] = sprintf(
			'if( typeof ga !== "undefined" ) {
				ga( "send", "event", "%1$s", "sent" );
			}
			if( typeof _gaq !== "undefined" ) {
				_gaq.push([ "_trackEvent", "%1$s", "sent" ]);
			}
			if( typeof __gaTracker !== "undefined" ) {
				__gaTracker( "send", "event", "%1$s", "sent" );
			}',
			esc_js( $form->title() )
		);
	}
	return $items;
}
