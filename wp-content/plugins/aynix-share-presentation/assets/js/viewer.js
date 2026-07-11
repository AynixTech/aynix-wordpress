(function () {
    'use strict';

    var container = document.getElementById('aynix-sp-pptx');
    if (!container) {
        return;
    }

    var fileUrl = container.getAttribute('data-file');
    var rendered = false;

    function getLib() {
        return window.pptxPreview || window.pptxPreviewer || window.PPTXPreview || null;
    }

    function showError(msg) {
        container.innerHTML =
            '<div class="aynix-sp-render-error">' +
            '<p>' + msg + '</p>' +
            '</div>';
    }

    function currentSize() {
        var width = container.clientWidth || 960;
        // Cap width so it stays readable, keep 16:9 ratio
        return {
            width: width,
            height: Math.round(width * 0.5625)
        };
    }

    function render() {
        var lib = getLib();
        if (!lib || typeof lib.init !== 'function') {
            showError('Unable to load the viewer. Use the Download button to open the presentation.');
            return;
        }

        var size = currentSize();

        fetch(fileUrl, { credentials: 'same-origin' })
            .then(function (res) {
                if (!res.ok) {
                    throw new Error('HTTP ' + res.status);
                }
                return res.arrayBuffer();
            })
            .then(function (buffer) {
                container.innerHTML = '';
                var previewer = lib.init(container, {
                    width: size.width,
                    height: size.height,
                    mode: 'slide'
                });
                return previewer.preview(buffer);
            })
            .then(function () {
                rendered = true;
            })
            .catch(function (err) {
                console.error('AYNIX PPTX render error:', err);
                showError('The presentation could not be displayed here. Use the Download button to open it.');
            });
    }

    function start() {
        // small delay to ensure the CDN lib is parsed
        setTimeout(render, 60);
    }

    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        start();
    } else {
        document.addEventListener('DOMContentLoaded', start);
    }

    // Responsive: re-render on resize (debounced)
    var resizeTimer = null;
    window.addEventListener('resize', function () {
        if (!rendered) {
            return;
        }
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            rendered = false;
            render();
        }, 400);
    });
})();
