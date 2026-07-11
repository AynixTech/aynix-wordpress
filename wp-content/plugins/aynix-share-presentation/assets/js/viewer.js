(function () {
    'use strict';

    var MAX_WAIT = 15000; // ms to wait for CDN libs
    var POLL = 150;
    var waited = 0;

    function getContainer() {
        return document.getElementById('aynix-sp-pptx');
    }

    function showError(msg) {
        var c = getContainer();
        if (c) {
            c.innerHTML = '<div class="aynix-sp-render-error"><p>' + msg + '</p></div>';
        }
    }

    function libsReady() {
        return typeof window.jQuery !== 'undefined' &&
            window.jQuery.fn &&
            typeof window.jQuery.fn.pptxToHtml === 'function';
    }

    function render() {
        var container = getContainer();
        if (!container) {
            return;
        }
        var fileUrl = container.getAttribute('data-file');
        var $ = window.jQuery;

        try {
            container.innerHTML = '';
            $('#aynix-sp-pptx').pptxToHtml({
                pptxFileUrl: fileUrl,
                slideMode: false,
                keyBoardShortCut: false,
                mediaProcess: false,
                jsZipV2: false,
                slidesScale: ''
            });

            // Fallback if nothing renders
            setTimeout(function () {
                var hasSlides = container.querySelector('.slide, .block, .divs2slidesjs-slide, svg, canvas, img');
                if (!hasSlides) {
                    showError('The presentation could not be displayed here. Use the Download button to open it.');
                }
            }, 12000);
        } catch (err) {
            console.error('AYNIX PPTX render error:', err);
            showError('The presentation could not be displayed here. Use the Download button to open it.');
        }
    }

    function waitForLibs() {
        if (libsReady()) {
            render();
            return;
        }
        waited += POLL;
        if (waited >= MAX_WAIT) {
            console.error('AYNIX PPTX: libraries did not load (jQuery.pptxToHtml missing)');
            showError('Unable to load the viewer. Use the Download button to open the presentation.');
            return;
        }
        setTimeout(waitForLibs, POLL);
    }

    // Start once the DOM is at least interactive
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', waitForLibs);
    } else {
        waitForLibs();
    }
})();
