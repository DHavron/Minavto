/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.coreStyles_bold = { element : 'strong', overrides : 'b' };
    config.coreStyles_italic = { element : 'i', overrides : 'em' };
    config.height = 250;
    config.tabSpaces = 4;
    config.protectedSource.push( /<script[\s\S]*?script>/g ); /* script tags */
    config.allowedContent = true; /* all tags */
};
