//
// http://thecodeabode.blogspot.com
// @author: Ben Kitzelman
// @license:  FreeBSD: (http://opensource.org/licenses/BSD-2-Clause) Do whatever you like with it
// @updated: 03-03-2013
//
var getAcrobatInfo = function() {

  var getBrowserName = function() {
    return this.name = this.name || function() {
      var userAgent = navigator ? navigator.userAgent.toLowerCase() : "other";

      if(userAgent.indexOf("chrome") > -1)        return "chrome";
      else if(userAgent.indexOf("safari") > -1)   return "safari";
      else if(userAgent.indexOf("msie") > -1)     return "ie";
      else if(userAgent.indexOf("firefox") > -1)  return "firefox";
      return userAgent;
    }();
  };

  var getActiveXObject = function(name) {
    try { return new ActiveXObject(name); } catch(e) {}
  };

  var getNavigatorPlugin = function(name) {
    for(key in navigator.plugins) {
      var plugin = navigator.plugins[key];
      if(plugin.name == name) return plugin;
    }
  };

  var getPDFPlugin = function() {
    return this.plugin = this.plugin || function() {
      if(getBrowserName() == 'ie') {
        //
        // load the activeX control
        // AcroPDF.PDF is used by version 7 and later
        // PDF.PdfCtrl is used by version 6 and earlier
        return getActiveXObject('AcroPDF.PDF') || getActiveXObject('PDF.PdfCtrl');
      }
      else {
        return getNavigatorPlugin('Adobe Acrobat') || getNavigatorPlugin('Chrome PDF Viewer') || getNavigatorPlugin('WebKit built-in PDF');
      }
    }();
  };

  var isAcrobatInstalled = function() {
    return !!getPDFPlugin();
  };

  var getAcrobatVersion = function() {
    try {
      var plugin = getPDFPlugin();

      if(getBrowserName() == 'ie') {
        var versions = plugin.GetVersions().split(',');
        var latest   = versions[0].split('=');
        return parseFloat(latest[1]);
      }

      if(plugin.version) return parseInt(plugin.version);
      return plugin.name
    }
    catch(e) {
      return null;
    }
  }

  //
  // The returned object
  //
  return {
    browser:        getBrowserName(),
    acrobat:        isAcrobatInstalled() ? 'installed' : false,
    acrobatVersion: getAcrobatVersion()
  };
};
;
(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.pdf = {
    attach: function(context, settings) {
      var info = getAcrobatInfo();
      console.log(info.browser + " " + info.acrobat + " " + info.acrobatVersion);
      var iframe = $('iframe.pdf');
      if (info.acrobat) {
        iframe.each(function(){
          setIframeSrc($(this));
          $(this).attr('src', $(this).text());
        });
      }

      if (!isCanvasSupported()) {
        // pdf.js isn't going to work in this browser--let's try acrobat.
        if (info.acrobat) {
          iframe.each(function(){
            setIframeSrc($(this));
            $(this).attr('src', $(this).text());
          });
        }
        else {
          // Even Acrobat isn't going to work--output a message telling user to upgrade their browser.
          $('<p/>', {
            text: 'Your browser is not capable of displaying a pdf. Please upgrade your browser to view this page as it was intended.',
            'class': 'pdf acrobat-browser-messsage',
          }).replaceAll(iframe);
        }
      }
    }
  };
})(jQuery, Drupal, drupalSettings);

/**
 * Detect browser support for canvas.
 *
 * Canvas support is one of the main things that is needed by pdf.js
 * so detecting this should rule out most of the browsers that aren't
 * going to work.
 *
 * See: http://stackoverflow.com/questions/2745432/best-way-to-detect-that-html5-canvas-is-not-supported
 */
function isCanvasSupported(){
  var elem = document.createElement('canvas');
  return !!(elem.getContext && elem.getContext('2d'));
}

/**
 * Set the iframe's source to be the value that was passed through in the
 * data-src attribute.
 */
function setIframeSrc(e){
  e.attr('src', e.attr('data-src')).removeAttr('data-src');
}
;
