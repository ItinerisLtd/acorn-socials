import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
import domReady from '@wordpress/dom-ready';

domReady(() => {
  console.log('hello from acorn-package app.js');
});
