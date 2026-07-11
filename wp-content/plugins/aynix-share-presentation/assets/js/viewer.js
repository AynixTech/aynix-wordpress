(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(fn, 60);
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    ready(function () {
        var container = document.getElementById('aynix-sp-pptx');
        if (!container) {
            return;
        }

        var fileUrl = container.getAttribute('data-file');

        function showError(msg) {
            container.innerHTML =
                '<div class="aynix-sp-render-error"><p>' + msg + '</p></div>';
        }

        // jQuery + pptxToHtml must be present
        if (typeof window.jQuery === 'undefined' || typeof window.jQuery.fn.pptxToHtml === 'undefined') {
            showError('Unable to load the viewer. Use the Download button to open the presentation.');
            return;
        }

        var $ = window.jQuery;

        try {
            // Clear the loader content; pptxjs renders into #aynix-sp-pptx
            container.innerHTML = '';

            $('#aynix-sp-pptx').pptxToHtml({
                pptxFileUrl: fileUrl,
                slideMode: false,
                keyBoardShortCut: false,
                mediaProcess: false,
                jsZipV2: false,
                slidesScale: '',
                slideModeConfig: {
                    first: 1,
                    nav: true
                }
            });

            // Safety timeout: if nothing rendered, show fallback
            setTimeout(function () {
                var hasSlides = container.querySelector('.slide, .block, svg, canvas, img');
                if (!hasSlides) {
                    showError('The presentation could not be displayed here. Use the Download button to open it.');
                }
            }, 12000);
        } catch (err) {
            console.error('AYNIX PPTX render error:', err);
            showError('The presentation could not be displayed here. Use the Download button to open it.');
        }
    });
})();
