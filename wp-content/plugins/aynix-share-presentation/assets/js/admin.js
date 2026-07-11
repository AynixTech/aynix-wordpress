document.addEventListener('DOMContentLoaded', function () {
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
