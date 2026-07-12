document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.aynix-sp-edit-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var targetId = btn.getAttribute('data-target');
            var row = document.getElementById(targetId);

            if (!row) {
                return;
            }

            var isHidden = row.hasAttribute('hidden');

            document.querySelectorAll('.aynix-sp-editor-row').forEach(function (editorRow) {
                editorRow.setAttribute('hidden', 'hidden');
            });

            document.querySelectorAll('.aynix-sp-edit-toggle').forEach(function (toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            });

            if (isHidden) {
                row.removeAttribute('hidden');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });

    document.querySelectorAll('.aynix-sp-editor-cancel').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var targetId = btn.getAttribute('data-target');
            var row = document.getElementById(targetId);

            if (!row) {
                return;
            }

            row.setAttribute('hidden', 'hidden');

            document.querySelectorAll('.aynix-sp-edit-toggle[data-target="' + targetId + '"]').forEach(function (toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    });

    document.querySelectorAll('.aynix-sp-copy').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var link = btn.getAttribute('data-link');
            var done = function () {
                var original = btn.textContent;
                btn.textContent = 'Copiato!';
                btn.classList.add('copied');
                setTimeout(function () {
                    btn.textContent = original;
                    btn.classList.remove('copied');
                }, 1500);
            };
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(link).then(done, function () {
                    fallbackCopy(link, done);
                });
            } else {
                fallbackCopy(link, done);
            }
        });
    });

    function fallbackCopy(text, cb) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        try { document.execCommand('copy'); } catch (e) {}
        document.body.removeChild(ta);
        cb();
    }
});
