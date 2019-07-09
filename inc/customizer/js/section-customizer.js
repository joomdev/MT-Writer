//
// ─── CUSTOM SEPERATOR ───────────────────────────────────────────────────────────
//
( function( $, api ) {
	/* Custom variable for section's seperator */
	api.sectionConstructor['horizontal-separator'] = api.Section.extend( {
		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	});

} )( jQuery, wp.customize );