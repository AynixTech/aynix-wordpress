(function () {
    'use strict';

    var MAX_WAIT = 20000; // ms to wait for libs to be ready
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

    // Load a script sequentially, resolving when loaded
    function loadScript(src) {
        return new Promise(function (resolve, reject) {
            var s = document.createElement('script');
            s.src = src;
            s.async = false; // preserve execution order
            s.onload = function () { resolve(src); };
            s.onerror = function () { reject(new Error('Failed to load ' + src)); };
            document.head.appendChild(s);
        });
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

    function waitForLibs(done, fail) {
        if (libsReady()) {
            done();
            return;
        }
        waited += POLL;
        if (waited >= MAX_WAIT) {
            fail();
            return;
        }
        setTimeout(function () { waitForLibs(done, fail); }, POLL);
    }

    function ensureLibsAndRender() {
        // If already present (loaded via <script> tags), just render
        if (libsReady()) {
            render();
            return;
        }

        var container = getContainer();
        if (!container) {
            return;
        }
        var base = container.getAttribute('data-vendor');
        if (!base) {
            // No vendor base provided; just wait in case tags load them
            waitForLibs(render, function () {
                console.error('AYNIX PPTX: libraries did not load (jQuery.pptxToHtml missing)');
                showError('Unable to load the viewer. Use the Download button to open the presentation.');
            });
            return;
        }

        // Self-load the whole chain in order. Use existing jQuery if present.
        var chain = Promise.resolve();
        if (typeof window.jQuery === 'undefined') {
            chain = chain.then(function () { return loadScript(base + '/js/jquery.min.js'); });
        }
        chain = chain
            .then(function () { return loadScript(base + '/js/jszip.min.js'); })
            .then(function () { return loadScript(base + '/js/filereader.js'); })
            .then(function () { return loadScript(base + '/js/d3.min.js'); })
            .then(function () { return loadScript(base + '/js/nv.d3.min.js'); })
            .then(function () { return loadScript(base + '/js/dingbat.js'); })
            .then(function () { return loadScript(base + '/js/pptxjs.js'); })
            .then(function () { return loadScript(base + '/js/divs2slides.js'); })
            .then(function () {
                waitForLibs(render, function () {
                    console.error('AYNIX PPTX: pptxToHtml missing after load');
                    showError('Unable to load the viewer. Use the Download button to open the presentation.');
                });
            })
            .catch(function (err) {
                console.error('AYNIX PPTX: script load error', err);
                showError('Unable to load the viewer. Use the Download button to open the presentation.');
            });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', ensureLibsAndRender);
    } else {
        ensureLibsAndRender();
    }
})();
